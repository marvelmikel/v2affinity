<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Plan;
use App\Traits\PaymentGateway;

class importBraintreePlans extends Command
{
    use PaymentGateway;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'braintree:plans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import any affinity subscription plans from Braintree into the local plan model';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Fetch plans from payment gateway
        $plans = $this->indexPlans();

        // Loop plans
        foreach($plans as $plan){

            // Only import plans that reference 'Affinity' as braintree account may be shared across companies
            if( str_contains($plan->name, 'Affinity') ){
                Plan::updateOrCreate(
                    [
                        'id' => $plan->id
                    ],
                    [
                        'name' => $plan->name,
                        'description' => $plan->description,
                        'price' => $plan->price,
                        'currencyIsoCode' => $plan->currencyIsoCode,
                        'billingFrequency' => $plan->billingFrequency,
                        'numberOfBillingCycles' => $plan->numberOfBillingCycles,
                        'trialPeriod' => $plan->trialPeriod,
                        'trialDuration' => $plan->trialDuration,
                        'trialDurationUnit' => $plan->trialDurationUnit,
                        'addOns' => json_encode($plan->addOns),
                        'discounts' => json_encode($plan->discounts),
                        'created_at' => $plan->createdAt,
                        'updated_at' => $plan->updatedAt
                    ]
                );
            }

        }
    }
}
