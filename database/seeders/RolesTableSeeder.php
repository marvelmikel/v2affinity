<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $role = Role::firstOrNew(['name' => 'admin']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('voyager::seeders.roles.admin'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'company']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('Company Super Admin'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'store manager']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('Store Manager'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'sales person']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('Sales Person'),
            ])->save();
        }

        
    }
}
