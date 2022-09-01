<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('user_levels')->truncate();
        \DB::table('user_levels')->insert(array (
            0 =>
            array (
                'level' => 'Professional',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            1 =>
            array (
                'level' => 'Large volume',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            2 =>
            array (
                'level' => 'Distributor',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
        ));
    }
}
