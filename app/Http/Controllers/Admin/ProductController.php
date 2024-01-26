<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoryServiceInterface;
use App\Http\Services\ProductServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

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

    public function index(): \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = $this->categoryService->getAll();

        return view('admins.products.index', compact('categories'));
    }

    public function createForm(): \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = $this->categoryService->getAll();

        return view('admins.products.form_create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $this->productService->store($request);

            return redirect()->route('admin.products.index')->with('success', 'Tạo sản phẩm thành công');
        } catch (\Exception $e) {
            Log::error('Error create product: '. $e->getMessage());

            return redirect()->route('admin.products.index')->with('error', 'Có lỗi xảy ra vui lòng thử lại sau');
        }
    }

    public function getList(Request $request): JsonResponse
    {
        $data = $this->productService->getList($request);

        return response()->json($data);
    }

    public function edit($id): \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $product = $this->productService->getById($id);
        $categories = $this->categoryService->getAll();

        return view('admins.products.form_create', compact('product', 'categories'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $this->productService->update($request, $id);

            return redirect()->route('admin.products.index')->with('success', 'update sản phẩm thành công!');
        } catch (\Exception $e) {
            Log::error('Error update product: '. $e->getMessage());

            return redirect()->route('admin.products.index')->with('error', 'Có lỗi xảy ra vui lòng thử lại sau');
        }
    }

    public function delete($id): RedirectResponse
    {
        $this->productService->delete($id);

        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công!');
    }
}
