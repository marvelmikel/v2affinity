<?php

namespace App\Http\Livewire;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Models\Plan;
use App\Models\Subscription;
use App\Mail\SubscriptionCreated;
use App\Models\BraintreeDiscount;
use App\Models\User;
use App\Models\Company;
use App\Models\Store;
use App\Traits\PaymentGateway;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubscriptionNew extends Component
{
    use PaymentGateway;
    use WithFileUploads;

    public $load = false;
    public $step = 1;
    public $store;
    public $client, $plans, $total, $show_discount, $discount_code; 
    public $terms_accepted = false;
    public $freetrial = false;
    public $addons = [];

    public $discount = [
        'id' => '94m6',
        'name' => 'RTEUAV',
        'amount' => 25.00,
    ];

    public $selectedDiscount = null;

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
        $user = auth()->user();

        /* Load Plans */
        $this->plans = Plan::orderBy('billingFrequency')->get()->keyBy('id')->toArray();

        /* Convert plan JSON to arrays */
        foreach ($this->plans as $key => $item) {
            $this->plans[$key]['addOns'] = json_decode($this->plans[$key]['addOns'], true);
            $this->plans[$key]['discounts'] = json_decode($this->plans[$key]['discounts'], true);
        }
    }


   

   

    public function selectSubscription()
    {
        /* Turn off loader */
        $this->load = false;
        /* move to next section of the form */
        $this->step = 2;
    }

    public function acceptTerms()
    {
        /* Confirm acceptance of terms */
        $this->terms_accepted = true;

        /* Turn off loader */
        $this->load = false;


       
    }

    /* Company billing details */
    public function company_billing()
    {
        /* Generate client token */
        $this->client = $this->clientToken(auth()->user());

        /* Turn off loader */
        $this->load = false;

        $selected_plan_id = $this->selected_plan['plan_id'];
        $this->addons = [
            'remove' => [],
            'update' => [],
        ];
        foreach ( $this->plans[$selected_plan_id]['addOns'] as $addonId => $addon) {
            /* Set default addon quantity to 3 if it's zero or empty */
            if (empty($this->selected_plan['addons'][$addon['id']]) || empty($this->selected_plan['addons'][$addon['id']]['quantity'])) {
                array_push($this->addons['remove'], $addon['id'] );
            } else {
                array_push( $this->addons['update'], [ 'existingId' => $addon['id'], 'quantity' => $this->selected_plan['addons'][$addon['id']]['quantity'] ]) ;
            }
        }

        /* Move to step 6*/
        $this->step = 3;
    }

    public function register_nonce($nonce)
    {
        /* Build request array */
        $values = [
            'clientToken' => $this->client,
            'paymentMethodNonce' => $nonce,
            'plan_id' => $this->selected_plan['plan_id'],
            'addons' =>  $this->addons,
            'discounts' => $this->selected_plan['discounts']
        ];


        /* Create new StoreSubscriptionRequest */
        $request = new StoreSubscriptionRequest([
            'clientToken' => $this->client,
            'paymentMethodNonce' => $nonce,
            'plan_id' => $this->selected_plan['plan_id'],
            'addons' => $this->addons,
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
              if ($this->selectedDiscount) {
                $this->total -= $this->selectedDiscount['amount'];
            }

        }
    }

    public function updatedSelectedPlan()
    {
        $this->calculate_total('month');
    }



    public function checkDiscount()
    {

    

        $discount_code = $this->discount_code;
        $selectedDiscount = BraintreeDiscount::where('discount_id', $discount_code)->first();
        if(!$this->selectedDiscount = BraintreeDiscount::where('discount_id', $discount_code)->first() ){
            // $this->addError('discount_code_error','Invalid or expired discount code.');
            session()->flash('alert-warning', 'Invalid or expired discount code.');
            $this->calculate_total('month');
            return;
        }
       
       
        
        session()->flash('alert-success', 'Discount code verified successfully');

        $this->resetErrorBag();
        $this->resetValidation();

        // $this->step = 3;


        if ($selectedDiscount ) {
            /* Set discount IDs */
            $this->selected_plan['discounts'][$this->selectedDiscount['discount_id']] = ['quantity' => 1];
        }

        $this->calculate_total('month');
    }



    public function render()
    {
        return view('livewire.subscription-new');
    }



    

}
