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


        // Language::insert($data);
    }
}
