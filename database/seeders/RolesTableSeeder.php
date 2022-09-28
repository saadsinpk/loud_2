<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
Role::create( [
'id'=>1,
'name'=>'superAdmin',
'guard_name'=>'web',
'created_at'=>'2022-07-06 08:57:15',
'updated_at'=>'2022-07-06 08:57:15'
] );


            
Role::create( [
'id'=>2,
'name'=>'admin',
'guard_name'=>'web',
'created_at'=>'2022-07-06 08:57:15',
'updated_at'=>'2022-07-06 08:57:15'
] );


            
Role::create( [
'id'=>3,
'name'=>'user',
'guard_name'=>'web',
'created_at'=>'2022-07-06 08:57:15',
'updated_at'=>'2022-07-06 08:57:15'
] );


            
Role::create( [
'id'=>5,
'name'=>'Test 2',
'guard_name'=>'web',
'created_at'=>'2022-09-06 08:33:23',
'updated_at'=>'2022-09-06 08:33:23'
] );


            
Role::create( [
'id'=>6,
'name'=>'New role',
'guard_name'=>'web',
'created_at'=>'2022-09-07 08:50:26',
'updated_at'=>'2022-09-07 08:50:26'
] );


            
Role::create( [
'id'=>7,
'name'=>'Ward 1 Role',
'guard_name'=>'web',
'created_at'=>'2022-09-08 14:22:35',
'updated_at'=>'2022-09-08 14:22:35'
] );


    }
}
