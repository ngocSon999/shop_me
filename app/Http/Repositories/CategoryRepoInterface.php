<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface CategoryRepoInterface extends BaseRepoInterface
{
    public function getList(): Collection;
}
