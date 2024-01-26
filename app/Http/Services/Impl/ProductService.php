<?php
namespace App\Http\Services\Impl;

use App\Http\Repositories\ProductRepoInterface;
use App\Http\Services\ProductServiceInterface;
use App\Models\Category;
use App\Models\Product;
use App\Traits\StorageTrait;
use Illuminate\Support\Str;

class ProductService extends BaseService implements ProductServiceInterface
{
    use StorageTrait;
    protected ProductRepoInterface $productRepository;

    public function __construct(ProductRepoInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function store($request)
    {
        if (!empty($request->image)) {
            $resultPath = $this->storageTraitUpload($request, 'image','products');
        }
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'active' => $request->active ? 1 : 0,
        ];

        if (!empty($resultPath)) {
            $data['image'] = $resultPath['file_path'];
        }

        $product = $this->productRepository->store($data, Product::class);

        $product->categories()->attach($request->category_id);

        return $product;
    }

    public function getList($request): array
    {
        $filter = [
            'filter' => [
                'searchColumns' => [
                    'name',
                    'description'
                ],
                'inputFields' => [
                    'name' => $request->name,
                    'active' => $request->status,
                ],
                'start_date' => [
                    'created_at' => $request->start_date,
                ],
                'end_date' => [
                    'created_at' => $request->end_date,
                ],
            ]
        ];

        if(!empty($request->input('category_id'))) {
            $filter['filter']['whereHas'] = [
                'categories' => [
                    'category_id' => $request->category_id
                ]
            ];
        }
        $request->merge($filter);

        $request->merge([
            'withRelation' => ['categories']
        ]);

        return $this->getDataBuilder($request, Product::class);
    }

    public function getById($id)
    {
        return $this->productRepository->getById($id, Product::class);
    }

    public function update($request, $id)
    {
        if (!empty($request->image)) {
            $resultPath = $this->storageTraitUpload($request, 'image','products');
        }
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'active' => $request->active ? 1 : 0,
        ];

        if (!empty($resultPath)) {
            $data['image'] = $resultPath['file_path'];
        }

        $product = $this->productRepository->update($data, $id, Product::class);
        if (!empty($request->category_id)) {
            $product->categories()->sync($request->category_id);
        }

        return $product;
    }

    public function delete($id = null): void
    {
        $this->productRepository->delete($id, Product::class);
    }
}
