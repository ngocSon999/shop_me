<?php
namespace App\Http\Repositories\Impl;

use App\Http\Repositories\ProductRepoInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductRepository extends BaseRepository implements ProductRepoInterface
{
    /** @var int */
    const ACTIVE = 1;
    public function getList(): Collection
    {
        return Product::all();
    }

    public function getAll()
    {
        return Product::where('active', 1)->paginate(12);
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

    public function sellProduct($id)
    {
        $product = Product::where('active', 1)->where('id', $id)->first();
        if (!$product) {
            abort(404);
        }

        try {
            $product->active = 0;
            $product->customer_id = Auth::user()->id;

            $product->save();

            return $product;
        } catch (\Exception $e) {
            Log::error('Error sell Product Id = '.$id.': '.$e->getMessage());

            return false;
        }
    }

    public function getByIdActive($id)
    {
        return Product::where('active', self::ACTIVE)->where('id', $id)->first();
    }
}
