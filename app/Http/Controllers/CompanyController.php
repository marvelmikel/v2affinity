<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\RoomLocation;
use App\DataTables\CompanyDataTable;
use App\Http\Requests\UpdateCompanyInfoRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelUserActivity\Models\Log;// Assuming the User model exists and has a relationship with Company

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
    // Check if the authenticated user has role_id = 2
    if (Auth::user()->role_id != 2) {
        return redirect()->back()->with('error', 'You do not have permission to edit company details.');
    }

    $company = Company::find($companyId);
    if (!$company) {
        return redirect()->back()->with('error', 'Company not found.');
    }

    $company->update($request->all()); // Assuming $request->all() contains only fillable fields

    return redirect()->route('voyager.company.index')->with('success', 'Company details updated successfully.');
}


 // User Logs 
 public function show(Request $request)
{
    $user = auth()->user();
    if ($user->role_id == 1) {
        // For users with role_id=1 (admin), display all logs
        $companyUserLogs = Log::orderBy('id', 'asc')->get();
    } else {
        // For other users, display logs related to their company_id
        $companyUserLogs = Log::where('user_id', $user->id)
            ->whereIn('user_id', function ($query) use ($user) {
                $query->select('id')
                    ->from('users')
                    ->where('company_id', $user->company_id);
            })
            ->orderBy('id', 'asc')
            ->get();
    }

    return view('voyager::company.logs', compact('companyUserLogs'));
}











    
}