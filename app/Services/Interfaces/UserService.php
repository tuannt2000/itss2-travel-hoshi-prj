<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\BaseService;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface UserService extends BaseService
{
    public function create(array $data) : User;
    public function updateUser(Model $user, array $data);
    public function getListUser();
}
