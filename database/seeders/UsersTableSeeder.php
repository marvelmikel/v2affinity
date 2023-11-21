<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Admin\Models\Role;
use Modules\Admin\Models\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::where('email', 'admin@admin.com')->doesntExist()) {
            $adminRole = Role::where('name', 'admin')->firstOrFail();

            User::create([
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'company_id'     => 1,
                'store_id'       => 1,
                'remember_token' => Str::random(60), // Token for 'admin'
                'role_id'        => $adminRole->id,
            ]);
        }

        // Add another user
        if (User::where('email', 'logicbarn@gmail.com')->doesntExist()) {
            $faker = Faker::create();
            
            User::create([
                'name'           => 'Logicbarn Company',
                'email'          => 'logicbarn@gmail.com',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60), // Token for 'logicbarn'
                'role_id'        => 2,
                'company_id'     => 1,
                'store_id'       => 1,
                'avatar'         => $faker->imageUrl(200, 200, 'people'), // Generates a random image URL.
            ]);
        }

        // Add Store Manager user
        if (User::where('email', 'storemanager@gmail.com')->doesntExist()) {
            $faker = Faker::create();
            
            User::create([
                'name'           => 'Store Manager',
                'email'          => 'storemanager@gmail.com',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
                'role_id'        => 3, // Assuming role with ID 3 exists.
                'company_id'     => 1,
                'store_id'       => 1,
                'avatar'         => $faker->imageUrl(200, 200, 'people'),
            ]);
        }

        // Add Sales Person user
        if (User::where('email', 'salesperson@gmail.com')->doesntExist()) {
            $faker = Faker::create();
            
            User::create([
                'name'           => 'Sales Person',
                'email'          => 'salesperson@gmail.com',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
                'role_id'        => 4, // Assuming role with ID 4 exists.
                'company_id'     => 1,
                'store_id'       => 1,
                'avatar'         => $faker->imageUrl(200, 200, 'people'),
            ]);
        }
    }
}
