<?php

use Illuminate\Support\Facades\Route;


Route::get('/','Frontend\HomeController@index')->name('home');  

Route::group(['as' => 'frontend.', 'namespace' => 'Frontend'], function () {

    Route::get('/magico', 'MagicoController@magico')->name('magico');
    Route::get('/magico?template={template?}', 'MagicoController@magico')->name('magico.template');
    Route::get('/magico?order_template={order_template?}', 'MagicoController@magico')->name('magico.order');
    Route::post('/unsplash_loading_more_images', 'MagicoController@unsplash_loading_more_images')->name('unsplash_loading_more_images');
    Route::post('/unsplash_query_images', 'MagicoController@unsplash_query_images')->name('unsplash_query_images');
    Route::post('/pixabay_loading_images', 'MagicoController@pixabay_loading_images')->name('pixabay_loading_images');
    Route::post('/iconscout_loading_images', 'MagicoController@iconscout_loading_images')->name('iconscout_loading_images');
    Route::post('/pexels_loading_images', 'MagicoController@pexels_loading_images')->name('pexels_loading_images');
    Route::post('/upload_magico_images', 'MagicoController@upload_magico_images')->name('upload_magico_images');
    Route::post('/delete_upload_magico_images', 'MagicoController@delete_upload_magico_images')->name('delete_upload_magico_images');
    Route::post('/ordertemplate', 'MagicoController@ordertemplate')->name('ordertemplate'); 
    
    Route::get('user/{id}','HomeController@user')->name('user'); 
    Route::get('user/save_contact/{id}','HomeController@save_contact')->name('save_contact'); 
    Route::get('user/token/{token}','HomeController@user_by_token')->name('user_by_token'); 
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

