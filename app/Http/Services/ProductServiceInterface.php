<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

interface ProductServiceInterface extends BaseServiceInterface
{
    public function store(Request $request);

    public function getList(Request $request): array;

    public function getById(int $id);

    public function update(Request $request, int $id);

    public function delete(int $id);
    public function getAll();

    public function getDataAjaxByCategory($categoryId);
    public function getProductBySlugCategory($slug);
}
