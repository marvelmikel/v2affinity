<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB; // Add this line to import the DB class

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $addOnsData = '[{"id":"hs8g","name":"Additional Monthly Affinity User","amount":"25.00","quantity":3,"neverExpires":true,"currentBillingCycle":0,"numberOfBillingCycles":null}]';
        $discounts = '[{}]';

        DB::table('plans')->insert([
            'id' => 'twt6',
            'name'            => 'Affinity Monthly Subscription (Users)',
            'description'     => 'Subscription for the Levels CRM and Surveying system, £120.00 per Surveyor and unlimited reports.',
            'price'           => 0,
            'currencyIsoCode' => 'GBP',
            'billingFrequency'=> 1,
            'numberOfBillingCycles' => 0,
            'trialPeriod'   => 1,
            'trialDuration'   => 7,
            'trialDurationUnit'  => 'day',
            'addOns'   => $addOnsData, // Generates a random business-related image URL.
            'discounts'   => $discounts, // Generates a random business-related image URL.
            'created_at'  => now(), // Current timestamp
            'updated_at' => now(),
        ]);
    }
}
