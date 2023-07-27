<?php

use App\Models\Setting;

if (!function_exists('frontend_currency')) {
    function frontend_currency($value)
    {
        return [
            'as_text' => $value . ' EGP',
            'price' => $value,
            'symbol' => 'EGP',
        ];
    }
}

if (!function_exists('get_site_setting')) {
    function get_site_setting()
    {
        return Setting::first(); 
    }
} 

?>