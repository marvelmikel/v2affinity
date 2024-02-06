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
use Illuminate\Support\Facades\File;

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
        $filename = null;
        $path = null; // Default to null if no file is uploaded
        if ($request->hasFile('store_logo')) {
            $file = $request->file('store_logo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = 'store_logos/' . $fileName;
            // Move the uploaded file to the public directory
            $file->move(public_path('store_logos'), $fileName);
        }

        // Actually create the store
        $store = Store::create([
            'company_id' => auth()->user()->company_id,
            'store_name' => $validated['store_name'],
            'store_logo' => $path, // Store the filename here
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

        //Handle the file upload for store_logo
        if ($request->hasFile('store_logo')) {
            // Delete the old logo if it exists
            $oldLogoPath = str_replace('public/', '', $store->store_logo); // Assuming store_logo is saved as 'storage/store_logos/filename.ext'
            File::delete(public_path($store->store_logo));

            // Store the new logo
            $filename = null;
            $path = null; // Default to null if no file is uploaded
            if ($request->hasFile('store_logo')) {
                $file = $request->file('store_logo');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = 'store_logos/' . $fileName;
                // Move the uploaded file to the public directory
                $file->move(public_path('store_logos'), $fileName);
                $store->store_logo = $path;
            }
        }
        // Update the rest of the store details
        $store->fill($validatedData);
        // Exclude the store_logo from the $validatedData array because it's already been handled
        if (isset($validatedData['store_logo'])) {
            unset($validatedData['store_logo']);
        }

        // Save the updated store
        $store->save();

        // Redirect to the store edit page with a success message
        return redirect()->route('voyager.stores.index', ['id' => $store->id])->with('success', 'Store Information Updated successfully');
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

    public function deleteStore($id)
    {
        $user = User::findOrFail($id);

        // Delete the user from the database
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with([
            'message' => 'Store deleted successfully .',
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
