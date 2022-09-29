<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'view']);
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'publish']);
        Permission::create(['name' => 'unpublish']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'superAdmin' , 'guard_name' => 'web']);
        $role1->givePermissionTo('edit');
        $role1->givePermissionTo('delete');
        $role1->givePermissionTo('publish');
        $role1->givePermissionTo('unpublish');
        $role1->givePermissionTo('view');
        $role1->givePermissionTo('create');

        $role2 = Role::create(['name' => 'admin']);
        $role3 = Role::create(['name' => 'customer']);
        $role3 = Role::create(['name' => 'web']);
        $role3 = Role::create(['name' => 'user']);


        $role2->givePermissionTo('edit');
        $role2->givePermissionTo('delete');
        $role2->givePermissionTo('publish');
        $role2->givePermissionTo('unpublish');
        $role2->givePermissionTo('view');
        $role2->givePermissionTo('create');

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Super',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make("123456789"),
        ]);
        $user->assignRole($role1);

    }
}
