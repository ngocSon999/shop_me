<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface CategoryServiceInterface extends BaseServiceInterface
{
    public function store(Request $request);

    public function getList(Request $request): array;

    public function getById(int $id);

    public function update(Request $request, int $id);

    public function delete(int $id);

    public function getAll(): Collection;
}
