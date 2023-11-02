<?php

namespace App\Http\Controllers;

use App\DataTables\StoresDataTable;
use App\Http\Requests\StoreRequest;
use App\Models\Store;

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
            $path = public_path('storage/store_logos/');
            $file->move($path, $filename);
            $filename = 'storage/store_logos/' . $filename; // Adjusted to the correct path
        }

        // Actually create the store
        $store = Store::create([
            'company_id' => auth()->user()->company_id,
            'store_name' => $validated['store_name'],
            'store_logo' => $filename, // Use the generated filename
            'store_phone' => $validated['store_phone'],
            'store_email' => $validated['store_email'],
            'address_line_1' => $validated['address_line_1'],
            'address_line_2' => $validated['address_line_2'],
            'address_city' => $validated['address_city'],
            'address_county' => $validated['address_county'],
            'address_postcode' => $validated['address_postcode'],

        ]);

        // Redirect with success message
        return redirect()->route('voyager.stores.index')->with([ // Assuming this is the correct redirect route
            'message' => 'Successfully created store.',
            'alert-type' => 'success',
        ]);
    }

    public function edit(Request $request,  $id)
    {
        $store = Store::findOrFail($id);

        return view('voyager::stores.edit', compact('store'));

    }

    public function delete($id)
    {
        $store = Store::findOrFail($id);
    
        $store->delete();
    
        // Redirect back to the initial page
        return redirect()->route('voyager.stores.index')->with('success', 'Store deleted successfully');
    }

}
