<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\api_return;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    
    use api_return;  
    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request)
    {
        $rules = [ 
            'provider' => 'in:facebook,google',
            'token' => 'required', 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        
        try {
            $user_social = Socialite::driver($request->provider)->userFromToken($request->token);
        } catch (\Exception $ex) {
            return $this->returnError('501','Something Went Wrong , Try Again later!');
        } 

        // check if they're an existing user
        $existingUser = User::where('provider_id', $user_social->id)->orWhere('email', $user_social->email)->first();

        if ($existingUser) {
            // log them in 
            $token = $existingUser->createToken('user_token')->plainTextToken; 
            return $this->returnData(
                [
                    'user_token' => $token,
                    'user_id '=> $existingUser->id, 
                ]
            );
        } else {
            // create a new user
            $user = User::create([
                'name' => $user_social->name,
                'email' => $user_social->email,
                'provider_id' => $user_social->id,
                'password' => null,
                'phone_number' => null, 
                'user_type' => 'customer',
            ]);   
            $token = $user->createToken('user_token')->plainTextToken; 
            return $this->returnData(
                [
                    'user_token' => $token,
                    'user_id '=> $user->id, 
                ]
            );
        } 
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
