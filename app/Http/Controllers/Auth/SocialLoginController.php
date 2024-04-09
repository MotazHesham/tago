<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Traits\api_return;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    use api_return;  

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectToProvider($provider)
    {
        Session::put('link', url()->previous());
        return Socialite::driver($provider)->redirect();
    }

    
    public function handleProviderCallback(Request $request, $provider)
    { 
        try {
            if ($provider == 'twitter') {
                $user = Socialite::driver('twitter')->user();
            } else {
                $user = Socialite::driver($provider)->stateless()->user();
            }
        } catch (\Exception $e) {
            alert("Something Went wrong. Please try again.",'','error');
            return redirect()->route('login');
        } 

        // check if they're an existing user
        $existingUser = User::where('provider_id', $user->id)->orWhere('email', $user->email)->first();

        if ($existingUser) {
            // log them in
            if($existingUser->user_type == 'customer'){  
                if(in_array(strtolower($provider), ['google-web'])) {
                    auth()->login($existingUser, true); 
                }else{
                    $token = $existingUser->createToken('user_token')->plainTextToken; 
                    $user_id = $existingUser->id;
                }
            }else{  
                if(in_array(strtolower($provider), ['google-web'])) { 
                    alert(__('This Account Exisit As ' . $existingUser->user_type . ' Account Use Diffrent Account To Register'),'','error');
                    return redirect()->route('login');
                }else{
                    return $this->returnError('401', __('This Account Exisit As ' . $existingUser->user_type . ' Account Use Diffrent Account To Register'));
                }
            }
        } else {
            // create a new user
            $newUser = new User;
            $newUser->name = $user->name;
            $newUser->email = $user->email; 
            $newUser->provider_id = $user->id;
            $newUser->user_type = 'customer'; 
            $newUser->save();  

            if(in_array(strtolower($provider), ['google-web'])) { 
                auth()->login($newUser, true);
            }else{
                $token = $newUser->createToken('user_token')->plainTextToken; 
                $user_id = $newUser->id;
            }
        }

        if(in_array(strtolower($provider), ['google-web'])) {
            if (Session::get('link') != null) {
                return redirect(Session::get('link'));
            } else {
                return redirect()->route('home');
            }
        }else{
            return $this->returnData(
                [
                    'user_token' => $token,
                    'user_id '=> $user_id, 
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
