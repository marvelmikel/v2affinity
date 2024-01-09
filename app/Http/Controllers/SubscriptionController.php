<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        if($subscription->user_id === auth()->user()->id){
            return view('voyager::company.subscription-edit')->with('subscription', $subscription);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
