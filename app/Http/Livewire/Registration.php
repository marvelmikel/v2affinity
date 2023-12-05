<?php

namespace App\Http\Livewire;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
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
    public $discount_code_check = 'RTEUAV';
    public $client, $plans, $total, $show_discount, $discount_code;
    public $terms_accepted = false;

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

            $this->step = 2;
        }

        /* Load Plans */
        $this->plans = Plan::orderBy('billingFrequency')->get()->keyBy('id')->toArray();

        /* Convert plan JSON to arrays */
        foreach($this->plans as $key => $item){
            $this->plans[$key]['addOns'] = json_decode($this->plans[$key]['addOns'],true);
            $this->plans[$key]['discounts'] = json_decode($this->plans[$key]['discounts'],true);
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
                'unique:users,email',
            ],
            'user.password' => ['required', 'string', 'confirmed'],
        ]);

        /* Create user and set as Company Admin */
        $user = User::create([
            'name' => $this->user['name'],
            'email' => $this->user['email'],
            'password' => Hash::make($this->user['password']),
        ]);

        /* Log new user in */
        auth()->login($user);

        /* Clear user details */
        $this->reset('user');

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
        if ($response->success){
            /* Link payment details */
            $this->updateBillingAddress($response->subscription->paymentMethodToken, $this->billing);

            /* Make company active, confirm acceptance of terms and set user to Company Admin */
            $user = auth()->user();
            $user->company->update([
                'active' => true,
                'terms_accepted' => now(),
            ]);
            $user->role_id = 2;
            $user->save();

            /* Flash message and redirect to dashboard */
            session()->flash('alert-success', 'Subscription Created.');
            return redirect()->route('voyager.profile');
        } else {
            /* Flash errors */
            foreach($response->errors->deepAll() AS $error) {
                session()->flash('alert-warning', $error->code.': '.$error->message);
            }
        }
    }

    public function calculate_total()
    {
        if(!empty($this->selected_plan['plan_id'])){
            /* Set base total */
            $this->total = $this->plans[ $this->selected_plan['plan_id'] ]['price'];

            /* Check for any addons */
            if(!empty($this->selected_plan['addons'])){

                /* Filter selected addons */
                $addons = array_filter( $this->plans[ $this->selected_plan['plan_id'] ]['addOns'], fn($v) => in_array($v['id'], array_keys($this->selected_plan['addons'])) );

                /* Loop selected addons*/
                foreach($addons as $add){
                    /* Add amount x quantity to total */
                    $this->total += $add['amount'] * $this->selected_plan['addons'][$add['id']]['quantity'];

                }
            }
        }
    }

    public function checkDiscount()
    {
        if ($this->discount_code == $this->discount_code_check) {
            /* Initialize braintree payment connection */
            $gateway = $this->openGateway();

            /* Find discounts */
            $discounts = collect($gateway->discount()->all());

            dd($discounts);
        }
    }

    public function render()
    {
        return view('livewire.registration')->layout('layouts.blank');
    }
}