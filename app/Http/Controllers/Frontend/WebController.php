<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BankRepoInterface;
use App\Http\Services\BannerServiceInterface;
use App\Http\Services\CategoryServiceInterface;
use App\Http\Services\ContactServiceInterface;
use App\Http\Services\FeedbackServiceInterface;
use App\Http\Services\OrderServiceInterface;
use App\Http\Services\ProductServiceInterface;
use Illuminate\Contracts\View\View;
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

    protected ContactServiceInterface $contactService;

    public function __construct(
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService,
        BannerServiceInterface $bannerService,
        OrderServiceInterface $orderService,
        BankRepoInterface $bankRepository,
        FeedbackServiceInterface $feedbackService,
        ContactServiceInterface $contactService
    )
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->bannerService = $bannerService;
        $this->orderService = $orderService;
        $this->bankRepository = $bankRepository;
        $this->feedbackService = $feedbackService;
        $this->contactService = $contactService;
    }

    public function index(): View
    {
        $banners = $this->bannerService->getAll();

        return view('frontend.page.home', compact('banners'));
    }

    public function getProductBySlugCategory($slug): View
    {
        $products = $this->productService->getProductBySlugCategory($slug);
        $banners = $this->bannerService->getAll();
        $categoryName = $this->categoryService->getBySlug($slug)->name;

        return view('frontend.page.product_by_category', compact(
            'products',
            'slug',
            'categoryName',
            'banners',
        ));
    }

    public function showProduct($id): View
    {
        $product = $this->productService->getById($id);
        $product->price = number_format($product->price, 0, ',', '.');

        $category = $product->categories->random();
        $products = $this->productService->getProductRelated($category->slug);

        return view('frontend.page.product_detail', compact('product', 'products'));
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
//        return view('frontend.editor');
    }

    public function getContact(): view
    {
        return view('frontend.page.contact');
    }

    public function storeContact(Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $validatedData  = $request->validate([
                'name' => 'required',
                'phone' => [
                    'required',
                    'regex:/^(0[3|5|7|8|9])[0-9]{8}$/',
                ],
                'email' => 'nullable|email',
                'subject' => 'required|max:255',
                'message' => 'required|max:500',
            ]);

            $this->contactService->store($validatedData);
            DB::commit();

            return redirect()->route('web.index')->with('success', 'Gửi liên hệ thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error store contact: '.$e->getMessage());

            return redirect()->back()->with('warning', 'Có lỗi xảy ra vui lòng thử lại');
        }
    }
}
