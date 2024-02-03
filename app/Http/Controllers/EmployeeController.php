<?php

namespace App\Http\Controllers;

use App\DataTables\EmployeeDataTable;
use App\DataTables\StoreDataTable;
use Modules\Admin\Models\Role;
use App\Models\User;
use App\Models\Store;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use App\Mail\UserInvitationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{

    public function index(EmployeeDataTable $dataTable)
    {
        $user = Auth::user();
        $company_id = $user->company_id;
        $dataTable->addScope(new class($company_id) implements \Yajra\DataTables\Contracts\DataTableScope
        {
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
        // check subscription feature here
        if( $subscription = auth()->user()->activeSubscription()  ){
            $userFeature = $subscription->features('users');

            // dd($userFeature, $subscription);
            if($userFeature['balance'] < 1){
                return redirect()->back()->with('warning', 'You can not add anymore user, please update your subscription');
            }
        }

        $validatedData = $request->validated();

        if ($validatedData['password'] !== $validatedData['cpassword']) {
            return redirect()->back()->withErrors(['cpassword' => 'The password confirmation does not match.'])
                ->withInput();
        }

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role_id' => $validatedData['role_id'],
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

        if($company = Company::find($user->company_id)){
            Mail::to($user)->send(new UserInvitationMail([
                'name'  => $user->name,
                'email' => $user->email,
                'password' => $validatedData['password'],
                'company_name' => $company->company_name,
            ]));    
        }

       
        // Redirect with success message
        return redirect()->route('voyager.employee.index')->with([
            'message' => 'Successfully created user.',
            'alert-type' => 'success',
        ]);
    }


    public function edit(Request $request, $id)
    {
        $employee = User::findOrFail($id);
        $company = Company::findOrFail($employee->company_id);

        $stores = Store::where('company_id', $employee->company_id)->get();

        $usersAssignedToStore = User::where('store_id', $employee->store_id)->get();
        $usersRegisteredByCompany = User::where('company_id', $employee->company_id)->get();

        $usersAssignedToStore->load('roles');

        return view('voyager::employee.edit', compact('employee', 'usersAssignedToStore', 'usersRegisteredByCompany', 'stores',));
    }

    public function delete($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();
        // Redirect back to the initial page
        return redirect()->route('voyager.employee.index')->with('success', 'Employee deleted successfully');
    }

    public function update()
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
            'store_id' => 'required',
        ]);

        $employee = User::findOrFail(request()->employeeId);

        $employee->name = $validatedData['name'];
        $employee->email = $validatedData['email'];
        $employee->role_id = $validatedData['role_id'];
        $employee->store_id = $validatedData['store_id'];

        $employee->save();

        // Redirect with success message
        return redirect()->route('voyager.employee.index')->with([
            'message' => 'Successfully updated user.',
            'alert-type' => 'success',
        ]);
    }
}
