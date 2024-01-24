<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormMail;
use App\Mail\ThankYouMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class ContactController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Send a contact form
     */
    public function contactForm(ContactFormRequest $request): RedirectResponse
{
    $fields = $request->all();

    //Validate reCAPTCHA response
    Validator::make($fields, [
        'g-recaptcha-response' => 'recaptcha',
    ])->validate();

    // if ($validator->fails()) {
    //     return redirect()->back()->withErrors(['recaptcha' => 'reCAPTCHA is required'])->withInput();
    // }
    
    // Send email to sales team
    Mail::to(['sales@logicbarn.com'])->send(new ContactFormMail($fields));

    // Send thank you message to user
    Mail::to($fields['email'])->send(new ThankYouMail($fields));

    return Redirect::route('home')->with('status', 'profile-updated');
}


}
