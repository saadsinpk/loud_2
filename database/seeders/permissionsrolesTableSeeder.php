<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class permissionsrolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
               
                'permission_id'=>198,
                'role_id'=> 3,
             ],
             [
               
                'permission_id'=>198,
                'role_id'=> 5,
             ],
             [
               
                'permission_id'=>198,
                'role_id'=> 7,
             ],[
               
                'permission_id'=>199,
                'role_id'=> 3,
             ],
             [
               
                'permission_id'=>199,
                'role_id'=> 5,
             ],
             [
               
                'permission_id'=>199,
                'role_id'=> 7,
             ],
             [
               
                'permission_id'=>200,
                'role_id'=> 2,
             ],
             [
               
                'permission_id'=>201,
                'role_id'=> 2,
             ],
             [
               
                'permission_id'=>202,
                'role_id'=> 1,
             ],
             [
               
                'permission_id'=>202,
                'role_id'=> 5,
             ],
             [
               
                'permission_id'=>202,
                'role_id'=> 6,
             ],
             [
               
                'permission_id'=>203,
                'role_id'=> 1,
             ],
             [
               
                'permission_id'=>203,
                'role_id'=> 6,
             ]
         ];


        \DB::table('role_has_permissions')->truncate();
        \DB::table('role_has_permissions')->insert($data);


$data = [
 [
'role_id'=>1,
'model_type'=>'App\\Models\\User',
'model_id'=>1
] ,
[
'role_id'=>1,
'model_type'=>'App\\Models\\User',
'model_id'=>5
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>6
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>7
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>8
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>9
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>10
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>11
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>13
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>17
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>19
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>20
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>21
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>22
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>23
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>24
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>25
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>26
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>27
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>28
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>29
] ,
[
'role_id'=>3,
'model_type'=>'App\\Models\\User',
'model_id'=>32
] ,
[
'role_id'=>5,
'model_type'=>'App\\Models\\User',
'model_id'=>30
] ,
[
'role_id'=>5,
'model_type'=>'App\\Models\\User',
'model_id'=>31
] ,
[
'role_id'=>6,
'model_type'=>'App\\Models\\User',
'model_id'=>33
] ,
[
'role_id'=>7,
'model_type'=>'App\\Models\\User',
'model_id'=>34
] ,
[
'role_id'=>7,
'model_type'=>'App\\Models\\User',
'model_id'=>35
] ,
[
'role_id'=>7,
'model_type'=>'App\\Models\\User',
'model_id'=>36
] 
]

        \DB::table('model_has_roles')->truncate();
        \DB::table('model_has_roles')->insert($data);
    }
}
