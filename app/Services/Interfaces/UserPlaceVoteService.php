<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\BaseService;

interface UserPlaceVoteService extends BaseService
{
    public function getPlaceVote($place_id, $user_id);
    public function getRatingPlace($place_id);
}
