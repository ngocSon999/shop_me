<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BankRepoInterface;
use App\Http\Services\BannerServiceInterface;
use App\Http\Services\CategoryServiceInterface;
use App\Http\Services\FeedbackServiceInterface;
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

    protected BankRepoInterface $bankRepository;

    protected FeedbackServiceInterface $feedbackService;

    public function __construct(
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService,
        BannerServiceInterface $bannerService,
        OrderServiceInterface $orderService,
        BankRepoInterface $bankRepository,
        FeedbackServiceInterface $feedbackService
    )
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->bannerService = $bannerService;
        $this->orderService = $orderService;
        $this->bankRepository = $bankRepository;
        $this->feedbackService = $feedbackService;
    }

    public function index(): View
    {
        $categories = $this->categoryService->getAll();
        $products = $this->productService->getAll();
        $banners = $this->bannerService->getAll();
        $feedbacks = $this->feedbackService->show();

        return view('frontend.page.home', compact(
            'categories',
            'products',
            'banners',
            'feedbacks'
        ));
    }

    public function getProductBySlugCategory($slug): View
    {
        $categories = $this->categoryService->getAll();
        $products = $this->productService->getProductBySlugCategory($slug);
        $banners = $this->bannerService->getAll();
        $feedbacks = $this->feedbackService->show();

        return view('frontend.page.product_by_category', compact(
            'categories',
            'products',
            'slug',
            'banners',
            'feedbacks'

        ));
    }

    public function showProduct($id): View
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

    /**
     * @param $slug
     * page recharge coin
     */
    public function getRecharge($slug): View
    {
        $code = Auth::user()->code;
        $banks = $this->bankRepository->getAll();

        return view('frontend.page.recharge', compact('slug', 'code', 'banks'));
    }

    public function exampleCkeditor()
    {
        return view('frontend.editor');
    }
}
