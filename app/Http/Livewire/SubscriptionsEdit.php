<?php

namespace App\Http\Livewire;

use App\Http\Requests\UpdateSubscriptionRequest;
use App\Mail\SubscriptionCancelled;
use App\Mail\SubscriptionUpdated;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use App\Traits\PaymentGateway;

class SubscriptionsEdit extends Component
{
    use PaymentGateway;

    public $billing;
    public $client;
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

    public function render()
    {
        return view('livewire.subscriptions-edit');
    }

    public function asyncRender()
    {
        // Load Plans
        $this->plans = Plan::orderBy('billingFrequency')->get()->keyBy('id')->toArray();

        // Convert plan JSON to arrays
        foreach($this->plans as $key => $item){
            $this->plans[$key]['addOns'] = json_decode($this->plans[$key]['addOns'],true);
            $this->plans[$key]['discounts'] = json_decode($this->plans[$key]['discounts'],true);
        }

        // Calculate total and populate extras
        $this->total  = $this->plans[$this->subscription->plan_id]['price'];
        foreach(json_decode($this->subscription['addOns'],true) as $addon){

            // Calc total
            $this->total  += $addon['amount'] * $addon['quantity'];

            // Populate extras
            $this->extras['addons'][$addon['id']] = [ 'quantity' => $addon['quantity'] ];
        }
        $this->calcTotal();

        // Load subscriptions
        $subscriptions = $this->showSubscription($this->subscription);

        // Load customer
        $customer = $this->showCustomer(auth()->user());

        // Filter subscriptions related card
        $cc = array_filter($customer->creditCards, function($item) use ($subscriptions){ return $item->token == $subscriptions->paymentMethodToken; } );
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
        if(!empty($cc->billingAddress)){
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
        if($update->success){
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
        $this->extras['total'] = $this->plans[ $this->subscription->plan_id ]['price'];

        // Check for any addons
        if(!empty($this->extras['addons'])){

            // Filter selected addons
            $addons = array_filter( $this->plans[ $this->subscription->plan_id ]['addOns'], fn($v) => in_array($v['id'], array_keys($this->extras['addons'])) );

            // Loop selected addons
            foreach($addons as $add){

                // Add amount x quantity to total
                $this->extras['total'] += $add['amount'] * $this->extras['addons'][$add['id']]['quantity'];

            }
        }
    }

    public function storeCard($nonce)
    {
        // Submit credit card change
        $update = $this->updateCardDetails($this->subscription, $nonce);

        // Flash response
        if($update->success){

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

    public function storeSubscription()
    {
        // Build request array
        $vals = [
            'subscription_id' => $this->subscription->id,
            'plan_id' => $this->subscription->plan_id,
            'addons' => $this->extras['addons'],
            'discounts' => $this->extras['discounts']
        ];

        // Create new StoreSubscriptionRequest
        $request = new UpdateSubscriptionRequest($vals);

        // Set to post
        $request->setMethod('POST');

        // Add validator
        $request->setValidator(Validator::make($vals, $request->rules()));

        // Submit for subscription creation
        $update = $this->updateSubscription($request);

        // Flash response
        if($update->success){

            // Flash updated payment details
            session()->flash('alert-success', 'Successfully updated subscription.');

            // Reload model
            $this->subscription = Subscription::find($this->subscription->id);

            // Send update email
            Mail::to(auth()->user())->send(new SubscriptionUpdated($this->subscription));

            // Reset views
            $this->edit = false;
            $this->reset('load');
            $this->asyncRender();
        } else {
            session()->flash('alert-error', 'Failed to update subscription details. Please try again.');
        }
    }

    public function cancelSubscription()
    {
        // Submit for subscription cancellation
        $cancel = $this->deleteSubscription($this->subscription);

        // Disable store on app
        $apiResponse = apiCall( 'store/'.auth()->user()->store_id, $type = 'PUT', [ 'active' => false ]);

        // Send cancellation email
        Mail::to(auth()->user())->send(new SubscriptionCancelled($this->subscription));

        // Redirect to dashboard
        return redirect()->route('dashboard');
    }

}
