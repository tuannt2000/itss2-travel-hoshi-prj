<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Services\Interfaces\PlaceService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $placeService;

    public function __construct(PlaceService $placeService)
    {
        $this->placeService = $placeService;
    }

    public function index(Request $request)
    {
        $address = $request->query('address') ?? null;
        $month = $request->query('month') ?? 0;
        $price = $request->query('price') ?? null;
        $tag = $request->query('tag') ? explode(',', $request->query('tag')) : 0;
        $tags_select = Tag::all();

        $data = [
            'address' => $address,
            'month' => $month,
            'price' => $price,
            'tag' => $tag
        ];

        $data_place_hot = [
            'address' => null,
            'month' => 0,
            'price' => null,
            'tag' => 0
        ];

        $places = $this->placeService->search($data)->paginate(10);
        $places_hot = $this->placeService->search($data_place_hot)->orderBy('user_place_votes_avg_vote', 'desc')->take(3)->get();

        if ($request->ajax()) {
            return view('user.pages.components.place.list', compact('places', 'address', 'month', 'price', 'tag', 'tags_select', 'places_hot'));
        }

        return view('user.pages.home.index', compact('places', 'address', 'month', 'price', 'tag', 'tags_select', 'places_hot'));
    }
}
