<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin_test', 
            'email' => 'admin2@gmail.com',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
    
       // $role = Role::create(['name' => 'admin']);
        $role = Role::where('id','1')->first();
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}