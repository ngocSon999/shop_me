<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerAuthenticate
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('customers')->check()) {
            Session::flash(
                'warning',
                'Vui lòng đăng nhập hoặc đăng ký tài khoản để sử dụng dịch vụ'
            );

            return redirect()->route('web.login');
        }

        return $next($request);
    }
}
