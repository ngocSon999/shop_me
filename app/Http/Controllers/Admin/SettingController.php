<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\SettingServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    protected SettingServiceInterface $settingService;

    public function __construct(SettingServiceInterface $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index($slug): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $settings = $this->settingService->getSetting($slug);

        return view('admins.settings.index', compact(['settings', 'slug']));
    }

    public function update($id, Request $request): RedirectResponse
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $this->settingService->update($data, $id);
            DB::commit();

            return redirect()->back()->with('success', 'Settings updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function updateLogo($id, Request $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $this->settingService->updateLogo((int) $id, $request);
            DB::commit();

            return redirect()->back()->with('success', 'Logo updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function updateAll(Request $request): RedirectResponse
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            if (!empty($data['id'])) {
                foreach ($data['id'] as $key => $value) {
                    $dataUpdate = [
                        'value' => $data['value'][$key],
                        'status' => $data['status'][$key],
                    ];
                    $this->settingService->update($dataUpdate, $value);
                }
                DB::commit();

                return redirect()->back()->with('success', 'Settings updated successfully');
            }

            return redirect()->back()->with('success', 'No settings to update');
        } catch (\Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
