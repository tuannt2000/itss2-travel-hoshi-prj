<?php

namespace App\Services;

use App\Models\User;
use App\Services\BaseServiceImpl;
use App\Services\Interfaces\UserService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl extends BaseServiceImpl implements UserService
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function create(array $data) : User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->model->create($data);
    }

    public function updateUser(Model $user, array $data)
    {
        $update['password'] = Hash::make($data['new_password']);
        return $user->update($update);
    }

    public function getListUser()
    {
        return $this->model->where('id', '!=', Auth::user()->id)->get();
    }
}
