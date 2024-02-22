<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface BannerRepoInterface extends BaseRepoInterface
{
    public function getAll();
}
