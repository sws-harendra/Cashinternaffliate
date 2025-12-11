<?php

use App\Models\Configuration;

if (!function_exists('config_value')) {
    function config_value($key, $default = null) {
        $config = Configuration::where('key', $key)->first();
        return $config ? $config->value : $default;
    }
}
