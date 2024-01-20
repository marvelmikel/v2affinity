<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Plan;
use App\Models\Subscription;
use App\Traits\PaymentGateway;
use Illuminate\Support\Facades\Log;

class checkBraintreeSubscriptions extends Command
{
    use PaymentGateway;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'braintree:subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch any user subscriptions from braintree and check if they are active or not';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //
        // Possibly move into individual jobs per subscription once the number of subscriptions running through this increase.
        //

        // Loop subscriptions
        foreach (Subscription::all() as $subscription) {

            // Fetch subscription from braintree
            try {
                if ($sub = $this->showSubscription($subscription)) {
                    // Update local values
                    $subscription->plan_id = $sub->planId;
                    $subscription->balance = $sub->balance;
                    $subscription->billingDayOfMonth = $sub->billingDayOfMonth;
                    $subscription->firstBillingDate = $sub->firstBillingDate;
                    $subscription->nextBillingDate = $sub->nextBillingDate;
                    $subscription->billingPeriodStartDate = $sub->billingPeriodStartDate;
                    $subscription->billingPeriodEndDate = $sub->billingPeriodEndDate;
                    $subscription->paidThroughDate = $sub->paidThroughDate;
                    $subscription->currentBillingCycle = $sub->currentBillingCycle;
                    $subscription->numberOfBillingCycles = $sub->numberOfBillingCycles;
                    $subscription->neverExpires = $sub->neverExpires;
                    $subscription->daysPastDue = $sub->daysPastDue;
                    $subscription->failureCount = $sub->failureCount;
                    $subscription->addOns = json_encode($sub->addOns);
                    $subscription->discounts = json_encode($sub->discounts);
                    $subscription->status = $sub->status;
                    $subscription->statusHistory = json_encode($sub->statusHistory);
                    $subscription->transactions = json_encode($sub->transactions);
                    $subscription->save();

                    // If status is not active, update the web app site
                    if ($subscription->status != 'Active') {
                        // Disable store on app
                        // $response = apiCall( 'store/'.$subscription->user()->first()->store_id, $type = 'PUT', [ 'active' => false ]);
                    }
                }
            } catch (\Throwable $th) {
                //throw $th;
                // fail gracefully for cron job methods
                Log::error($th->getMessage(), []);
            }
        }
    }
}
