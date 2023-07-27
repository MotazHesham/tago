<?php

use Illuminate\Support\Facades\Route;


Route::get('/','Frontend\HomeController@index')->name('home');  

Route::group(['as' => 'frontend.', 'namespace' => 'Frontend'], function () {

    Route::get('user/{id}','HomeController@user')->name('user'); 
    Route::post('exchange_contacts','HomeController@exchange_contact')->name('exchange_contacts');

    Route::get('privacy','HomeController@privacy')->name('privacy');
    Route::get('about','HomeController@about')->name('about');
    Route::get('tutorials','HomeController@tutorials')->name('tutorials');
    Route::get('contact','HomeController@contact')->name('contact');
    Route::post('contact','HomeController@contact_store')->name('contact');
    Route::post('subscribe','HomeController@subscribe_store')->name('subscribe');
    Route::get('products/{categoryId}','HomeController@products')->name('products');
    Route::get('product/{productId}','HomeController@product')->name('product');

    // Cart 
    Route::get('cart','CartController@cart')->name('cart');
    Route::post('checkout','OrderController@checkout')->name('checkout');
    Route::post('cart/store','CartController@store')->name('cart.store');
    Route::post('cart/update','CartController@update')->name('cart.update');
    Route::post('cart/delete','CartController@delete')->name('cart.delete');
    
    // Dashboard
    Route::group(['prefix' => 'dashboard', 'middleware' => ['auth','customer']], function () {
        Route::get('/','DashboardController@dashboard')->name('dashboard');
    
        Route::get('orders','OrderController@orders')->name('orders');

        Route::get('settings','DashboardController@settings')->name('settings');
    });
});

