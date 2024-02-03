<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Mail\SubscriptionCancelled; // Add this line
use App\Mail\SubscriptionUpdated;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use App\Traits\PaymentGateway;
use Illuminate\Support\Facades\Auth;

class SubscriptionsEdit extends Component
{
    use PaymentGateway;

    public $subscriptions;
    public $billing;
    public $client;
    public $addons;
    public $creditCard = [
        'cardType' => '',
        'image' => '',
        'last4' => '',
        'expirationDate' => ''
    ];
    public $edit = false;
    public $extras = [
        'total' => 0.00,
        'addons' => [],
        'discounts' => []
    ];
    public $load = [
        'page' => true,
        'billing' => false,
        'edit' => false
    ];
    public $plans;
    public $subscription;
    public $token;
    public $total;
    public $total_switch = 0;
    public $inputPlan = [
        'plan_id' => '',
        'addons' => [],
        'discounts' => []
    ];

    public function render()
    {
        $companyId = Auth::user()->company_id;
        $this->subscriptions = Subscription::where('company_id', $companyId)->get();
        
        return view('livewire.subscriptions-edit', [
            'subscriptions' => $this->subscriptions,
        ]);
    }

    public function asyncRender()
    {
        // Load Plans
        $this->plans = Plan::orderBy('billingFrequency')->get()->keyBy('id')->toArray();

        // Convert plan JSON to arrays
        foreach ($this->plans as $key => $item) {
            $this->plans[$key]['addOns'] = json_decode($this->plans[$key]['addOns'], true);
            $this->plans[$key]['discounts'] = json_decode($this->plans[$key]['discounts'], true);
        }

        // Calculate total and populate extras
        $this->total  = $this->plans[$this->subscription->plan_id]['price'];
        foreach (json_decode($this->subscription['addOns'], true) as $addon) {

            // Calc total
            $this->total  += $addon['amount'] * $addon['quantity'];

            // Populate extras
            $this->extras['addons'][$addon['id']] = ['quantity' => $addon['quantity']];

            $this->addons = [
                'remove' => [],
                'update' => [],
            ];
            
            if (empty($this->extras['addons'][$addon['id']]) || empty($this->extras['addons'][$addon['id']]['quantity'])  ) {
                array_push($this->addons['remove'], $addon['id'] );
            } else {
                array_push( $this->addons['update'], [ 'existingId' => $addon['id'], 'quantity' =>  $this->extras['addons'][$addon['id']]['quantity']] ) ;
            }

            

        }
        $this->calcTotal();

        // Load subscriptions
        $subscriptions = $this->showSubscription($this->subscription);

        // Load customer
        $customer = $this->showCustomer(auth()->user());

        // Filter subscriptions related card
        $cc = array_filter($customer->creditCards, function ($item) use ($subscriptions) {
            return $item->token == $subscriptions->paymentMethodToken;
        });
        $cc = reset($cc);

        // Store subset of cc info
        $this->creditCard = [
            'cardType' => $cc->cardType,
            'image' => $cc->imageUrl,
            'last4' => $cc->last4,
            'expirationDate' => $cc->expirationDate
        ];

        // Populate payment token
        $this->token = $subscriptions->paymentMethodToken;

        // Build billing array
        if (!empty($cc->billingAddress)) {
            $this->billing = [
                'firstName' => $cc->billingAddress->firstName,
                'lastName' => $cc->billingAddress->lastName,
                'company' => $cc->billingAddress->company,
                'streetAddress' => $cc->billingAddress->streetAddress,
                'extendedAddress' => $cc->billingAddress->extendedAddress,
                'locality' => $cc->billingAddress->locality,
                'region' => $cc->billingAddress->region,
                'postalCode' => $cc->billingAddress->postalCode,
                'countryName' => $cc->billingAddress->countryName,
                'phoneNumber' => $cc->billingAddress->phoneNumber,
            ];
        }

        // Set client token, for updating card details
        $this->client = $this->clientToken(auth()->user());

        // Hide loader
        $this->load['page'] = false;
    }

    // Store billing address
    public function storeBilling()
    {
        // Submit billing address change
        $update = $this->updateBillingAddress($this->token, $this->billing);

        // Flash response
        if ($update->success) {
            session()->flash('alert-success', 'Successfully updated billing details.');

            // Send update email
            Mail::to(auth()->user())->send(new SubscriptionUpdated($this->subscription));

            $this->edit = false;
        } else {
            //$request->session()->flash('alert-error', 'Update Failed');
            session()->flash('alert-error', 'Failed to update billing details. Please try again.');
        }

        $this->load['edit'] = false;
    }

    public function calcTotal()
    {
        // Set base total
        $this->extras['total'] = $this->plans[$this->subscription->plan_id]['price'];

        // Check for any addons
        if (!empty($this->extras['addons'])) {

            // Filter selected addons
            $addons = array_filter($this->plans[$this->subscription->plan_id]['addOns'], fn ($v) => in_array($v['id'], array_keys($this->extras['addons'])));

            // Loop selected addons
            foreach ($addons as $add) {

                // Add amount x quantity to total
                $this->extras['total'] += $add['amount'] * $this->extras['addons'][$add['id']]['quantity'];
            }
        }
    }

