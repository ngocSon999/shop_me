<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Services\SentinelServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected SentinelServiceInterface $sentinelService;

    public function __construct(SentinelServiceInterface $sentinelService)
    {
        $this->sentinelService = $sentinelService;
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = $this->sentinelService->getAllUser($slug = '');
        $roles = $this->sentinelService->getAllRoles();

        return view('admins.users.index', compact('users', 'roles'));
    }

    public function getList(Request $request): JsonResponse
    {
        $data = $this->sentinelService->getDataUserAndSearch($request);

        return response()->json($data);
    }
    public function createForm(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $roles = $this->sentinelService->getRoles();

        return view('admins.users.create_user', compact('roles'));
    }

    public function create(UserRequest $request): RedirectResponse
    {
        $this->sentinelService->createUser($request);

        return redirect()->route('admin.dashboard')->with('success', 'Tạo tài khoản thành công');
    }

    public function edit(int $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = $this->sentinelService->editUser($id);
        $roles = $this->sentinelService->getAllRoles();

        return view('admins.users.create_user', compact('user','roles'));
    }

    public function update(UserRequest $request, int $id): RedirectResponse
    {
        $this->sentinelService->updateUserById($request, $id);

        return redirect()->route('admin.dashboard')->with('success', 'update tài khoản thành công');
    }

    public function delete(int $id): RedirectResponse
    {
        $this->sentinelService->deleteUserById($id);

        return redirect()->route('admin.users.index')->with('success', 'Xóa tài khoản thành công');
    }
}
