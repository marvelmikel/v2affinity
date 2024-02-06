<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\DataTables\CompanyDataTable;
use Illuminate\Support\Facades\Auth;


class SubscriptionController extends Controller
{
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        if($subscription->user_id === auth()->user()->id){
            return view('voyager::company.subscription-edit')->with('subscription', $subscription);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    // subscriptions
    public function show(Request $request)
    {
       $user = Auth::user(); // Retrieve the authenticated user
       $dataTable = new CompanyDataTable($request); // Create a new instance of CompanyDataTable
       $user = Auth::user(); // Retrieve the authenticated user
       $company = $user->company; // Assuming there is a relationship between User and Company models

       $companyData = $company ? $company->toArray() : [];
       return $dataTable->render('voyager::company.subscriptions', compact('companyData', 'company'));
    }
}
