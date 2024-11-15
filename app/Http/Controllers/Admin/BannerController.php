<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Http\Services\BannerServiceInterface;
use App\Models\Banner;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    protected BannerServiceInterface $bannerService;

    public function __construct(BannerServiceInterface $bannerService)
    {
        $this->bannerService = $bannerService;
    }

    public function index(): View
    {
        return view('admins.banners.index');
    }

    public function createForm($bannerId = null): View
    {
        $banner = $bannerId ? $this->bannerService->getById($bannerId) : null;

        return view('admins.banners.form_create', compact('banner'));
    }

    public function store(BannerRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->bannerService->store($request);
            DB::commit();

            return redirect()->route('admin.banners.index')->with('success', 'Tạo Banner thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error create banners: '. $e->getMessage());

            return redirect()->route('admin.banners.index')->with('error', 'Có lỗi xảy ra vui lòng thử lại sau');
        }
    }

    public function getList(Request $request): JsonResponse
    {
        $data = $this->bannerService->getList($request);

        return response()->json($data);
    }

    public function edit(Banner $banner): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admins.banners.form_create', compact('banner'));
    }

    public function update(BannerRequest $request, Banner $banner): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->bannerService->update($request, $banner);
            DB::commit();

            return redirect()->route('admin.banners.index')->with('success', 'update banner thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update banners: '. $e->getMessage());

            return redirect()->route('admin.banners.index')->with('error', 'Có lỗi xảy ra vui lòng thử lại sau');
        }
    }

    public function delete(Banner $banner): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->bannerService->delete($banner);
            DB::commit();

            return redirect()->route('admin.banners.index')->with('success', 'Xóa banner thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error delete banners: '. $e->getMessage());

            return redirect()->route('admin.banners.index')->with('error', 'Có lỗi xảy ra vui lòng thử lại sau');
        }
    }
}
