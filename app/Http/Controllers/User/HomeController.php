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

        $places = $this->placeService->search($data);

        if ($request->ajax()) {
            return view('user.pages.components.place.list', compact('places', 'address', 'month', 'price', 'tag', 'tags_select'));
        }

        return view('user.pages.home.index', compact('places', 'address', 'month', 'price', 'tag', 'tags_select'));
    }
}
