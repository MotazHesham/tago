<?php

use Illuminate\Support\Facades\Route; 


Route::group(['prefix' => 'company' , 'as' => 'company.', 'namespace' => 'Company'], function () { 
    
    Route::group(['middleware' => ['company','auth']], function () {
        Route::get('dashboard','DashboardController@dashboard')->name('home'); 
        Route::post('media', 'DashboardController@storeMedia')->name('storeMedia');
        Route::post('ckmedia', 'DashboardController@storeCKEditorImages')->name('storeCKEditorImages');
        
        // Customers 
        Route::post('customers/qr_scanned', 'CustomersController@qr_scanned')->name('customers.qr_scanned');
        Route::post('customers/update_statuses', 'CustomersController@update_statuses')->name('customers.update_statuses');
        Route::resource('customers', 'CustomersController');
        
        // User Links
        Route::post('user-links/update_statuses', 'UserLinksController@update_statuses')->name('user-links.update_statuses');
        Route::resource('user-links', 'UserLinksController');
    });
});