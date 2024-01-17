<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        dd('sd');
        if (!Auth::guest()) {
            $user = Auth::user();
            if($user->subscription){
                dd('sd');
                return $next($request);
            }

        }
        
        $urlLogin = route('voyager.register');
        return redirect()->guest($urlLogin);
    }
}
