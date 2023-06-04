<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Main Links
    Route::post('main-links/media', 'MainLinksApiController@storeMedia')->name('main-links.storeMedia');
    Route::apiResource('main-links', 'MainLinksApiController');

    // User Links
    Route::post('user-links/media', 'UserLinksApiController@storeMedia')->name('user-links.storeMedia');
    Route::apiResource('user-links', 'UserLinksApiController');

    // Connections
    Route::post('connections/media', 'ConnectionsApiController@storeMedia')->name('connections.storeMedia');
    Route::apiResource('connections', 'ConnectionsApiController');
});
