<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FrontendLoginController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('web.index');
        }

        return view('frontend.login.form_login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only(['email', 'password']);
        $customer = Customer::where('email', $credentials['email'])->first();

        if ($customer) {
            if ($customer->status == 0) {
                return redirect()->back()->with(
                    'warning',
                    'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ với quản trị viên để biết thêm chi tiết!'
                );
            }
        }

        if (Auth::guard('customers')->attempt($credentials)) {
            return redirect()->route('web.index');
        }

        return redirect()->back()->with(
            'warning',
            'Tài khoản hoặc mật khẩu không chính xác. Vui lòng kiểm tra lại!'
        );
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        Session::flush();

        return redirect()->route('web.index');
    }
}
