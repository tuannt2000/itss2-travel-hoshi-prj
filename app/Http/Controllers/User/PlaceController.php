<?php

namespace App\Http\Controllers\User;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Place\PlaceRequest;
use App\Services\Interfaces\PlaceService;
use App\Models\Place;
use App\Models\PlaceTag;
use App\Models\Tag;
use App\Services\Interfaces\UserPlaceVoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PlaceController extends Controller
{
    protected $placeService;
    protected $userPlaceVoteService;

    public function __construct(PlaceService $placeService, UserPlaceVoteService $userPlaceVoteService)
    {
        $this->placeService = $placeService;
        $this->userPlaceVoteService = $userPlaceVoteService;
    }

    public function index(Request $request)
    {
        $place_request = urldecode($request->query('place')) ?? null;
        $place = $this->placeService->getPlaceByname($place_request);
        $blogs = $place->blogs;
        $userPlaceVote = $this->userPlaceVoteService->getPlaceVote($place->id, Auth::user()->id);

        return view('user.pages.place.index', compact('place', 'blogs', 'userPlaceVote'));
    }

    public function create()
    {
        $addresses = [];

        try {
            $response = Http::get('https://provinces.open-api.vn/api/p/');
            $body = json_decode($response->body());
            foreach($body as $value) {
                $addresses[] = Helper::customNameAddress($value->name);
            }
        } catch (\Exception $e) {
            Log::error($e);
        }

        return view('user.pages.place.create', compact('addresses'));
    }

    public function store(PlaceRequest $request)
    {
        if (!$request->file('file_path')) {
            return back()->with('error', ' create new place failed!');
        }
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $place = $this->placeService->create([
                'name' => $validated['name'],
                'address' => $validated['address'],
                'content' => $validated['content'],
                'user_id' => Auth::user()->id
            ]);

            if($files = $request->file('file_path')){
                foreach($files as $file){
                    $mime = $file->getMimeType();
                    if(strstr($mime, "video/")){
                        $file_path = $file->store('public/videos/place/' . Str::slug($validated['name']));
                    }else {
                        $file_path = $file->store('public/images/place/' . Str::slug($validated['name']));
                    }

                    $place->placeImages()->create([
                        'file_path' => explode("public/", $file_path)[1]
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('user.home')->with('success', ' create new place success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }

        return back()->with('error', ' create new place failed!');
    }

    public function edit($id = null)
    {
        $place = $this->placeService->find($id);
        $addresses = [];
        $tags = Tag::all();
        $place_tags = $place->placetags()->pluck('tag_id')->toArray();

        try {
            $response = Http::get('https://provinces.open-api.vn/api/p/');
            $body = json_decode($response->body());
            foreach($body as $value) {
                $addresses[] = Helper::customNameAddress($value->name);
            }
        } catch (\Exception $e) {
            Log::error($e);
        }

        return view('user.pages.place.edit', compact('place', 'addresses', 'tags', 'place_tags'));
    }

    public function showMyPlaces() {
        $places = Auth::user()->places;
        return view('user.pages.place.my', compact('places'));
    }

    public function update(PlaceRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $place = $this->placeService->find($id);
            $this->placeService->update($place, [
                'name' => $validated['name'],
                'address' => $validated['address'],
                'content' => $validated['content'],
            ]);

            if($files = $request->file('file_path')){
                $place->placeImages()->delete();
                foreach($files as $file){
                    $mime = $file->getMimeType();
                    if(strstr($mime, "video/")){
                        $file_path = $file->store('public/videos/place/' . Str::slug($validated['name']));
                    }else {
                        $file_path = $file->store('public/images/place/' . Str::slug($validated['name']));
                    }

                    $place->placeImages()->create([
                        'file_path' => explode("public/", $file_path)[1]
                    ]);
                }
            }

            $place->placetags()->delete();
            if ($request->tag != '') {
                $tags = explode(",", $request->tag);
                $place_tags = array_map(function($result) use($place) {
                    return new PlaceTag(['tag_id' => $result]);
                }, $tags);
                $place->placetags()->saveMany($place_tags);
            }
            DB::commit();
            return redirect()->route('user.home')->with('success', 'Update place success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }

        return back()->with('error', 'Update place failed!');
    }

    public function delete(Place $place)
    {
        DB::beginTransaction();
        try {
            foreach($place->placeImages as $place_image) {
                $exploded = explode('/', $place_image->file_path);
                $exploded_pos = strpos($place_image->file_path, end($exploded));
                $url = "storage/" . substr($place_image->file_path, 0, $exploded_pos);
                $file_path = public_path($url);
                File::deleteDirectory($file_path);
            }
            $this->placeService->delete($place->id);

            DB::commit();
            return redirect()->route('user.place.show_my_places')->with('success', 'Delete success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }
        return back()->with('error', 'Delete failed!');
    }

    public function vote(Request $request) {
        if ($request->ajax()) {
            $userPlaceVote = $this->userPlaceVoteService->getPlaceVote($request->place_id, Auth::user()->id);
            $data = [
                'vote' => $request->vote
            ];

            if ($userPlaceVote) {
                if ($userPlaceVote->update($data)) {
                    return response()->json([
                        'message' => 'Update vote thành công'
                    ]);
                }
            } else {
                $data['place_id'] = $request->place_id;
                $data['user_id'] = Auth::user()->id;
                if ($this->userPlaceVoteService->create($data)) {
                    return response()->json([
                        'message' => 'Vote thành công'
                    ]);
                }
            }

            return response()->json([
                'message' => 'Vote thất bại'
            ]);
        }

        return response()->json([
            'message' => 'Không hỗ trợ method này'
        ]);
    }
}
