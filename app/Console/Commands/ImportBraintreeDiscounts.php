<?php

namespace App\Console\Commands;

use App\Models\BraintreeDiscount;
use Illuminate\Console\Command;
use App\Models\Plan;
use App\Traits\PaymentGateway;

class ImportBraintreeDiscounts extends Command
{
    use PaymentGateway;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'braintree:discounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import braintree discounts';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Fetch discounts from payment gateway
        $discounts = $this->indexDiscounts();

        // Loop discounts
        foreach($discounts as $discount){

            // Only import discounts that reference 'Affinity' as braintree account may be shared across companies
            // if( str_contains($discount->name, 'Affinity') ){

                // dd( $discount );
                BraintreeDiscount::updateOrCreate(
                    [
                        'discount_id' => $discount->id
                    ],
                    [
                        'name' => $discount->name,
                        'discount_id' => $discount->name,
                        'description' => $discount->description,
                        'amount' => $discount->amount,
                        'merchant_id' => $discount->merchantId,
                        'kind' => $discount->kind,
                        'never_expires' => $discount->neverExpires,
                        'number_of_billing_cycles' => $discount->numberOfBillingCycles,
                        'created_at' => $discount->createdAt,
                        'updated_at' => $discount->updatedAt
                    ]
                );
            // }

        }
    }
}
