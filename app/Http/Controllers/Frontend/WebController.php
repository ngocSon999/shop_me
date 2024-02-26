<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\BannerServiceInterface;
use App\Http\Services\CategoryServiceInterface;
use App\Http\Services\OrderServiceInterface;
use App\Http\Services\ProductServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WebController extends Controller
{
    protected CategoryServiceInterface $categoryService;
    protected ProductServiceInterface $productService;
    protected BannerServiceInterface $bannerService;
    protected OrderServiceInterface $orderService;

    public function __construct(
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService,
        BannerServiceInterface $bannerService,
        OrderServiceInterface $orderService
    )
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->bannerService = $bannerService;
        $this->orderService = $orderService;
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = $this->categoryService->getAll();
        $products = $this->productService->getAll();
        $banners = $this->bannerService->getAll();

        return view('frontend.page.home', compact('categories', 'products', 'banners'));
    }

    public function getProductBySlugCategory($slug): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = $this->categoryService->getAll();
        $products = $this->productService->getProductBySlugCategory($slug);
        $banners = $this->bannerService->getAll();

        return view('frontend.page.product_by_category', compact('categories', 'products', 'slug', 'banners'));
    }

    public function showProduct($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $product = $this->productService->getById($id);

        return view('frontend.page.product_detail', compact('product'));
    }

    public function purchaseProduct(Request $request): RedirectResponse
    {
        try {
            $result = $this->orderService->sellProduct($request->input('product_id'));

            if ($result) {
                return redirect()->route('web.index')->with('success', 'Mua sản phẩm thành công. Vui lòng kiểm tra trong lịch sửa mua hàng của bạn');
            }

            return redirect()->back()->with('success', 'Bạn không đủ tiền mua sản phẩm này');

        } catch (\Exception $e) {
            Log::error('Error purchase product id: ');
            return redirect()->back()->with('error', 'Có lỗi xảy ra vui lòng thử lại');
        }
    }

    public function getRecharge($slug): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $rechargeName = 'Nạp Atm/Momo';
        if ($slug === 'nap-the-cao') {
            $rechargeName = 'Nạp thẻ cào';
        }
        $code = Auth::user()->code;

        return view('frontend.page.recharge', compact('slug', 'rechargeName', 'code'));
    }
}
