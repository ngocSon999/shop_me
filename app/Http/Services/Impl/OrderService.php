<?php

namespace App\Http\Services\Impl;


use App\Http\Repositories\CustomerRepoInterface;
use App\Http\Repositories\ProductRepoInterface;
use App\Http\Services\OrderServiceInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService implements OrderServiceInterface
{
    protected ProductRepoInterface $productRepository;
    protected CustomerRepoInterface $customerRepository;

    public function __construct(
        ProductRepoInterface $productRepository,
        CustomerRepoInterface $customerRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->customerRepository = $customerRepository;
    }
    public function sellProduct($id): bool
    {
        $product = $this->productRepository->getByIdActive($id);
        $user = Auth::user();

        if ($user->coin < $product->price) {
            return false;
        }

        try {
            DB::beginTransaction();
            $product = $this->productRepository->update(
                [
                    'active' => 0,
                    'customer_id' => $user->id,
                ],
                $id,
                Product::class
            );
            $this->customerRepository->exchangeCoin($product->price);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error sell product customer = '.$user->email .' message error'.$e->getMessage());

            return false;
        }
    }
}
