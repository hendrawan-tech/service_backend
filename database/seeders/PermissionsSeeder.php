<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list services']);
        Permission::create(['name' => 'view services']);
        Permission::create(['name' => 'create services']);
        Permission::create(['name' => 'update services']);
        Permission::create(['name' => 'delete services']);

        Permission::create(['name' => 'list timelines']);
        Permission::create(['name' => 'view timelines']);
        Permission::create(['name' => 'create timelines']);
        Permission::create(['name' => 'update timelines']);
        Permission::create(['name' => 'delete timelines']);

        Permission::create(['name' => 'list productservicecategories']);
        Permission::create(['name' => 'view productservicecategories']);
        Permission::create(['name' => 'create productservicecategories']);
        Permission::create(['name' => 'update productservicecategories']);
        Permission::create(['name' => 'delete productservicecategories']);

        Permission::create(['name' => 'list categoryproducts']);
        Permission::create(['name' => 'view categoryproducts']);
        Permission::create(['name' => 'create categoryproducts']);
        Permission::create(['name' => 'update categoryproducts']);
        Permission::create(['name' => 'delete categoryproducts']);

        Permission::create(['name' => 'list products']);
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'update products']);
        Permission::create(['name' => 'delete products']);

        Permission::create(['name' => 'list productimages']);
        Permission::create(['name' => 'view productimages']);
        Permission::create(['name' => 'create productimages']);
        Permission::create(['name' => 'update productimages']);
        Permission::create(['name' => 'delete productimages']);

        Permission::create(['name' => 'list allorderitems']);
        Permission::create(['name' => 'view allorderitems']);
        Permission::create(['name' => 'create allorderitems']);
        Permission::create(['name' => 'update allorderitems']);
        Permission::create(['name' => 'delete allorderitems']);

        Permission::create(['name' => 'list productservices']);
        Permission::create(['name' => 'view productservices']);
        Permission::create(['name' => 'create productservices']);
        Permission::create(['name' => 'update productservices']);
        Permission::create(['name' => 'delete productservices']);

        Permission::create(['name' => 'list allorders']);
        Permission::create(['name' => 'view allorders']);
        Permission::create(['name' => 'create allorders']);
        Permission::create(['name' => 'update allorders']);
        Permission::create(['name' => 'delete allorders']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
