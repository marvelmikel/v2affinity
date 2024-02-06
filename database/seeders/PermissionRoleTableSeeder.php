<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Models\Permission;
use Modules\Admin\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        // admin
        $role = Role::where('name', 'admin')->firstOrFail();
        $permissions = Permission::all();
        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );


        //  company
        $role = Role::where('name', 'company')->firstOrFail();
        $permissions = Permission::whereIn('key', ['browse_admin', 'browse_products', 'read_products', 'edit_products', 'add_products', 'delete_products',
            'browse_invoices', 'read_invoices', 'edit_invoices', 'add_invoices', 'delete_invoices',
            'browse_employees', 'read_employees', 'edit_employees', 'add_employees', 'delete_employees',
            'browse_stores', 'read_stores', 'edit_stores', 'add_stores', 'delete_stores']
        );
        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );


        // storemanger
        $role = Role::where('name', 'store manager')->firstOrFail();
        $permissions = Permission::whereIn('key', ['browse_admin', 'browse_products', 'read_products', 'edit_products', 'add_products', 'delete_products',
            'browse_invoices', 'read_invoices', 'edit_invoices', 'add_invoices', 'delete_invoices']
        );
        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );


        // salesperson
        $role = Role::where('name', 'sales person')->firstOrFail();
        $permissions = Permission::whereIn('key', ['browse_admin',
            'browse_invoices', 'read_invoices', 'edit_invoices', 'add_invoices', 'delete_invoices']
        );
        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );

    }
}
