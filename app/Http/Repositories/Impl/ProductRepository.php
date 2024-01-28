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

    public function getAll()
    {
        return Product::where('active', 1)->paginate(6);
    }

    public function getDataByCategory($categoryId)
    {
        return Product::where('products.active', 1)->whereHas(
            'categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            }
        )->get();
    }

    public function getDataBySlugCategory($slug)
    {
        return Product::where('products.active', 1)->whereHas(
            'categories', function ($query) use ($slug) {
                $query->where('categories.slug', $slug);
            }
        )->paginate(12);
    }
}
