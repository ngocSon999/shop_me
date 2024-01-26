<?php
namespace App\Http\Repositories\Impl;

use App\Http\Repositories\CategoryRepoInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseRepository implements CategoryRepoInterface
{
    public function getList(): Collection
    {
        return Category::all();
    }
}
