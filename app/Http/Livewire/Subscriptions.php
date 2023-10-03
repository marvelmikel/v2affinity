<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use App\Models\Subscription;
use Livewire\Component;
use Livewire\WithPagination;

class Subscriptions extends Component
{
    use WithPagination;

    //public $subs = [];
    public $plans = [];

    public function mount()
    {
        // Load available plans
        $this->plans = Plan::all()->keyBy('id')->toArray();
    }

    public function render()
    {
        // Return paginated view of subscriptions for user
        return view('livewire.subscriptions', [
            'subs' => Subscription::where('user_id', auth()->user()->id)->paginate(5)
        ]);
    }

    public function asyncRender()
    {
        // Initialize braintree payment connection
        $gateway = new \Braintree\Gateway([
            'environment' => env('BTREE_ENVIRONMENT', 'sandbox'),
            'merchantId' => env('BTREE_MERCHANT_ID', 'use_your_merchant_id'),
            'publicKey' => env('BTREE_PUBLIC_KEY', 'use_your_public_key'),
            'privateKey' => env('BTREE_PRIVATE_KEY', 'use_your_private_key')
        ]);

        // Fetch customer from braintree
        $customer = $gateway->customer()->find(auth()->user()->id);

        // Check if customer subscriptions exist
        if(!empty($customer->paymentMethods)){

            // Array to hold any subscriptions
            $subs = [];

            // Loops payment methods and find any subscriptions
            foreach($customer->paymentMethods as $method){
                if(!empty($method->subscriptions)){

                    // Loop any subscriptions and add to subs array
                    foreach($method->subscriptions as $subscription){
                        $subs[] = [
                            'id' => $subscription->id,
                            'user_id' => auth()->user()->id,
                            'plan_id' => $subscription->planId,
                            'balance' => $subscription->balance,
                            'billingDayOfMonth' => $subscription->billingDayOfMonth,
                            'firstBillingDate' => $subscription->firstBillingDate,
                            'nextBillingDate' => $subscription->nextBillingDate,
                            'billingPeriodStartDate' => $subscription->billingPeriodStartDate,
                            'billingPeriodEndDate' => $subscription->billingPeriodEndDate,
                            'paidThroughDate' => $subscription->paidThroughDate,
                            'currentBillingCycle' => $subscription->currentBillingCycle,
                            'numberOfBillingCycles' => $subscription->numberOfBillingCycles,
                            'neverExpires' => $subscription->neverExpires,
                            'daysPastDue' => $subscription->daysPastDue,
                            'failureCount' => $subscription->failureCount,
                            'addOns' => json_encode($subscription->addOns),
                            'discounts' => json_encode($subscription->discounts),
                            'status' => $subscription->status,
                            'statusHistory' => json_encode($subscription->statusHistory),
                            'transactions' => json_encode($subscription->transactions)
                        ];
                    }
                }
            }

            // If subscriptions found, populate DB
            if(!empty($subs)){

                // Upsert subscriptions from braintree
                Subscription::upsert(
                    $subs,
                    ['id','user_id','plan_id'],
                    [
                        'balance',
                        'billingDayOfMonth',
                        'firstBillingDate',
                        'nextBillingDate',
                        'billingPeriodStartDate',
                        'billingPeriodEndDate',
                        'paidThroughDate',
                        'currentBillingCycle',
                        'numberOfBillingCycles',
                        'neverExpires',
                        'daysPastDue',
                        'failureCount',
                        'addOns',
                        'discounts',
                        'status',
                        'statusHistory',
                        'transactions'
                    ]
                );

                // Delete any subscriptions deleted from braintree
                Subscription::whereNotIn('id', array_column($subs, 'id') )->delete();

            }
        }
    }
}
