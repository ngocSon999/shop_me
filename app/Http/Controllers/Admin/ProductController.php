<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Services\CategoryServiceInterface;
use App\Http\Services\ProductServiceInterface;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected  CategoryServiceInterface $categoryService;
    protected  ProductServiceInterface $productService;

    public function __construct(
        ProductServiceInterface $productService,
        CategoryServiceInterface $categoryService
    )
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = $this->categoryService->getAll();

        return view('admins.products.index', compact('categories'));
    }

    public function createForm($productId = null): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $product = $productId ? $this->productService->getById($productId) : null;
        $categories = $this->categoryService->getAll();

        return view('admins.products.form_create', compact('categories', 'product'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->productService->store($request);
            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Tạo sản phẩm thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error create product: '. $e->getMessage());

            return redirect()->route('admin.products.index')->with('error', 'Có lỗi xảy ra vui lòng thử lại sau');
        }
    }

    public function getList(Request $request): JsonResponse
    {
        $data = $this->productService->getList($request);

        return response()->json($data);
    }

    public function edit(Product $product): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = $this->categoryService->getAll();

        return view('admins.products.form_create', compact('product', 'categories'));
    }

    public function update(Product $product, ProductRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->productService->update($request, $product);
            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'update sản phẩm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update product: '. $e->getMessage());

            return redirect()->route('admin.products.index')->with('error', 'Có lỗi xảy ra vui lòng thử lại sau');
        }
    }

    public function delete(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công!');
    }
}
