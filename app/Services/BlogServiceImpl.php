<?php

namespace App\Services;

use App\Models\Blog;
use App\Services\BaseServiceImpl;
use App\Services\Interfaces\BlogService;

class BlogServiceImpl extends BaseServiceImpl implements BlogService
{
    public function __construct(Blog $blog)
    {
        $this->model = $blog;
    }

    public function getBlogNotApproved()
    {
        return $this->model->where('status', 0)->get();
    }

    public function getBlogApproved()
    {
        return $this->model->where('status', 1)->get();
    }
}
