<?php

namespace App\Traits;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\User;

trait PaymentGateway
{
    private $gateway = [];

    /* Open stargate */
    private function openGateway()
    {
        if(empty($this->gateway)){
            /* Initialize braintree payment connection */
            $this->gateway = new \Braintree\Gateway([
                'environment' => env('BTREE_ENVIRONMENT', 'sandbox'),
                'merchantId' => env('BTREE_MERCHANT_ID', 'use_your_merchant_id'),
                'publicKey' => env('BTREE_PUBLIC_KEY', 'use_your_public_key'),
                'privateKey' => env('BTREE_PRIVATE_KEY', 'use_your_private_key')
            ]);
        }

        return $this->gateway;
    }

    public function clientToken(User $user)
    {
        $gateway = $this->openGateway();

        /* Check if customer exists or not */
        $exists = $gateway->customer()->search([
            \Braintree\CustomerSearch::id()->is( $user->id )
        ]);

        /* If no customer found, create customer */
        if(empty($exists->_ids)){
            $exists = $gateway->customer()->create([
                'id' => $user->id,
                'firstName' => $user->first_name,
                'lastName' => $user->last_name,
                'email' => $user->email
            ]);
        }

        /* Create a clientToken for relevant customer */
        $clientToken = $gateway->clientToken()->generate([
            "customerId" => $user->id
        ]);

        return $clientToken;
    }

    /* Retrieve all subscription plans from braintree */
    public function indexPlans()
    {
        $gateway = $this->openGateway();
        return $gateway->plan()->all() ?? [];
    }

    /* Retrieve all subscription plans from braintree */
    public function indexDiscounts()
    {
        $gateway = $this->openGateway();
        return $gateway->discount()->all() ?? [];
    }

    /* Retrieve customer record from braintree */
    public function showCustomer(User $user)
    {
        $gateway = $this->openGateway();
        return $gateway->customer()->find($user->id);
    }

    /* Retrieve subscription record from braintree */
    public function showSubscription(Subscription $subscription)
    {
        $gateway = $this->openGateway();
        return $gateway->subscription()->find($subscription->id);
    }

    public function createSubscription(StoreSubscriptionRequest $request)
    {
        /* Validate input */
        $validated = $request->validated();

        // dd($validated);

        /* Check if addons are provided */
        // $addons = [];
        // if($validated['addons']){
        //     /* Loop and generate addons */
        //     foreach($validated['addons'] as $key => $item){
        //         $addons[] = [
        //              // 'inheritedFromId' => $key,
        //             'existingId' => $key,
        //             'quantity' => $item['quantity']
        //         ];
        //     }
        // }

        /* Check if discounts are provided */
        $discounts = [];
        if($validated['discounts']){
            /* Loop and generate addons */
            foreach($validated['discounts'] as $key => $item){
                $discounts[] = [
                    // 'inheritedFromId' => $key
                    'existingId' => $key
                ];
            }
        } 

        /* Initialize braintree payment connection */
        $gateway = $this->openGateway();

        /* Create subscription on braintree */
        $result = $gateway->subscription()->create([
            'paymentMethodNonce' => $validated['paymentMethodNonce'],
            'planId' => $validated['plan_id'],
            'addOns' => $validated['addons'],
            // 'addOns' => [
            //     'update' => $addons
            // ],
            'discounts' => [
                'update' => $discounts
            ]
        ]);

        /* If successful, creating local subscription */
        if($result->success){
            $subscription = New Subscription();
            $subscription->id = $result->subscription->id;
            $subscription->user_id = auth()->user()->id;
            $subscription->plan_id = $validated['plan_id'];
            $subscription->balance = $result->subscription->balance;
            $subscription->billingDayOfMonth = $result->subscription->billingDayOfMonth;
            $subscription->firstBillingDate = $result->subscription->firstBillingDate;
            $subscription->nextBillingDate = $result->subscription->nextBillingDate;
            $subscription->billingPeriodStartDate = $result->subscription->billingPeriodStartDate;
            $subscription->billingPeriodEndDate = $result->subscription->billingPeriodEndDate;
            $subscription->paidThroughDate = $result->subscription->paidThroughDate;
            $subscription->currentBillingCycle = $result->subscription->currentBillingCycle;
            $subscription->numberOfBillingCycles = $result->subscription->numberOfBillingCycles;
            $subscription->neverExpires = $result->subscription->neverExpires;
            $subscription->daysPastDue = $result->subscription->daysPastDue;
            $subscription->failureCount = $result->subscription->failureCount;
            $subscription->addOns = json_encode($result->subscription->addOns);
            $subscription->discounts = json_encode($result->subscription->discounts);
            $subscription->status = $result->subscription->status;
            $subscription->statusHistory = json_encode($result->subscription->statusHistory);
            $subscription->transactions = json_encode($result->subscription->transactions);
            $subscription->save();
        }


        return $result;
    }

