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
        Route::get('edit_all_users', 'CustomersController@edit_all_users')->name('customers.edit_all_users');
        Route::post('customers/update_all', 'CustomersController@update_all')->name('customers.update_all');
        Route::resource('customers', 'CustomersController');
        
        // User Links
        Route::get('edit_all_links', 'UserLinksController@edit_all_links')->name('user-links.edit_all_links');
        Route::post('user-links/update_all', 'UserLinksController@update_all')->name('user-links.update_all');
        Route::post('user-links/update_statuses', 'UserLinksController@update_statuses')->name('user-links.update_statuses');
        Route::resource('user-links', 'UserLinksController');

        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            // Change password 
            Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
            Route::post('password', 'ChangePasswordController@update')->name('password.update');
            Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');  
        });
    });
});