<?php

namespace App\Http\Controllers\User;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Place\PlaceRequest;
use App\Services\Interfaces\PlaceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PlaceController extends Controller
{
    protected $placeService;

    public function __construct(PlaceService $placeService)
    {
        $this->placeService = $placeService;
    }

    public function index(Request $request)
    {
        $place_request = urldecode($request->query('place')) ?? null;
        $place = $this->placeService->getPlaceByname($place_request);
        $blogs = $place->blogs;

        return view('user.pages.place.index', compact('place', 'blogs'));
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
            return redirect()->back()->with('success', ' create new place success');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
        }

        return back()->with('error', ' create new place failed!');
    }
}
