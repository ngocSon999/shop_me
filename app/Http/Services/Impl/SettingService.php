<?php
namespace App\Http\Services\Impl;

use App\Http\Repositories\SettingRepoInterface;
use App\Http\Services\SettingServiceInterface;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;

class SettingService extends BaseService implements SettingServiceInterface
{
    protected SettingRepoInterface $settingRepository;

    public function __construct(SettingRepoInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * @throws \Exception
     */
    public function update(string $value, $id): void
    {
        $this->settingRepository->update(['value' => $value], $id, Setting::class);
    }

    public function getSetting(string $slug): Collection
    {
        return $this->settingRepository->getSetting($slug);
    }
}
