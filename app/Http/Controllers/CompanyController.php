<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\RoomLocation;
use App\DataTables\CompanyDataTable;
use App\Http\Requests\UpdateCompanyInfoRequest;
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

        // Assuming the room locations are related to the company through a relationship named "roomLocations"
        $roomLocations = $company ? $company->roomLocations : collect();

        $companyData = $company ? $company->toArray() : [];



        return $dataTable->render('voyager::company.index', compact('companyData', 'company', 'roomLocations'));
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
        return redirect()->back()->withSuccess('Room location added successfully.');
    }

    public function deleteRoomLocation(RoomLocation $roomLocation)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Handle the unauthenticated user case
            return redirect()->back()->withErrors('You must be logged in to delete a room location.');
        }

        // Check if the authenticated user is authorized to delete the room location
        if ($roomLocation->user_id !== Auth::user()->id) {
            // Handle unauthorized access case
            return redirect()->back()->withErrors('You are not authorized to delete this room location.');
        }

        // Delete the room location
        $roomLocation->delete();

        // Redirect back with a success message
        return redirect()->back()->withSuccess('Room location deleted successfully.');
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

   
}
