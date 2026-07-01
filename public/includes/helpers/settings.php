<?php

use App\Models\SiteSetting;

if (!function_exists('setting')) {

    function setting(string $key, string $default = ''): string
    {
        static $model = null;

        if ($model === null) {
            $model = new SiteSetting();
        }

        $value = $model->get($key, $default);

        return is_string($value) ? $value : $default;
    }
}
