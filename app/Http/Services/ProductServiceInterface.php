<?php

namespace App\Http\Services;

use App\Models\Product;
use Illuminate\Http\Request;

interface ProductServiceInterface extends BaseServiceInterface
{
    public function store(Request $request);

    public function getList(Request $request): array;

    public function getById(int $id);

    public function update(Request $request, Product $product);

    public function getAll();

    public function getDataAjaxByCategory($categoryId);
    public function getProductBySlugCategory($slug);
    public function sellProduct($id);

    public function formatDataCreateAndUpdateProduct($request): array;
}
