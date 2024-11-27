<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\Customer;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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


    public function forgotPassword(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('frontend.login.forgot_password');
    }

    public function formResetPassword(Request $request): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        if (!$request->has('token')) {
            abort(404);
        }
        return view('frontend.login.reset_password', ['token' => $request->token]);
    }

    public function sendMailResetPassword(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);
        $customer = Customer::where('email', $request->get('email'))->first();
        if (!$customer) {
            return redirect()->back()->with('warning', 'Email không tồn tại trong hệ thống!');
        }

        $token = Str::random(60);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $customer->email],
            [
                'token' => $token,
                'expired_at' => now()->addMinutes(config('auth.passwords.customers.expire'))
            ]
        );
        $url = route('web.form_reset_password') . '?token=' . $token;

        Mail::to($customer->email)->send(new ResetPassword($customer,$url));

        return redirect()->back()->with('success', 'Link đặt lại mật khẩu đã được gửi vào email của bạn!');
    }

    public function storeResetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|max:32',
            'password_confirmation' => 'required|same:password'
        ]);

        DB::beginTransaction();
        try {
            $resetPassword = DB::table('password_reset_tokens')
                ->where('token', $request->token)
                ->where('expired_at', '>=', now())
                ->first();
            if (!$resetPassword) {
                return redirect()->back()->with('warning', 'Token expired!');
            }

            $customer = Customer::where('email', $resetPassword->email)->first();
            $customer->update([
                'password' => Hash::make($request->password)
            ]);
            DB::table('password_reset_tokens')
                ->where('token', $request->token)
                ->delete();
            DB::commit();

            Auth::login($customer);

            return redirect()->route('web.index')->with('success', 'Password reset successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('warning', $e->getMessage());
        }
    }
}
