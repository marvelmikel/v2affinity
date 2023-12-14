<?php

namespace App\Http\Controllers;

use App\DataTables\StoresDataTable;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use \Modules\Admin\Models\Role;

use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(StoresDataTable $dataTable)
    {
        return $dataTable->render('voyager::stores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        return view('voyager::stores.create');

    }

    public function store(StoreRequest $request)
    {
        // Validate request
        $validated = $request->validated();
    
        // Check if the user has a company_id
        if (!auth()->user()->company_id) {
            return redirect()->back()->with([
                'message' => 'You do not have a company, please create a company first.',
                'alert-type' => 'warning',
            ]);
        }
    
        // Handle the file upload for store_logo
        $filename = null; // Default to null if no file is uploaded
        if ($request->hasFile('store_logo')) {
            $file = $request->file('store_logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            // Store the file in the 'public/store_logos' directory which is within 'storage/app/public'
            $path = $file->storeAs('store_logos', $filename);
           // Update the $filename variable to store the entire path, rather than just the filename
           $filename = 'store_logos/' . $filename;
        }
    
        // Actually create the store
        $store = Store::create([
            'company_id' => auth()->user()->company_id,
            'store_name' => $validated['store_name'],
            'store_logo' => $filename, // Store the filename here
            'store_phone' => $validated['store_phone'],
            'store_email' => $validated['store_email'],
            'address_line_1' => $validated['address_line_1'],
            'address_line_2' => $validated['address_line_2'],
            'address_city' => $validated['address_city'],
            'address_county' => $validated['address_county'],
            'address_postcode' => $validated['address_postcode'],
        ]);
    
        // Redirect with success message
        return redirect()->route('voyager.stores.index')->with([
            'message' => 'Successfully created store.',
            'alert-type' => 'success',
        ]);
    }


    /// Function to Update Store Information
    public function update(UpdateStoreRequest $request, $storeId)
    {
        // Validate the input
        $validatedData = $request->validated();
        
        // Find the store
        $store = Store::findOrFail($storeId);
        // Update the rest of the store details
        $store->fill($validatedData);

        // Save the updated store
        $store->save();

        // Redirect to the store edit page with a success message
        return redirect()->route('voyager.stores.edit', ['id' => $store->id])->with('success', 'Store Information Updated successfully');
    }
    




public function edit(Request $request, $id)
{
    $store = Store::findOrFail($id);
    $company = Company::findOrFail($store->company_id);

    $usersAssignedToStore = User::where('store_id', $store->id)->get();
    $usersRegisteredByCompany = User::where('company_id', $store->company_id)->get();

    $usersAssignedToStore->load('roles');

    return view('voyager::stores.edit', compact('store', 'usersAssignedToStore', 'usersRegisteredByCompany'));
}

public function deleteStoreEmployee($id)
{
    $user = User::findOrFail($id);

    // Delete the user from the database
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->back()->with([
        'message' => 'Employee deleted successfully .',
        'alert-type' => 'success',
    ]);
}






    public function delete($id)
    {
        $store = Store::findOrFail($id);
    
        $store->delete();
    
        // Redirect back to the initial page
        return redirect()->route('voyager.stores.index')->with('success', 'Store deleted successfully');
    }

}