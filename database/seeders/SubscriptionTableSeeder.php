<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Braintree\Configuration;
use Braintree\Gateway;

class SubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Configure Braintree
        Configuration::environment('sandbox');
        Configuration::merchantId('ypmkwpsp4t2yvk2q');
        Configuration::publicKey('zj7vwjpsfp9q4x9x');
        Configuration::privateKey('c4d22e03221e3e0206cf0051024517be');

        // Create a new subscription using Braintree
        $gateway = new Gateway([
            'environment' => Configuration::environment(),
            'merchantId' => Configuration::merchantId(),
            'publicKey' => Configuration::publicKey(),
            'privateKey' => Configuration::privateKey()
        ]);

        $subscription = $gateway->subscription()->create([
            'paymentMethodToken' => 'dummy_payment_method_token', // Replace with actual payment method token
            'planId' => 'twt6',
            'firstBillingDate' => date('Y-m-d'), // Replace with desired first billing date
        ]);
        $addOnsData = '[{"id":"hs8g","name":"Additional Monthly Affinity User","amount":"25.00","quantity":3,"neverExpires":true,"currentBillingCycle":0,"numberOfBillingCycles":null}]';
        $discounts = '[{}]';
        $statusHistory = '[{}]';
        $transactions = '[{}]';

        DB::table('subscriptions')->insert([
            'id' => $faker->unique()->bothify('????##'),
            'company_id' => 1, // Assuming company with ID 1 exists.
            'user_id' => 2, // Assuming company with ID 1 exists.
            'plan_id' => 'twt6',
            'balance' => 0,
            'billingDayOfMonth' => 9,
            'firstBillingDate' =>  date('Y-m-d', strtotime('+10 days')),
            'nextBillingDate' => date('Y-m-d', strtotime('+10 days')),
            'billingPeriodStartDate' => date('Y-m-d', strtotime('+9 days')),
            'billingPeriodEndDate' =>  date('Y-m-d', strtotime('+30 days')),
            'paidThroughDate' =>  date('Y-m-d', strtotime('+30 days')),
            'currentBillingCycle' => 0,
            'numberOfBillingCycles' => 0,
            'neverExpires' => 1,
            'daysPastDue' => 9,
            'addOns' => $addOnsData,
            'discounts' => $discounts,
            'status' => 'Active',
            'statusHistory' => $statusHistory,
            'transactions' => $transactions,
            'created_at' => now(), // Current timestamp
            'updated_at' => now(),
        ]);
    }
}
