<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BaseRepoInterface;
use App\Http\Repositories\RoleRepoInterface;
use App\Http\Requests\RoleRequest;
use App\Http\Services\BaseServiceInterface;
use App\Models\Role;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class RoleController extends Controller
{
    protected RoleRepoInterface $roleRepository;
    protected BaseServiceInterface $baseService;

    public function __construct(
        RoleRepoInterface $roleRepository,
        BaseServiceInterface $baseService,
    )
    {
        $this->roleRepository = $roleRepository;
        $this->baseService = $baseService;
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $roles = $this->roleRepository->getAll();

        return view('admins.roles.index', compact('roles'));
    }

    public function createForm(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $permissions = config('permission_roles.permissions');
        $dataPermission = [];
        foreach ($permissions as $key => $permission) {
            foreach ($permission as $k => $value) {
                $dataPermission[__($key)][$key.'.'.$k] =  __($value);
            }
        }

        return view('admins.roles.form_create', ['permissions' => $dataPermission]);
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        $permissions = [];
        if (!empty($request->permission)) {
            foreach ($request->permission as $item) {
                $permissions[$item] = true;
            }
        }
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->input('name'),
                'slug' => Str::slug($request->input('name')),
                'permissions' => $permissions,
            ];
            $this->roleRepository->store($data, Role::class);
            DB::commit();

            return redirect()->route('admin.roles.index')->with('success', 'Tạo Vai trò thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error create role: '. $e->getMessage());

            return redirect()->route('admin.roles.index')->with('error', 'Có lỗi xảy ra vui lòng thử lại sau');
        }
    }

    public function getList(Request $request): JsonResponse
    {
        $filter = [
            'filter' => [
                'searchColumns' => [
                    'name',
                ],
                'inputFields' => [
                    'id' => $request->input('role_id'),
                ]
            ]
        ];

        $request->merge($filter);
        if (!Sentinel::findRoleBySlug('super-admin')) {
            $request->merge([
                'whereExcept' => [
                    'slug' => 'super-admin',
                ]
            ]);
        }
        $data = $this->baseService->getDataBuilder($request, Role::class);

        return response()->json($data);
    }

    public function edit($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $role = $this->roleRepository->getById($id, Role::class);
        $permissions = config('permission_roles.permissions');
        $dataPermission = [];
        foreach ($permissions as $key => $permission) {
            foreach ($permission as $k => $value) {
                $dataPermission[__($key)][$key.'.'.$k] =  __($value);
            }
        }

        return view('admins.roles.form_create', [
            'role' => $role,
            'permissions' => $dataPermission
        ]);
    }

    public function update(RoleRequest $request, $id): RedirectResponse
    {
        $permissions = [];
        if (!empty($request->permission)) {
            foreach ($request->permission as $item) {
                $permissions[$item] = true;
            }
        }
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->input('name'),
                'slug' => Str::slug($request->input('name')),
                'permissions' => $permissions,
            ];
            $this->roleRepository->update($data, $id, Role::class);
            DB::commit();

            return redirect()->route('admin.roles.index')->with('success', 'Cập nhật Vai trò thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error create role: '. $e->getMessage());

            return redirect()->route('admin.roles.index')->with('error', 'Có lỗi xảy ra vui lòng thử lại sau');
        }
    }

    public function delete($id): RedirectResponse
    {
        $this->roleRepository->delete($id, Role::class);

        return redirect()->route('admin.roles.index')->with('success', 'Xóa vai trò thành công!');
    }
}
