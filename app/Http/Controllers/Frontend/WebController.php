<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\CategoryServiceInterface;
use App\Http\Services\ProductServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class WebController extends Controller
{
    protected CategoryServiceInterface $categoryService;
    protected ProductServiceInterface $productService;

    public function __construct(
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService
    )
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = $this->categoryService->getAll();
        $products = $this->productService->getAll();

        return view('frontend.page.home', compact('categories', 'products'));
    }

    public function getProductByCategory(Request $request)
    {
        $categoryId = $request->categoryId;

        $products = $this->productService->getDataAjaxByCategory($categoryId);
        dd($products->toArray());
    }

    public function getProductBySlugCategory($slug): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = $this->categoryService->getAll();
        $products = $this->productService->getProductBySlugCategory($slug);

        return view('frontend.page.product_by_category', compact('categories', 'products', 'slug'));
    }
}
