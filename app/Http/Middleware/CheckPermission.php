<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;
use Illuminate\Http\Request;

class CheckPermission {
	/**
	 * Handle an incoming request.
	 *
	 * @param Request $request
	 * @param  \Closure                 $next
	 *
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next, $permission ): mixed
    {
        $userLogin= Sentinel::check();
        if (!$userLogin) {
            return redirect()->guest(route('admin.user.login'));
        }

        view()->share('userLogin', $userLogin);

        #This Is super-admin User?
        $roles = Sentinel::getRoles()->all();
        $roleSlug = array_map(function ($role) {
            return $role->slug;
        }, $roles);
        if (is_array($roleSlug) && in_array('super-admin', $roleSlug)) {
            return $next($request);
        }

        #Check Access When User Is Not super-admin
        $permissions = [];

        if ($roles) {
            foreach ($roles as $role) {
               foreach ($role->permissions ?? [] as $item) {
                   foreach ($item as $key => $value) {
                       $permissions[$key] = $value;
                   }
               }
            }
        }
        if (isset($permissions[$permission]) && $permissions[$permission]) {
            return $next($request);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response(trans('backpack::base.unauthorized'), 401);
        }

        return redirect()->back()->with('warning', 'Bạn không có quyền truy cập trang này');
	}
}
