<?php

namespace App\Http\Helpers;

use App\Models\Setting;

class Helper
{
    protected static array $settings = [];

    /**
     *
     * @return array
     */
    public static function getListSetting(): array
    {
        if (empty(self::$settings)) {
            self::$settings = Setting::all()->toArray();
        }
        return self::$settings;
    }

    /**
     * Lấy một setting theo key.
     *
     * @param string $key
     * @return mixed
     */
    public static function getSetting(string $key): mixed
    {
        $settings = self::getListSetting();
        $filtered = array_filter($settings, function ($setting) use ($key) {
            return $setting['key'] == $key;
        });

        return !empty($filtered) ? array_values($filtered)[0]['value'] : '';
    }
}
