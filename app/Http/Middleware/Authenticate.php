<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('web.login');
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param  Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws AuthenticationException
     */
    protected function unauthenticated($request, array $guards): void
    {
        Session::flash(
            'warning',
            'Vui lòng đăng ký tài khoản để sử dụng dịch vụ'
        );

        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request)
        );
    }
}
