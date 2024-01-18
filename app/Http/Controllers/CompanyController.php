<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\RoomLocation;
use App\DataTables\CompanyDataTable;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelUserActivity\Models\Log; // Assuming the User model exists and has a relationship with Company

class CompanyController extends Controller
{




    public function index(Request $request)
    {
        $dataTable = new CompanyDataTable($request); // Create a new instance of CompanyDataTable

        $user = Auth::user(); // Retrieve the authenticated user
        $company = $user->company; // Assuming there is a relationship between User and Company models


        $companyData = $company ? $company->toArray() : [];



        return $dataTable->render('voyager::company.index', compact('companyData', 'company'));
    }


    public function update(Request $request, $companyId)
    {
        $company = Company::findOrFail($companyId);
        $company = Company::find($companyId);
        if (!$company) {
            return redirect()->back()->with('error', 'Company not found.');
        }
        $company->update($request->all()); // Assuming $request->all() contains only fillable fields

        return redirect()->route('voyager.company.index')->with('success', 'Company details updated successfully.');
    }


    // show User Logs 
    public function show(Request $request)
    {
        // Check if the authenticated user's role_id is 1
        if (auth()->user()->role_id == 1) {
            $companyUserLogs = Log::orderBy('id', 'asc')->get();
        } else {
            $companyId = auth()->user()->company_id;
            $companyUserLogs = Log::whereHas('user', function ($query) use ($companyId) {
                $query->where('company_id', $companyId)->where('role_id', '>', 1);
            })
                ->orderBy('id', 'asc')
                ->get();
        }
        return view('voyager::company.logs', compact('companyUserLogs'));
    }

    public function edit(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $companyData = $company->toArray();
        $subscription = $company->subscription;
        $plan = $subscription ? $subscription->plan : null;

        return view('voyager::company.edit', compact('companyData', 'company', 'subscription', 'plan'));
    }

   
}
