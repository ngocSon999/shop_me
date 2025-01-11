<?php
namespace App\Http\Services\Impl;

use App\Http\Repositories\CategoryRepoInterface;
use App\Http\Services\CategoryServiceInterface;
use App\Models\Category;
use App\Traits\StorageTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class CategoryService extends BaseService implements CategoryServiceInterface
{
    use StorageTrait;
    protected CategoryRepoInterface $categoryRepository;

    public function __construct(CategoryRepoInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @throws \Exception
     */
    public function store($request)
    {
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ];
        if (!empty($request->image)) {
            $resultPath = $this->storageTraitUpload($request, 'image','categories');
            if ($resultPath) {
                $data['image'] =  $resultPath['file_path'];
            }
        }

        return $this->categoryRepository->store($data, Category::class);
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

    /**
     * @throws \Exception
     */
    public function update($request, $id): void
    {
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ];
        if (!empty($request->image)) {
            $resultPath = $this->storageTraitUpload($request, 'image','categories');
            if ($resultPath) {
                $data['image'] =  $resultPath['file_path'];
            }
        }
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

    public function getBySlug(string $slug): Category
    {
        return $this->categoryRepository->getBySlug($slug);
    }
}
