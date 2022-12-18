<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserService;
use App\Http\Requests\User\Auth\EditRequest;
use Illuminate\Support\Facades\Auth;

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
            return back()->with('sucess', 'Update thành công');
        }

        return back()->with('errors', 'Update thất bại!');
    }
}
