<?php
namespace App\Http\Services\Impl;

use App\Http\Repositories\ProductRepoInterface;
use App\Http\Services\ProductServiceInterface;
use App\Models\Product;
use App\Traits\StorageTrait;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class ProductService extends BaseService implements ProductServiceInterface
{
    use StorageTrait;
    protected ProductRepoInterface $productRepository;

    public function __construct(ProductRepoInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @throws \Exception
     */
    public function store($request)
    {
        $data = $this->formatDataCreateAndUpdateProduct($request);

        $currentUser = Sentinel::check();
        $data['created_by'] = $currentUser->email;

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
                    'status' => $request->status,
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

    /**
     * @throws \Exception
     */
    public function update($request, Product $product)
    {
        $data = $this->formatDataCreateAndUpdateProduct($request);
        $oldImage = '';
        if ($request->hasFile('image')) {
            if (!empty($product->image)) {
                $oldImage = public_path($product->image);
            }
        }

        $currentUser = Sentinel::check();
        $data['updated_by'] = $currentUser->email;

        $product = $this->productRepository->update($data, $product->id, Product::class);

        if (!empty($oldImage)) {
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }
        if (!empty($request->category_id)) {
            $product->categories()->sync($request->category_id);
        }

        return $product;
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function getDataAjaxByCategory($categoryId)
    {
        return $this->productRepository->getDataByCategory($categoryId);
    }

    public function getProductBySlugCategory($slug)
    {
        return $this->productRepository->getDataBySlugCategory($slug);
    }

    public function sellProduct($id)
    {
        $this->productRepository->sellProduct($id);
    }

    /**
     * @throws \Exception
     */
    public function formatDataCreateAndUpdateProduct($request): array
    {
        if (!empty($request->image)) {
            $resultPath = $this->storageTraitUpload($request, 'image','products');
        }
        $data = [
            'name' => $request->name,
            'title' => $request->title ?? '',
            'description' => $request->description ?? '',
            'price' => $request->price ?? 0,
            'quantity' => $request->quantity ?? 0,
            'status' => $request->status ?? 1,
        ];

        if (!empty($resultPath)) {
            $data['image'] = $resultPath['file_path'];
        }

        return $data;
    }

    public function addDiscountPrice(int $discountPrice): void
    {
        $products = $this->productRepository->GetListOfUnsoldProducts();
        foreach ($products as $product) {
            $product->discount_price = $discountPrice;
            $product->save();
        }
    }

    public function getProductRelated(string $slugCategory) {
        return $this->productRepository->getProductRelatedBySlugCategory($slugCategory);
    }
}
