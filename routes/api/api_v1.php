<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'api/v1/', 'as' => 'api.', 'namespace' => 'Api\V1', 'middleware' => 'changelanguage'], function () {

    Route::post('login','UserAuthApiController@login'); 
    Route::post('register','UserAuthApiController@register');
    

    Route::group(['middleware' => ['auth:sanctum']],function () {

        Route::get('faq','FAQApiController@faq'); 
        Route::post('fcm-token','UsersApiController@update_fcm_token'); 

        //mainlinks
        Route::group(['prefix' =>'mainlinks'],function(){
            Route::get('/','MainLinksApiController@index');
            Route::post('add','MainLinksApiController@add'); 
            Route::get('delete/{id}','MainLinksApiController@delete');
        });

        //connections
        Route::group(['prefix' =>'connections'],function(){
            Route::get('/','ConnectionsApiController@index');
            Route::post('add','ConnectionsApiController@add');
            Route::post('update','ConnectionsApiController@update');
            Route::get('delete/{id}','ConnectionsApiController@delete');
        });

        //user profile
        Route::group(['prefix' =>'profile'],function(){
            Route::get('/','UsersApiController@profile');
            Route::post('update','UsersApiController@update');
            Route::post('update_active','UsersApiController@update_active');
            Route::post('update_link','UsersApiController@update_link');
            Route::post('update_priority','UsersApiController@update_priority');
            Route::post('update_password','UsersApiController@update_password');
            Route::post('update_profile','UsersApiController@update_profile');
        });
    });
});