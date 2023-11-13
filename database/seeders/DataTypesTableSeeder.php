<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Models\DataType;

class DataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'users');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'users',
                'display_name_singular' => __('voyager::seeders.data_types.user.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.user.plural'),
                'icon'                  => 'voyager-person',
                'model_name'            => 'Modules\\Admin\\Models\\User',
                'policy_name'           => 'Modules\\Admin\\Policies\\UserPolicy',
                'controller'            => 'Modules\\Admin\\Http\\Controllers\\VoyagerUserController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }


        $dataType = $this->dataType('slug', 'menus');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'menus',
                'display_name_singular' => __('voyager::seeders.data_types.menu.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.menu.plural'),
                'icon'                  => 'voyager-list',
                'model_name'            => 'Modules\\Admin\\Models\\Menu',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'roles');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'roles',
                'display_name_singular' => __('voyager::seeders.data_types.role.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.role.plural'),
                'icon'                  => 'voyager-lock',
                'model_name'            => 'Modules\\Admin\\Models\\Role',
                'controller'            => 'Modules\\Admin\\Http\\Controllers\\VoyagerRoleController',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'invoices');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'invoices',
                'display_name_singular' => __('voyager::seeders.data_types.invoice.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.invoice.plural'),
                'icon'                  => 'voyager-file-text',
                'model_name'            => 'App\Models\Invoice',
                'controller'            => 'App\Http\Controllers\InvoiceController',
                'generate_permissions'  => 1,
                'description'           => 'Invoice Module',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'products');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'products',
                'display_name_singular' => __('voyager::seeders.data_types.product.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.product.plural'),
                'icon'                  => 'voyager-bag',
                'model_name'            => 'App\Models\Product',
                'controller'            => 'App\Http\Controllers\ProductController',
                'generate_permissions'  => 1,
                'description'           => 'Product Module',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'stores');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'stores',
                'display_name_singular' => __('voyager::seeders.data_types.store.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.store.plural'),
                'icon'                  => 'voyager-basket',
                'model_name'            => 'App\Models\Store',
                'controller'            => 'App\Http\Controllers\StoreController',
                'generate_permissions'  => 1,
                'description'           => 'Store Module',
            ])->save();
        }

        $dataType = $this->dataType('slug', 'company');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'company',
                'display_name_singular' => __('voyager::seeders.data_types.company.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.company.plural'),
                'icon'                  => 'voyager-company',
                'model_name'            => 'App\Models\Company',
                'controller'            => 'App\Http\Controllers\CompanyController',
                'generate_permissions'  => 1,
                'description'           => 'Company Module',
            ])->save();
        }



        $dataType = $this->dataType('slug', 'Employees');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'Add Employee',
                'display_name_singular' => __('voyager::seeders.data_types.employee.singular'),
                'display_name_plural'   => __('voyager::seeders.data_types.employee.plural'),
                'icon'                  => 'voyager-person',
                'model_name'            => 'App\Models\Employee',
                'controller'            => 'App\Http\Controllers\AddEmployeeController',
                'generate_permissions'  => 1,
                'description'           => 'Employee Module',
            ])->save();
        }

        

        
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
