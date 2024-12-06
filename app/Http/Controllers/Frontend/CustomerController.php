<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CustomerRepoInterface;
use App\Http\Requests\CustomerRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    protected CustomerRepoInterface $customerRepository;

    public function __construct(
        CustomerRepoInterface $customerRepository,
    )
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @return View|Application|Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function createForm(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('frontend.customer.create_form');
    }

    public function store(CustomerRequest $request): RedirectResponse
    {
        try {
            $this->customerRepository->register($request);

            return redirect()->route('web.index')->with('success', 'Đăng ký tài khoản thành công');
        } catch (\Exception $e) {
            log::error('register customer'. $e->getMessage());

            return redirect()->route('web.index')->with('warning', 'Có lỗi xảy ra vui  lòng thử lại');
        }
    }

    public function history(): View
    {
        $customer = Auth::user();
        $transactionHistories = $customer->customerHistory;
        $products = $customer->products;
        $cards = $customer->cards;

        return view(
            'frontend.page.customer_history',
            compact('transactionHistories', 'products', 'cards')
        );
    }

    public function markAsRead(Request $request): JsonResponse
    {
        $notificationId = $request->get('notification_id');
        DB::table('notifications')->where('id', $notificationId)->update(['read_at' => now()]);
        $customer = Auth::user();
        $totalNotify = $customer->unreadNotifications->count();

        return response()->json([
            'code' => 200,
            'totalNotifications' => $totalNotify,
        ]);
    }

    public function profile(): View
    {
        $customer = Auth::user();

        return view('frontend.page.profile', compact('customer'));
    }

    public function update(CustomerRequest $request): RedirectResponse
    {
        try {
            $this->customerRepository->updateProfile($request);

            return redirect()->route('web.customers.profile')->with('success', 'Cập nhật thông tin thành công');
        } catch (\Exception $e) {
            log::error('update profile'. $e->getMessage());

            return redirect()->route('web.customers.profile')->with('warning', 'Có lỗi xảy ra vui lòng thử lại');
        }
    }
}
