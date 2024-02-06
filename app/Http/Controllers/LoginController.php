<?php

namespace App\Http\Controllers;

use Hydrat\Laravel2FA\TwoFactorAuth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /** [...] **/

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        # Trigger 2FA if necessary.
        if (TwoFactorAuth::getDriver()->mustTrigger($request, $user)) {
            return TwoFactorAuth::getDriver()->trigger($request, $user);
        }

        # If not, do the usual job.
        return redirect()->intended($this->redirectPath());
    }      
}
