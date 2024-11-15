<?php
namespace App\Http\Repositories\Impl;

use App\Http\Repositories\SettingRepoInterface;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;

class SettingRepository extends BaseRepository implements SettingRepoInterface
{
    public const SETTING_MAIL = [
        'smtp_host',
        'smtp_port',
        'smtp_user',
        'smtp_password',
        'protocol',
    ];
    public const SETTING_CONTACT = [
        'phone',
        'email',
        'address',
    ];

    public function getSetting(string $slug): Collection
    {
        $query = Setting::query();

        switch ($slug) {
            case 'mail':
                $query->whereIn('key', self::SETTING_MAIL);
                break;
            default:
                $query->whereIn('key', self::SETTING_CONTACT);
        }

        return $query->get();
    }
}
