<?php

namespace App\Http\Controllers;
use App\DataTables\EmployeeDataTable;
use App\DataTables\StoreDataTable;
use Modules\Admin\Models\Role;
use \Modules\Admin\Models\User;
use App\Models\Store;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Auth;



class EmployeeController extends Controller
{
    
    public function index(EmployeeDataTable $dataTable)
    {
        $user = Auth::user();
        $company_id = $user->company_id;
        $dataTable->addScope(new class($company_id) implements \Yajra\DataTables\Contracts\DataTableScope {
            private $company_id;

            public function __construct($company_id)
            {
                $this->company_id = $company_id;
            }

            public function apply($query)
            {
                return $query->where('company_id', $this->company_id);
            }
        });
        return $dataTable->render('voyager::employee.index');
    }

    public function create()
    {
        $user = Auth::user();
        $company_id = $user->company_id ?? null;
        
        return view('voyager::employee.create', compact('company_id'));
    }

   

    public function store(EmployeeRequest $request)
{
    $validatedData = $request->validated();

    if ($validatedData['password'] !== $validatedData['cpassword']) {
        return redirect()->back()->withErrors(['cpassword' => 'The password confirmation does not match.'])
            ->withInput();
    }

    // Create the user
    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => bcrypt($validatedData['password']),
        'company_id' => Auth::user()->company_id,
    ]);

    // Assign role to the user
    $user->roles()->attach($validatedData['role_id']);

    // Get the store by ID
    $store = Store::findOrFail($validatedData['store_id']);

    // Assign the store to the user
    $user->store()->associate($store);
    $user->save();

    // Redirect with success message
    return redirect()->route('voyager.users.index')->with([
        'message' => 'Successfully created user.',
        'alert-type' => 'success',
    ]);
}


    
   
}