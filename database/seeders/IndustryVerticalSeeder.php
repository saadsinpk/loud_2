<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IndustryVerticalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('industry_vertical')->truncate();
        \DB::table('industry_vertical')->insert(array (
            0 =>
            array (
                'option' => 'None',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            1 =>
            array (
                'option' => 'Accounting/Financial',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            2 =>
            array (
                'option' => 'Consulting/Agency',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            3 =>
            array (
                'option' => 'Blogger/Author',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            4 =>
            array (
                'option' => 'Ecommerce/Retail',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            5 =>
            array (
                'option' => 'Entertainment/Events',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            6 =>
            array (
                'option' => 'Fitness/Nutrition',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            7 =>
            array (
                'option' => 'Healthcare',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            8 =>
            array (
                'option' => 'Media/Publishing',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            9 =>
            array (
                'option' => 'Non-Profit',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            10 =>
            array (
                'option' => 'Online Tranding/Education',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            11 =>
            array (
                'option' => 'Real Estate',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            12 =>
            array (
                'option' => 'Software',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            13 =>
            array (
                'option' => 'Travel/Hospitality',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            14 =>
            array (
                'option' => 'Other',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
        ));
    }
}
