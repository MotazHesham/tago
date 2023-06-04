<?php

use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'frontend.', 'namespace' => 'Frontend'], function () {
    Route::get('user/{id}',function($id){
        $user = User::find($id);
        return response()->json(new UserResource($user));
    })->name('user');
});