<?php

use App\Config;

if (!function_exists("envdb")) {
    function envdb($key, $default = "")
    {
        try {
            $config = Config::find(1);
            return ($config->{$key} == null || $config->{$key} == "") ? $default : $config->{$key};
        } catch (\Exception $e) {
            return "-";
        }
    }
}
