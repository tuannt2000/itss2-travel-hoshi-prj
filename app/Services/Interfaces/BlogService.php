<?php

namespace App\Services\Interfaces;

use App\Services\Interfaces\BaseService;

interface BlogService extends BaseService
{
    public function getBlogNotApproved();
    public function getBlogApproved();
}