    public function calcTotalSwitch()
    {
        if(!empty($this->inputPlan['plan_id'])){
            // Set base total
            $this->total_switch = $this->plans[ $this->inputPlan['plan_id'] ]['price'];

            // Check for any addons
            if(!empty($this->inputPlan['addons'])){
                // Filter selected addons
                $addons = array_filter( $this->plans[ $this->inputPlan['plan_id'] ]['addOns'], fn($v) => in_array($v['id'], array_keys($this->inputPlan['addons'])) );

                // Loop selected addons
                foreach($addons as $add){
                    // Add inheritedFromId to array
                    $this->inputPlan['addons'][$add['id']]['inheritedFromId'] = $add['id'];

                    // Add amount x quantity to total
                    if ($this->inputPlan['addons'][$add['id']]['quantity']) {
                        $this->total_switch += $add['amount'] * $this->inputPlan['addons'][$add['id']]['quantity'];
                    }
                }
            }
        }
    }

    public function storeCard($nonce)
    {
        // Submit credit card change
        $update = $this->updateCardDetails($this->subscription, $nonce);

        // Flash response
        if ($update->success) {

            // Flash updated payment details
            session()->flash('alert-success', 'Successfully updated payment details.');

            // Now assign address to new payment method
            $this->token = $update->subscription->paymentMethodToken;
            $this->updateBillingAddress($this->token, $this->billing);

            // Send update email
            Mail::to(auth()->user())->send(new SubscriptionUpdated($this->subscription));

            $this->edit = false;
            $this->reset('load');

            $this->asyncRender();
        } else {
            session()->flash('alert-error', 'Failed to update payment details. Please try again.');
        }
    }

    
    public function storeSubscription($switch = false)
    {
        $existingAdons =  json_decode($this->subscription['addOns'], true);   

        foreach ($this->extras['addons'] as $key => $addon) {

            $this->addons = [
                'remove' => [],
                'update' => [],
                'add' => [],
            ];
            
            if (  empty($addon['quantity'])  || $addon['quantity'] <=0    ) {
                if(isset($existingAdons[$key])){
                    array_push($this->addons['remove'], $key);
                }
            } else {
                if(isset($existingAdons[$key])){
                    array_push( $this->addons['update'], [ 'existingId' => $key, 'quantity' =>  $addon['quantity']] ) ;
                }else{
                    array_push( $this->addons['add'], [ 'inheritedFromId' => $key, 'quantity' =>  $addon['quantity']] ) ;
                }
                
            }

        }
        // Check if plan is being switched or current plan is updated then build request array
        if ($switch) {
            $vals = [
                'subscription_id' => $this->subscription->id,
                'plan_id' => $this->inputPlan['plan_id'],
                'addons' => $this->addons,
                'discounts' => $this->inputPlan['discounts']
            ]; 
        } else {
            $vals = [
                'subscription_id' => $this->subscription->id,
                'plan_id' => $this->subscription->plan_id,
                'addons' => $this->addons,
                'discounts' => $this->extras['discounts']
            ];
        }

        // Create new StoreSubscriptionRequest
        $request = new UpdateSubscriptionRequest($vals);


        // Set to post
        $request->setMethod('POST');

        // Add validator
        $request->setValidator(Validator::make($vals, $request->rules()));

        // Update or switch subscription
        if ($switch) {
            $update = $this->updateSubscriptionPlan($request);
           return  $this->cancelSubscription();
        } else {
            $update = $this->updateSubscription($request);
        }

        // dd($update);
        // Flash response
        if ($update->success) {
            // Flash updated payment details
            session()->flash('alert-success', 'Successfully updated subscription, reloading information...');

            // Send update email
            Mail::to(auth()->user())->send(new SubscriptionUpdated($this->subscription));

            // Reset views
            return redirect(request()->header('Referer'));
        } else {
           $this->addError('warning', 'Failed to update subscription details. Please try again.');
        }
    }

    public function updateSubscriptionPlan(UpdateSubscriptionRequest $request)
    {
        
    }


    public function setQuantity($addon)
    {
        // Set addon quantity to 1 by default
        if (!$this->inputPlan['addons']) {
            $this->inputPlan['addons'] = [$addon['id'] => ['quantity' => 1]];
            $this->calcTotalSwitch();
        }
    }



    public function cancelSubscription()
    {
        // Submit for subscription cancellation
        $cancel = $this->deleteSubscription($this->subscription);

        // Get the user's company ID
        $companyId = auth()->user()->company_id;

        // Update the subscription status to "Cancelled"
        Subscription::where('company_id', $companyId)->update([
            'status' => 'Cancelled'
        ]);

        // Send cancellation email
        Mail::to(auth()->user())->send(new SubscriptionCancelled($this->subscription));

        // Redirect to dashboard
        session()->flash('alert-success', 'Subscription cancelled successfully.');
        return redirect()->route('company.subscriptions');
    }
}
