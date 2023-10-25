<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VoyagerDummyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            InvoicesTableSeeder::class,
            ProductsTableSeeder::class,
            StoresTableSeeder::class,
            TranslationsTableSeeder::class,
            PermissionRoleTableSeeder::class,
        ]);
    }
}
