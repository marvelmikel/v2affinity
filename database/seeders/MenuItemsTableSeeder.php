<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\Models\Menu;
use Modules\Admin\Models\MenuItem;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::where('name', 'admin')->firstOrFail();

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.dashboard'),
            'url'     => '',
            'route'   => 'voyager.dashboard',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-boat',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 1,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.media'),
            'url'     => '',
            'route'   => 'voyager.media.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-images',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 2,
            ])->save();
        }


        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.users'),
            'url'     => '',
            'route'   => 'voyager.users.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-person',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 3,
            ])->save();
        }


        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.roles'),
            'url'     => '',
            'route'   => 'voyager.roles.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-lock',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 4,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Invoices'),
            'url'     => '',
            'route'   => 'voyager.invoices.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-file-text',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 5,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Stores'),
            'url'     => '',
            'route'   => 'voyager.stores.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-shop',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 6,
            ])->save();
        }
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Products'),
            'url'     => '',
            'route'   => 'voyager.products.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-basket',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 7,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Employees'),
            'url'     => '',
            'route'   => 'voyager.employee.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-person',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 8,
            ])->save();
        }


        

        $toolsMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.tools'),
            'url'     => '',
        ]);
        if (!$toolsMenuItem->exists) {
            $toolsMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-tools',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 9,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.menu_builder'),
            'url'     => '',
            'route'   => 'voyager.menus.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-list',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 10,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.database'),
            'url'     => '',
            'route'   => 'voyager.database.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-data',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 11,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.compass'),
            'url'     => '',
            'route'   => 'voyager.compass.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-compass',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 12,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.bread'),
            'url'     => '',
            'route'   => 'voyager.bread.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-bread',
                'color'      => null,
                'parent_id'  => $toolsMenuItem->id,
                'order'      => 13,
            ])->save();
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('voyager::seeders.menu_items.settings'),
            'url'     => '',
            'route'   => 'voyager.settings.index',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-settings',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 14,
            ])->save();
        }

        $menuItemCompany = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Company'),
            'url'     => '',
            'route'   => 'voyager.company.index',
        ]);
        if (!$menuItemCompany->exists) {
            $menuItemCompany->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-company',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 15,
            ])->save();
        }

        $subMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('General'),
            'url'     => '',
            'route'   => 'voyager.company.index',
        ]);
        if (!$subMenuItem->exists) {
            $subMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-company',
                'color'      => null,
                'parent_id'  => $menuItemCompany->id,
                'order'      => 16,
            ])->save();
        }


        $subMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Subscription'),
            'url'     => '',
            'route'   => 'company.subscriptions',
        ]);
        if (!$subMenuItem->exists) {
            $subMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-dollar',
                'color'      => null,
                'parent_id'  => $menuItemCompany->id,
                'order'      => 17,
            ])->save();
        }

        $subMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Logs'),
            'url'     => '',
            'route'   => 'voyager.company.logs',
        ]);
        if (!$subMenuItem->exists) {
            $subMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-logbook',
                'color'      => null,
                'parent_id'  => $menuItemCompany->id,
                'order'      => 18,
            ])->save();
        }



      


        //Support Docs section 
        $menuItemCompany = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('Support Docs'),
            'url'     => '',
            'route'   => '',
        ]);
        if (!$menuItemCompany->exists) {
            $menuItemCompany->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-documentation',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 19,
            ])->save();
        }


        $subMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('User Guide'),
            'url'     => 'http://affinity-dev2.test/support-docs/user-guide.pdf',
            'route'   => '',
        ]);
        if (!$subMenuItem->exists) {
            $subMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-file-text',
                'color'      => null,
                'parent_id'  => $menuItemCompany->id,
                'order'      => 20,
            ])->save();
        }



        $subMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('add Carpet & Roll Items'),
            'url'     => 'http://affinity-dev2.test/support-docs/user-guide.pdf',
            'route'   => '',
        ]);
        if (!$subMenuItem->exists) {
            $subMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-receipt',
                'color'      => null,
                'parent_id'  => $menuItemCompany->id,
                'order'      => 21,
            ])->save();
        }


        $subMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('add  packed/tile item'),
            'url'     => 'http://affinity-dev2.test/support-docs/user-guide.pdf',
            'route'   => '',
        ]);
        if (!$subMenuItem->exists) {
            $subMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-receipt',
                'color'      => null,
                'parent_id'  => $menuItemCompany->id,
                'order'      => 22,
            ])->save();
        }

        $subMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('add  roll end'),
            'url'     => 'http://affinity-dev2.test/support-docs/user-guide.pdf',
            'route'   => '',
        ]);
        if (!$subMenuItem->exists) {
            $subMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-receipt',
                'color'      => null,
                'parent_id'  => $menuItemCompany->id,
                'order'      => 23,
            ])->save();
        }


        $subMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('add underlay'),
            'url'     => 'http://affinity-dev2.test/support-docs/user-guide.pdf',
            'route'   => '',
        ]);
        if (!$subMenuItem->exists) {
            $subMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-receipt',
                'color'      => null,
                'parent_id'  => $menuItemCompany->id,
                'order'      => 24,
            ])->save();
        }


        $subMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('add other stocks'),
            'url'     => 'http://affinity-dev2.test/support-docs/user-guide.pdf',
            'route'   => '',
        ]);
        if (!$subMenuItem->exists) {
            $subMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-receipt',
                'color'      => null,
                'parent_id'  => $menuItemCompany->id,
                'order'      => 25,
            ])->save();
        }


        $subMenuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => __('create new invoice'),
            'url'     => 'http://affinity-dev2.test/support-docs/user-guide.pdf',
            'route'   => '',
        ]);
        if (!$subMenuItem->exists) {
            $subMenuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-receipt',
                'color'      => null,
                'parent_id'  => $menuItemCompany->id,
                'order'      => 26,
            ])->save();
        }
             

    



        
    }
}