    public function updateSubscription(UpdateSubscriptionRequest $request)
    {
        /* Validate input */
        $validated = $request->validated();

        /* Check if addons are provided */
        // $addons = [];
        // if($validated['addons']){
        //     /* Loop and generate addons */
        //     foreach($validated['addons'] as $key => $item){
        //         $addons[] = [
        //             // 'inheritedFromId' => $key,
        //             'existingId' => $key,
        //             'quantity' => $item['quantity']
        //         ];
        //     }
        // }

        /* Check if discounts are provided */
        $discounts = [];
        if($validated['discounts']){

            /* Loop and generate addons */
            foreach($validated['discounts'] as $key => $item){
                $discounts[] = [
                    // 'inheritedFromId' => $key
                    'existingId' => $key
                ];
            }
        }

        /* Initialize braintree payment connection */
        $gateway = $this->openGateway();

        /* Update subscription on braintree*/
        $result = $gateway->subscription()->update($validated['subscription_id'], [
            'planId' => $validated['plan_id'],
            // 'addOns' => [
            //     'update' => $addons
            // ],
            'addOns' => $validated['addons'] ?? [],
            'discounts' => [
                'update' => $discounts
            ]
        ]);

        /* If successful, update local subscription */
        if($result->success){
            $subscription = Subscription::find($validated['subscription_id']);
            $subscription->plan_id = $validated['plan_id'];
            $subscription->addOns = json_encode($result->subscription->addOns);
            $subscription->discounts = json_encode($result->subscription->discounts);
            $subscription->save();
        }

        return $result;
    }

    public function deleteSubscription(Subscription $subscription)
    {
        /* Initialize braintree payment connection */
        $gateway = $this->openGateway();

        /* Update subscription on braintree */
        $result = $gateway->subscription()->cancel($subscription->id);

        /* If successful, update local subscription*/
        if($result->success){
            $subscription = Subscription::find($subscription->id);
            $subscription->status = 'Canceled';
            $subscription->save();
        }

        return $result;
    }

    public function updateBillingAddress($token, $address)
    {
        /* Initialize braintree payment connection */
        $gateway = $this->openGateway();

        /* Update stored payment method */
        return $gateway->paymentMethod()->update(
            $token,
            [
                'billingAddress' => [
                    'firstName' => $address['firstName'],
                    'lastName' => $address['lastName'],
                    'company' => $address['company'],
                    'streetAddress' => $address['streetAddress'],
                    'extendedAddress' => $address['extendedAddress'],
                    'locality' => $address['locality'],
                    'region' => $address['region'],
                    'postalCode' => $address['postalCode'],
                    'countryName' => $address['countryName'],
                    'options' => [
                        'updateExisting' => true
                    ]
                ]
            ]
        );
    }

    public function updateCardDetails(Subscription $subscription, $nonce)
    {
        /* Initialize braintree payment connection */
        $gateway = $this->openGateway();

        /* Update subscription payment method */
        return $gateway->subscription()->update($subscription->id, [
            'paymentMethodNonce' => $nonce
        ]);
    }


}
