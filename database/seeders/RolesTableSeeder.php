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
                'display_name' => __('voyager::seeders.roles.company'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'storemanger']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('voyager::seeders.roles.store'),
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'salesperson']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => __('voyager::seeders.roles.sale'),
            ])->save();
        }

        
    }
}
