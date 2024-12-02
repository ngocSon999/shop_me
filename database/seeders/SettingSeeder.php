<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    private array $settings = [
        ['key' => 'phone'],
        ['key' => 'email'],
        ['key' => 'address'],
        ['key' => 'smtp_host'],
        ['key' => 'smtp_user'],
        ['key' => 'smtp_password'],
        ['key' => 'smtp_port'],
        ['key' => 'protocol'],

        ['key' => 'logo_header'],
        ['key' => 'logo_footer'],
        ['key' => 'logo_favicon'],
        ['key' => 'logo_page_admin'],

        ['key' => 'notify_page_title'],
        ['key' => 'notify_page_content'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->settings as $setting) {
            $settingQuery = Setting::where('key', $setting['key'])->first();
            if (!$settingQuery) {
                Setting::create($setting);
            }
        }
    }
}
