<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('stores')->insert([
            'company_id'          => 1, // Assuming company with ID 1 exists.
            'store_name'          => 'United Carpet',
            'next_invoice_number' => $faker->unique()->randomNumber(8),
            'address_line_1'      => $faker->streetAddress,
            'address_line_2'      => $faker->secondaryAddress,
            'address_city'        => $faker->city,
            'address_county'      => $faker->state,
            'address_postcode'    => $faker->postcode,
            'store_email'         => $faker->companyEmail,
            'store_phone'         => $faker->phoneNumber,
            'store_logo'                => $faker->imageUrl(200, 200, 'business'), // Generates a random business-related image URL.
            'created_at'          => now(), // Current timestamp
            // If you are using the updated_at column, you should add it here as well
            'updated_at'          => now(),
        ]);
    }
}
