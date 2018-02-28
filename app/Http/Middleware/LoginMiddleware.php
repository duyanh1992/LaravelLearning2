<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //return $next($request);
		session_start();
		if(!isset($_SESSION['user_data'])){
			return redirect()->route('getLogin');
		}
		else{
			return $next($request);
		}
    }
}
