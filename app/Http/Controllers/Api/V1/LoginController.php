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
        
        try { 
            if($request->provider == 'apple'){ 

                // if the provider == apple we need the (id) which is appleid to find the user and the email maybe dummy mail so skip it 
                $rules = [ 
                    'provider' => 'in:facebook,google,apple', 
                    'id' => 'required', 
                    'email' => 'nullable|email', 
                ];
        
                $validator = Validator::make($request->all(), $rules);
        
                if ($validator->fails()) {
                    return $this->returnError('401', $validator->errors());
                }

                $provider_id = $request->id;
                $provider_email = $request->email;

                // check if there is user with this apple id
                $existingUser = User::where('provider_id', $provider_id)->first();  
            }else{
                $rules = [ 
                    'provider' => 'in:facebook,google,apple', 
                    'token' => 'required',
                ];
        
                $validator = Validator::make($request->all(), $rules);
        
                if ($validator->fails()) {
                    return $this->returnError('401', $validator->errors());
                }
                $user_social = Socialite::driver($request->provider)->userFromToken($request->token);
                $provider_id = $user_social->id;
                $provider_email = $user_social->email; 
                
                // check if they're an existing user
                $existingUser = User::where('provider_id', $provider_id)->orWhere('email', $provider_email)->first();
            }
        } catch (\Exception $ex) { 
            return $this->returnError('501','Something Went Wrong , Try Again later!');
        } 


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

            $rules = [  
                'email' => 'nullable|email|unique:users,email', 
            ];
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            }
            // create a new user
            $user = User::create([
                'name' => $user_social->name ?? '',
                'email' => $provider_email,
                'provider_id' => $provider_id,
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
