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


if (!function_exists('partition')) {
    function partition( $list, $p ) {
        $listlen = count( $list );
        $partlen = floor( $listlen / $p );
        $partrem = $listlen % $p;
        $partition = array();
        $mark = 0;
        for ($px = 0; $px < $p; $px++) {
            $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
            $partition[$px] = array_slice( $list, $mark, $incr );
            $mark += $incr;
        }
        return $partition;
    }
} 

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ=#%$@&';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
?>