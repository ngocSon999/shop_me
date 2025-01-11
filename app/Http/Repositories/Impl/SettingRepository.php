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

    public const SETTING_LOGO = [
        'logo_header',
        'logo_footer',
        'logo_favicon',
        'logo_page_admin',
    ];

    public const SETTING_NOTIFICATION = [
        'notify_page_title',
        'notify_page_content',
    ];

    public const SETTING_DESCRIPTION = [
        'description_footer',
        'description_about_us',
    ];

    public function getSetting(string $slug): Collection
    {
        $query = Setting::query();

        switch ($slug) {
            case 'mail':
                $query->whereIn('key', self::SETTING_MAIL);
                break;
            case 'logo':
                $query->whereIn('key', self::SETTING_LOGO);
                break;
            case 'notification':
                $query->whereIn('key', self::SETTING_NOTIFICATION);
                break;
            case 'description':
                $query->whereIn('key', self::SETTING_DESCRIPTION);
            break;
            default:
                $query->whereIn('key', self::SETTING_CONTACT);
        }

        return $query->get();
    }
}
