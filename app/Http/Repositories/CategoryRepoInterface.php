<?php

namespace App\Http\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepoInterface extends BaseRepoInterface
{
    public function getList(): Collection;

    public function getBySlug(string $slug): Category;
}
