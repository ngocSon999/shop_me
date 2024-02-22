<?php

namespace App\Http\Repositories\Impl;

use App\Http\Repositories\BannerRepoInterface;
use App\Models\Banner;

class BannerRepository extends BaseRepository implements BannerRepoInterface
{
    public function getAll()
    {
        return Banner::where('active', 1)->get();
    }
}
