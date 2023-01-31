<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use App\Models\UserBlogFavourite;
use App\Services\Interfaces\UserBlogFavouriteService;
use Illuminate\Http\Request;

class BlogFavouriteController extends Controller
{
    protected $userBlogFavouriteService;

    public function __construct(UserBlogFavouriteService $userBlogFavouriteService)
    {
        $this->userBlogFavouriteService = $userBlogFavouriteService;
    }

    public function like(Blog $blog)
    {
        $user = Auth::user();
        if($this->authorize('likeBlog', $blog))
        {
            $blogFavourite = UserBlogFavourite::firstOrCreate([
                'user_id'   => $user->id,
                'blog_id' => $blog->id
            ]);
        }
    }

    public function dislike(Blog $blog)
    {
        $user = Auth::user();
        // if ($user->cannot('likeBlog', $blog)) {
            $blogFavourite = UserBlogFavourite::firstOrCreate([
                'user_id'   => $user->id,
                'blog_id' => $blog->id
            ]);
            $blogFavourite->delete();
        // }
    }}
