<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Staff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { 
        if(Auth::user()->user_type == 'staff'){ 
            return $next($request);
        }elseif(Auth::user()->user_type == 'customer'){
            return redirect()->route('frontend.dashboard');
        }elseif(Auth::user()->user_type == 'client_menu'){
            return redirect()->route('menuClient.home');
        }elseif(Auth::user()->user_type == 'company'){
            return redirect()->route('company.home');
        }else{
            Auth::logout();
            return redirect()->route('home');
        }
    }
}
