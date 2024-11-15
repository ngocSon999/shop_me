<?php

use App\Http\Helpers\Helper;

if (!function_exists('getSetting')) {
    /**
     * Hàm helper để gọi phương thức getSetting của Helper
     *
     * @param string $key
     * @return mixed
     */
    function getSetting(string $key): mixed
    {
        return Helper::getSetting($key);
    }
}
