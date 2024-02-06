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
                'company_name'    => 'LogicBarn',
                'company_email'   => 'dev@logicbarn.com',
                'company_address' => '9 Melbourne Business Court, Pride Park, Derby DE24 8LZ',
                'company_phone'   => '03032230110',
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
