<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmployeeNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        \DB::table('employer_number')->truncate();
        \DB::table('employer_number')->insert(array (
            0 =>
            array (
                'option' => 'None',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            1 =>
            array (
                'option' => '1 - 25',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            2 =>
            array (
                'option' => '26 - 50',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            3 =>
            array (
                'option' => '51 - 100',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            4 =>
            array (
                'option' => '101 - 500',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            5 =>
            array (
                'option' => '501 - 1000',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            6 =>
            array (
                'option' => 'More than 1000',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
        ));
    }
}
