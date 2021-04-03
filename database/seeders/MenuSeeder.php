<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backendSidebar = Menu::updateOrcreate([
            'name' => 'backend-sidebar',
            'description' => 'Backend sidebar.',
            'deletable' => false,
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $backendSidebar->id,
            'type' => 'divider',
            'order' => 1,
            'divider_title' => 'Menus'
        ]);
        MenuItem::updateOrCreate([
            'menu_id' => $backendSidebar->id,
            'type' => 'item',
            'order' => 2,
            'title' => 'Dashboard',
            'url' => "/app/dashboard",
            'icon_class' => 'pe-7s-culture',
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $backendSidebar->id,
            'type' => 'divider',
            'order' => 3,
            'divider_title' => 'Sustem',
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $backendSidebar->id,
            'type' => 'item',
            'order' => 4,
            'title' => 'Roles',
            'url' => "/app/roles",
            'icon_class' => 'pe-7s-tools',
        ]);
        MenuItem::updateOrCreate([
            'menu_id' => $backendSidebar->id,
            'type' => 'item',
            'order' => 5,
            'title' => 'Users',
            'url' => "/app/users",
            'icon_class' => 'pe-7s-users',
        ]);
        MenuItem::updateOrCreate([
            'menu_id' => $backendSidebar->id,
            'type' => 'item',
            'order' => 6,
            'title' => 'Backups',
            'url' => "/app/backups",
            'icon_class' => 'pe-7s-cloud',
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $backendSidebar->id,
            'type' => 'divider',
            'order' => 7,
            'divider_title' => 'Object',
        ]);

        MenuItem::updateOrCreate([
            'menu_id' => $backendSidebar->id,
            'type' => 'item',
            'order' => 8,
            'title' => 'Pages',
            'url' => "/app/pages",
            'icon_class' => 'pe-7s-news-paper',
        ]);
        MenuItem::updateOrCreate([
            'menu_id' => $backendSidebar->id,
            'type' => 'item',
            'order' => 9,
            'title' => 'Menu',
            'url' => "/app/menus",
            'icon_class' => 'pe-7s-menu',
        ]);


    }
}
