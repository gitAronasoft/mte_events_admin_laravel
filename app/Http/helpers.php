<?php
use App\Models\Setting;

if (! function_exists('globalSetting')) {
    function globalSetting($key)
    {    	 
        $settings = Setting::findOrFail('1');
        return $settings->$key;
    }
}