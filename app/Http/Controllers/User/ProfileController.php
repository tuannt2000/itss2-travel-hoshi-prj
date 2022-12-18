<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\ChangePasswordRequest;
use App\Services\Interfaces\UserService;
use App\Http\Requests\User\Auth\EditRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('user.pages.profile.index');
    }

    public function edit(EditRequest $request)
    {
        $validated = $request->validated();

        $user = $this->userService->find(Auth::user()->id);
       
        if ($user->update($validated)) {
            return back()->with('success', 'Update thành công');
        }

        return back()->with('error', 'Update thất bại!');
    }

    public function changePassword(ChangePasswordRequest $request) 
    {
        $validated = $request->validated();

        if (!Hash::check($validated['old_password'], Auth::user()->password)) {
            return back()->with('error', 'Mật khẩu cũ không chính xác!');
        }

        if ($validated['new_password'] != $validated['confirm_password']) {
            return back()->with('error', 'Nhập lại mật khẩu không chính xác!');
        }

        if (Hash::check($validated['new_password'], Auth::user()->password)) {
            return back()->with('error', 'Mật khẩu mới phải khác mật khẩu cũ!');
        }

        $user = $this->userService->find(Auth::user()->id);
       
        if ($this->userService->updateUser($user, $validated)) {
            return back()->with('success', 'Change password thành công');
        }

        return back()->with('error', 'Change password thất bại!');
    }
}
