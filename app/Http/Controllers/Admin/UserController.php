<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index () {
        $users = $this->userService->getListUser();
        return view('admin.pages.users.index', compact('users'));
    }

    public function delete(Request $request) {
        if ($this->userService->delete($request->id)) {
            return back()->with('success', 'Delete success');
        }

        return back()->with('error', 'Delete failed!');
    }
}
