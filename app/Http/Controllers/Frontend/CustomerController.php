<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CustomerRepoInterface;
use App\Http\Requests\CustomerRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
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
            $this->customerRepository->register($request->all());

            return redirect()->route('web.index')->with('success', 'Đăng ký tài khoản thành công');
        } catch (\Exception $e) {
            log::error('register customer'. $e->getMessage());

            return redirect()->route('web.index')->with('warning', 'Có lỗi xảy ra vui  lòng thử lại');
        }
    }
}
