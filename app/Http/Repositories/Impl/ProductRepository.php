<?php
namespace App\Http\Repositories\Impl;

use App\Http\Repositories\ProductRepoInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends BaseRepository implements ProductRepoInterface
{
    public function getList(): Collection
    {
        return Product::all();
    }
}
