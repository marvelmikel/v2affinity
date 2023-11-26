<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\RoomLocation;
use App\DataTables\CompanyDataTable;
use App\Http\Requests\UpdateCompanyInfoRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // Assuming the User model exists and has a relationship with Company

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

    public function addRoomLocation(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Handle the unauthenticated user case
            return redirect()->back()->withErrors('You must be logged in to add a room location.');
        }

        // Validate the request data
        $validatedData = $request->validate([
            'room_name' => 'required|string|max:255', // Validation rule for the room name
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Create a new RoomLocation instance
        $roomLocation = new RoomLocation();
        $roomLocation->room_name = $validatedData['room_name'];
        $roomLocation->user_id = $user->id;
        $roomLocation->company_id = $user->company_id; // Assuming the user model has a company_id attribute

        // Save the new room location
        $roomLocation->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Room location added successfully.');
    }
    

    




    

    
}