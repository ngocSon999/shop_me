<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Http\Services\BannerServiceInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    protected BannerServiceInterface $bannerService;

    public function __construct(BannerServiceInterface $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admins.banners.index');
    }

    public function createForm($bannerId = null): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $banner = $bannerId ? $this->bannerService->getById($bannerId) : null;

        return view('admins.banners.form_create', compact('banner'));
    }

    public function store(BannerRequest $request): RedirectResponse
    {
        try {
            $this->bannerService->store($request);

            return redirect()->route('admin.banners.index')->with('success', 'Tạo Banner thành công');
        } catch (\Exception $e) {
            Log::error('Error create banners: '. $e->getMessage());

            return redirect()->route('admin.banners.index')->with('error', 'Có lỗi xảy ra vui lòng thử lại sau');
        }
    }

    public function getList(Request $request): JsonResponse
    {
        $data = $this->bannerService->getList($request);

        return response()->json($data);
    }

    public function edit($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $banner = $this->bannerService->getById($id);

        return view('admins.banners.form_create', compact('banner'));
    }

    public function update(BannerRequest $request, $id): RedirectResponse
    {
        try {
            $this->bannerService->update($request, $id);

            return redirect()->route('admin.banners.index')->with('success', 'update banner thành công!');
        } catch (\Exception $e) {
            Log::error('Error update banners: '. $e->getMessage());

            return redirect()->route('admin.banners.index')->with('error', 'Có lỗi xảy ra vui lòng thử lại sau');
        }
    }

    public function delete($id): RedirectResponse
    {
        $this->bannerService->delete($id);

        return redirect()->route('admin.banners.index')->with('success', 'Xóa banner thành công!');
    }
}
