<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\DataTables\CompanyDataTable;
use App\Models\User; // Assuming the User model exists and has a relationship with Company

class CompanyController extends Controller
{
    public function show()
    {

        return view('voyager::company.index');
    }

    // public function updateCompanyDetails(Request $request)
    // {
    //     $request->validate([
    //         'company_name' => 'required',
    //         'company_email' => 'required|email',
    //         'company_address' => 'required',
    //         'company_phone' => 'required',
    //         'company_number' => 'required',
    //         'vat_number' => 'required',
    //     ]);

    //     $user = auth()->user();
    //     $company = $user->company;
    //     $company->update($request->all());

    //     return redirect()->back()->with('success', 'Company information updated successfully!');
    // }
}
