<?php

use Illuminate\Support\Facades\Route; 

Route::get('menu/{link}','MenuClient\DashboardController@menu')->name('menu'); 
Route::get('check_subscription','MenuClient\DashboardController@check_subscription')->name('check_subscription'); 

Route::group(['prefix' => 'menu-client' , 'as' => 'menuClient.', 'namespace' => 'MenuClient'], function () {

    Route::get('theme/{id}','MenuThemeController@menu_theme')->name('theme'); 
    Route::post('show_photos', 'DashboardController@show_photos')->name('show_photos');
    
    Route::group(['middleware' => ['menuClient','auth']], function () {
        Route::get('dashboard','DashboardController@dashboard')->name('home'); 
        Route::get('settings','DashboardController@settings')->name('settings'); 
        Route::post('update_settings','DashboardController@update_settings')->name('update_settings'); 
        Route::post('settings/media', 'DashboardController@storeMedia')->name('settings.storeMedia');
        Route::post('settings/ckmedia', 'DashboardController@storeCKEditorImages')->name('settings.storeCKEditorImages');
        Route::post('show_qr_code', 'DashboardController@show_qr_code')->name('show_qr_code');

        // Menus
        Route::get('menus/active/{id}', 'MenuThemeController@menu_active')->name('menus.active');
        Route::post('menus/media', 'MenuThemeController@storeMedia')->name('menus.storeMedia');
        Route::post('menus/ckmedia', 'MenuThemeController@storeCKEditorImages')->name('menus.storeCKEditorImages');
        Route::resource('menus', 'MenuThemeController');
        
        // Menu Categories
        Route::delete('menu-categories/destroy', 'MenuCategoriesController@massDestroy')->name('menu-categories.massDestroy');
        Route::post('menu-categories/media', 'MenuCategoriesController@storeMedia')->name('menu-categories.storeMedia');
        Route::post('menu-categories/ckmedia', 'MenuCategoriesController@storeCKEditorImages')->name('menu-categories.storeCKEditorImages');
        Route::resource('menu-categories', 'MenuCategoriesController');
    
        // Menu Products
        Route::delete('menu-products/destroy', 'MenuProductsController@massDestroy')->name('menu-products.massDestroy');
        Route::post('menu-products/media', 'MenuProductsController@storeMedia')->name('menu-products.storeMedia');
        Route::post('menu-products/ckmedia', 'MenuProductsController@storeCKEditorImages')->name('menu-products.storeCKEditorImages');
        Route::resource('menu-products', 'MenuProductsController');
    });
});