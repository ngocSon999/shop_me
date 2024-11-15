<?php
namespace App\Http\Services\Impl;

use App\Http\Repositories\SettingRepoInterface;
use App\Http\Services\SettingServiceInterface;
use App\Models\Setting;
use App\Traits\StorageTrait;
use Illuminate\Database\Eloquent\Collection;

class SettingService extends BaseService implements SettingServiceInterface
{
    use StorageTrait;
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

    /**
     * @throws \Exception
     */
    public function updateLogo(int $id, $request): void
    {
        $files = $request->allFiles();
        if (!empty($files)) {
            foreach ($files as $name => $file) {
                // Tên input
                $fileName = $name;
                $result = $this->storageTraitUpload($request, $fileName, 'settings');
                if ($result) {
                    $url = $result['file_path'];
                    $this->settingRepository->update(['value' => $url], $id, Setting::class);
                }
            }
        }
    }
}
