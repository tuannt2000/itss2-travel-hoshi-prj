<?php

namespace App\Services;

use App\Models\Place;
use App\Services\BaseServiceImpl;
use App\Services\Interfaces\PlaceService;


class PlaceServiceImpl extends BaseServiceImpl implements PlaceService
{
    public function __construct(Place $place)
    {
        $this->model = $place;
    }

    public function getAddressPlace($query = null)
    {
        $addresses = $this->model
            ->select('address')
            ->groupBy('address');

        if (!is_null($query)) {
            $addresses = $addresses->where('address', 'like', '%' . $query . '%');
        }

        return $addresses;
    }

    public function getPlaceByAddressName (string $addressName) {
        $places = $this->model->where('address', 'like', '%' . $addressName . '%')->get();

        return $places;
    }

    public function all() {
        $query = Place::query();
        return $query;
    }

    public function search($data = []) {
        $address = $data['address'] ?? null;
        $month = $data['month'] ?? 0;
        $price = $data['price'] ?? null;
        $tag = $data['tag'] ?? 0;
        $places = $this->model
            ->distinct()
            ->select([
                'places.*'
            ])
            ->with('placeImages')
            ->where(function ($query) use ($address) {
                $query->where('places.address', 'like', '%' . $address . '%')
                    ->orWhere('places.name', 'like', '%' . $address . '%');
            });

        if ($month != 0 || !is_null($price)) {
            $places = $places->join('blogs', 'blogs.place_id', '=', 'places.id');

            if ($month != 0) {
                $places = $places->where('blogs.season', ceil((int)$month/3));
            }

            if (!is_null($price)) {
                $places = $places->where('blogs.price', $price);
            }
        }

        if ($tag != 0) {
            $places = $places->whereIn('places.id', function ($query) use ($tag) {
                $query->select('place_tags.place_id')
                    ->from('place_tags')
                    ->whereIn('place_tags.tag_id', $tag)
                    ->groupBy('place_tags.place_id')
                    ->havingRaw('COUNT(place_tags.place_id) = ?', [count($tag)]);
            });
        }

        $places = $places->paginate(10);

        return $places;
    }

    public function getPlaceByname ($place) {
        $places = $this->model->where('name', 'like', '%' . $place . '%')->first();

        return $places;
    }
}
