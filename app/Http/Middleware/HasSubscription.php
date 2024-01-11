<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HasSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!Auth::guest()) {
            $user = Auth::user();
            if($user->subscription){
                return $next($request);
            }
        }
        
        $urlLogin = route('voyager.register');
        return redirect()->guest($urlLogin);
    }
}
