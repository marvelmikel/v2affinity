<?php

namespace App\Http\Livewire;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Models\Plan;
use App\Models\Subscription;
use App\Mail\SubscriptionCreated;
use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use App\Models\Company;
use App\Models\Store;
use App\Traits\PaymentGateway;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Registration extends Component
{
    use PaymentGateway;
    use WithFileUploads;

    public $load = false;
    public $step = 1;
    public $store;
    public $client, $plans, $total, $show_discount, $discount_code; 
    public $terms_accepted = false;
    public $freetrial = false;

    public $discount = [
        'id' => '94m6',
        'name' => 'RTEUAV',
        'amount' => 25.00,
    ];

    public $user = [
        'name' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public $company = [
        'id' => null,
        'company_name' => '',
        'company_address' => '',
        'company_phone' => '',
        'company_email' => '',
        'company_number' => '',
        'vat_number' => '',
        'logo' => '',
    ];

    public $selected_plan = [
        'plan_id' => '',
        'addons' => [],

        'discounts' => [],
    ];

    public $billing = [
        'firstName' => '',
        'lastName' => '',
        'company' => '',
        'streetAddress' => '',
        'extendedAddress' => '',
        'locality' => '',
        'region' => '',
        'postalCode' => '',
        'countryName' => 'United Kingdom',
    ];

    /* Mount predefined values into view */
    public function mount()
    {
        /* Check if user is logged in */
        if ($user = auth()->user()) {
            /* Check if company exists and populate data */
            if ($company = $user->company) {
                $this->company['id'] = $company->id;
                $this->company['company_name'] = $company->company_name;
                $this->company['company_address'] = $company->company_address;
                $this->company['company_phone'] = $company->company_phone;
                $this->company['company_email'] = $company->company_email;
                $this->company['company_number'] = $company->company_number;
                $this->company['vat_number'] = $company->vat_number;
                $this->company['logo'] = $company->logo;
            }

            $this->user['id'] = $company->id;
            $this->user['name'] = $user->name;
            $this->user['email'] = $user->email;
            // $this->user['password'] = $user->password;
            // $this->user['password_confirmation'] = $user->password;


            $this->step = 2;
        }

        /* Load Plans */
        $this->plans = Plan::orderBy('billingFrequency')->get()->keyBy('id')->toArray();

        /* Convert plan JSON to arrays */
        foreach ($this->plans as $key => $item) {
            $this->plans[$key]['addOns'] = json_decode($this->plans[$key]['addOns'], true);
            $this->plans[$key]['discounts'] = json_decode($this->plans[$key]['discounts'], true);
        }
    }


    /* Register new user */
    public function register_user()
    {
        /* Turn off loader */
        $this->load = false;

        /* Validate user details */
        $this->validate([
            'user.name' => ['required', 'string', 'max:255'],
            'user.email' => [
                'required',
                'string',
                'email',
                'max:255',
                auth()->user() ? '' : 'unique:users,email',
            ],
            'user.password' => ['required', 'string', 'confirmed'],
        ]);

        /* Create user and set as Company Admin */
        $user = User::updateOrCreate([
            'email' => $this->user['email']
        ],[
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'password' => Hash::make($this->user['password']),
        ]);

        /* Log new user in */
        auth()->login($user);

        /* Clear user details */
        // $this->reset('user');

        /* Move to step 2 */
        $this->step = 2;
    }

    /* Register company details */
    public function register_company()
    {
        /* Turn off loader */
        $this->load = false;

        /* Validate input */
        $this->validate([
            'company.company_name' => 'required|string',
            'company.company_address' => 'required|string',
            'company.company_phone' => 'required|string',
            'company.company_email' => 'required|string',
            'company.company_number' => 'sometimes|string',
            'company.vat_number' => 'sometimes|string',
            'company.phone_no' => 'sometimes|string',
            'company.logo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /* Create company and assign to user */
        $user = auth()->user();

        $company = $user->company()->updateOrCreate([
            'id' => $this->company['id'],
        ], $this->company);

        $user->update(['company_id' => $company->id]);

        $store = Store::where('company_id', $company->id)->firstOrFail(); // Assuming you have a Store model

    /* Save store_id on the users table */
    $user->store_id = $store->id;
    $user->save();


        /* Move to step 3 */
        $this->step = 3;
    }

    public function selectSubscription()
    {
        /* Turn off loader */
        $this->load = false;

        /* move to next section of the form */
        $this->step = 4;
    }

    public function acceptTerms()
    {
        /* Confirm acceptance of terms */
        $this->terms_accepted = true;

        /* Turn off loader */
        $this->load = false;

        /* Move to step 5*/
        $this->step = 5;
    }

    /* Company billing details */
    public function company_billing()
    {
        /* Generate client token */
        $this->client = $this->clientToken(auth()->user());

        /* Turn off loader */
        $this->load = false;


    /* Check for any addons */
    if (!empty($this->selected_plan['addons'])) {
        foreach ($this->selected_plan['addons'] as $addonId => $addon) {
            /* Set default addon quantity to 3 if it's zero or empty */
            if (empty($addon['quantity'])) {
                $this->selected_plan['addons'][$addonId]['quantity'] = 1;
            } else {
                /* Add the increased quantity to the default 3 value */
                $this->selected_plan['addons'][$addonId]['quantity'] += 1;
            }
        }
    }

        /* Move to step 6*/
        $this->step = 6;
    }

    public function register_nonce($nonce)
    {
        /* Build request array */
        $values = [
            'clientToken' => $this->client,
            'paymentMethodNonce' => $nonce,
            'plan_id' => $this->selected_plan['plan_id'],
            'addons' => $this->selected_plan['addons'],
            'discounts' => $this->selected_plan['discounts']
        ];

        /* Create new StoreSubscriptionRequest */
        $request = new StoreSubscriptionRequest([
            'clientToken' => $this->client,
            'paymentMethodNonce' => $nonce,
            'plan_id' => $this->selected_plan['plan_id'],
            'addons' => $this->selected_plan['addons'],
            'discounts' => $this->selected_plan['discounts']
        ]);

        /* Set to post */
        $request->setMethod('POST');

        /* Add validator */
        $request->setValidator(Validator::make($values, $request->rules()));

        /*Submit for subscription creation */
        $response = $this->createSubscription($request);

        /* If status success */
        if ($response->success) {
            /* Link payment details */
            $this->updateBillingAddress($response->subscription->paymentMethodToken, $this->billing);

            // Send update email
            Mail::to(auth()->user())->send(new SubscriptionCreated(Subscription::find($response->subscription->id)));

            /* Make company active, confirm acceptance of terms and set user to Company Admin */
            $user = auth()->user();
            $user->company->update([
                'active' => true,
                'terms_accepted' => now(),
            ]);
            $user->role_id = 2;
            $user->save();



            // Save company_id on the subscription
            $subscription = Subscription::find($response->subscription->id);
            $company = auth()->user()->company;
            $subscription->company_id = $company->id;
            $subscription->save();

            /* Flash message and redirect to dashboard */
            session()->flash('alert-success', 'Subscription Created.');
            return redirect()->route('voyager.profile');
        } else {
            /* Flash errors */
            foreach ($response->errors->deepAll() as $error) {
                session()->flash('alert-warning', $error->code . ': ' . $error->message);
            }
        }
      
    }
   

    public function calculate_total($period)
    {
        if (!empty($this->selected_plan['plan_id'])) {
            /* Set base total */
            $this->total = $this->plans[$this->selected_plan['plan_id']]['price'];

            /* Check for any addons */
            if (!empty($this->selected_plan['addons'])) {

                /* Filter selected addons */
                $addons = array_filter($this->plans[$this->selected_plan['plan_id']]['addOns'], fn ($v) => in_array($v['id'], array_keys($this->selected_plan['addons'])));

                /* Loop selected addons*/
                foreach ($addons as $add) {
                    /* Add amount x quantity to total */
                    $this->total += $add['amount'] * $this->selected_plan['addons'][$add['id']]['quantity'];
                }
            }

            /* Check for any discounts */
            if ($this->discount_code == $this->discount['name'] && $period == 'month') {
                $this->total -= $this->discount['amount'];
            }
        }
    }

    

    public function checkDiscount()
    {
        if ($this->discount_code == $this->discount['name']) {
            /* Set discount IDs */
            $this->selected_plan['discounts'][$this->discount['id']] = ['quantity' => 1];
        }

        $this->calculate_total('month');
    }

    public function render()
    {
        return view('livewire.registration');
    }



    public function skipBilling()
    {
        $this->billing = [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'company' => 'John Doe Inc',
            'streetAddress' => 'Albana',
            'extendedAddress' => 'United States',
            'locality' => 'US',
            'region' => 'US',
            'postalCode' => '433333',
            'countryName' => 'United Kingdom',
        ];

        //  submit form
        $this->company_billing();

        // $this->register_nonce($nounce);
    }
}
