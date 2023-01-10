<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Place\PlaceRequest;
use App\Services\Interfaces\PlaceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Place;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $placeService;

    public function __construct(PlaceService $placeService)
    {
        $this->placeService = $placeService;
    }

    public function index ()
    {
        $addresses = $this->placeService->getAddressPlace()->paginate(10);

        return view('admin.pages.dashboard.index', compact('addresses'));
    }

    public function manager (Request $request)
    {
        $address = urldecode($request->query('address')) ?? null;
        $places = $this->placeService->getPlaceByAddressName($address);

        return view('admin.pages.dashboard.manager', compact('address', 'places'));
    }

    public function detail ($id = null)
    {
        $place = $this->placeService->find($id);
        $placeImages = $place->placeImages;

        return view('admin.pages.dashboard.detail', compact('place', 'placeImages'));
    }

    public function place ($id = null)
    {
        $place = $this->placeService->find($id);
        $placeImages = $place->placeImages;

        return view('admin.pages.components.dashboard.place', compact('place', 'placeImages'));
    }

    public function create(Request $request)
    {
        $address = urldecode($request->query('address')) ?? '';

        return view('admin.pages.dashboard.create_place', compact('address'));
    }

    public function store(PlaceRequest $request)
    {
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
                    $file_path = $file->store('public/images/place/' . Str::slug($validated['name']));

                    $place->placeImages()->create([
                        'file_path' => explode("public/", $file_path)[1]
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.dashboard')->with('success', ' create new place success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }

        return back()->with('error', ' create new place failed!');
    }

    public function edit(Place $place) {
        return view('admin.pages.dashboard.edit_place', compact('place'));
    }

    public function update(PlaceRequest $request,Place $place ) {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $this->placeService->update($place, $request->safe()->only(['name', 'address', 'content']));

            if ($files = $request->file('file_path')) {
                $place->placeImages()->delete();
                foreach($files as $file){
                    $file_path = $file->store('public/images/place/' . Str::slug($validated['name']));

                    $place->placeImages()->create([
                        'file_path' => explode("public/", $file_path)[1]
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.dashboard')->with('success', ' update place success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }
    }

    public function delete ($id = null)
    {
        DB::beginTransaction();
        try {
            $place = $this->placeService->find($id);
            foreach($place->placeImages as $place_image) {
                $exploded = explode('/', $place_image->file_path);
                $exploded_pos = strpos($place_image->file_path, end($exploded));
                $url = "storage/" . substr($place_image->file_path, 0, $exploded_pos);
                $file_path = public_path($url);
                File::deleteDirectory($file_path);
            }
            $this->placeService->delete($id);

            DB::commit();
            return redirect()->route('admin.dashboard')->with('success', 'Delete success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }

        return back()->with('error', 'Delete failed!');
    }
}
