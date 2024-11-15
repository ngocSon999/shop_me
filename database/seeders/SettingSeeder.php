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
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::truncate();
        Setting::insert($this->settings);
    }
}
