<?php

use App\Http\Resources\V1\UserResource;
use App\Models\Connection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'frontend.', 'namespace' => 'Frontend'], function () {
    Route::get('user/{id}',function($id){
        $user = User::with(['media','userUserLinks' => function($q){
            $q->where('active',1)->orderBy('priority','asc');
        }])->find($id);
        return view('frontend.profile',compact('user'));
    })->name('user');

    Route::post('exchange_contacts',function(Request $request){
        Connection::create($request->all()); 
        $user = User::find($request->user_id);
        if($user && $user->fcm_token != null){
            Http::withHeaders([
                'Authorization' => 'key='.config('app.fcm_token_key'),
                'Content-Type' =>   'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', [
                "to" => $user->fcm_token,
                "collapse_key" => "type_a",
                "notification" => [
                    "title"=> $request->name,
                    "body" => 'Want To Exchange Contact With You'
                ]
            ]);
        }
        
        return redirect()->back();
    })->name('exchange_contacts');

    Route::get('privacy',function(){
        return view('frontend.privacy');
    });
});