<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 1) as $index) { // This will create 10 company entries.
            DB::table('companies')->insert([
                'company_name'    => $faker->company,
                'company_email'   => $faker->unique()->companyEmail,
                'company_address' => $faker->address,
                'company_phone'   => $faker->phoneNumber,
                'company_number'  => $faker->randomNumber(8),
                'vat_number'      => $faker->randomNumber(9),
                'logo'            => $faker->imageUrl(200, 200, 'business', true),
                'active'          => 1, // Set active to be always 1 as per your requirement
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}
