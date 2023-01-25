<?php

namespace App\Services;

use App\Models\UserPlaceVote;
use App\Services\BaseServiceImpl;
use App\Services\Interfaces\UserPlaceVoteService;
use Illuminate\Support\Facades\DB;

class UserPlaceVoteServiceImpl extends BaseServiceImpl implements UserPlaceVoteService
{
    public function __construct(UserPlaceVote $userPlaceVote)
    {
        $this->model = $userPlaceVote;
    }

    public function getPlaceVote($place_id, $user_id) {
        return $this->model->where('user_id', $user_id)
            ->where('place_id', $place_id)
            ->first();
    }

    public function getRatingPlace($place_id) {
        $rating_place = $this->model->select(DB::raw('round(AVG(vote), 1) as rating'))
            ->where('place_id', $place_id)
            ->groupBy('place_id')
            ->first();

        if ($rating_place) {
            return $rating_place->rating;
        }

        return 0;
    }
}
