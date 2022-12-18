<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\BlogService;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\PlaceService;

class BlogController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    public function index () {
        $blogs = $this->blogService->all();
        return view('admin.pages.blogs.index', compact('blogs'));
    }

    public function myblog () {
        $user = Auth::user();
        $blogs = $user->blogs;
        return view('admin.pages.blogs.myblogs', compact('blogs'));
    }

    public function create () {
        // $places = $placeService->getAddressPlace();
        return view('admin.pages.blogs.create');
    }

    public function update ($id) {
        $blog = $this->blogService->find($id);
        return view('admin.pages.blogs.update', compact('blog'));
    }

    public function delete($id)
    {
        if ($this->blogService->delete($id)) {
            return redirect()->route('admin.blog')->with('success', 'Delete success');
        }

        return back()->with('error', 'Delete failed!');
    }
}
