<?php
namespace App\Http\Services\Impl;

use App\Http\Repositories\CategoryRepoInterface;
use App\Http\Services\CategoryServiceInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class CategoryService extends BaseService implements CategoryServiceInterface
{
    protected CategoryRepoInterface $categoryRepository;

    public function __construct(CategoryRepoInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function store($request)
    {
        return $this->categoryRepository->store([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ], Category::class);
    }

    public function getList($request): array
    {
        $request->merge([
            'filter' => [
                'searchColumns' => [
                    'name',
                    'slug'
                ]
            ]
        ]);
        return $this->getDataBuilder($request, Category::class);
    }

    public function getById($id = null)
    {
        return $this->categoryRepository->getById($id, Category::class);
    }

    public function update($request = null, $id = null): void
    {
        $data = [
            'name' => $request->name,
            'slug' => str::slug($request->name),
        ];
        $this->categoryRepository->update($data, $id, Category::class);
    }

    public function delete($id = null): void
    {
        $this->categoryRepository->delete($id, Category::class);
    }

    public function getAll(): Collection
    {
        return $this->categoryRepository->getList();
    }
}
