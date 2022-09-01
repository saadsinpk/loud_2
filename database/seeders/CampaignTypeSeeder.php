<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CampaignTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = config("constants.CAMPAIGN_TYPES");
        \DB::table('campaign_types')->truncate();
        \DB::table('campaign_types')->insert(array (
            0 =>
            array (
                'id' => $types["Standard"]["id"],
                'title' => $types["Standard"]['title'],
                'description' => 'Send a regular, one-time email campaign.',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),
            1 =>
            array (
                'id' => $types["Automated"]["id"],
                'title' => $types["Automated"]['title'],
                'description' => 'Create custom sequences of email actions and conditions.',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),

            2 =>
            array (
                'id' => $types["Reward_Email"]["id"],
                'title' => $types["Reward_Email"]['title'],
                'description' => 'Create a reward email template to send reward users frequently.',
                'created_at' => '2021-10-04 07:47:40',
                'updated_at' => '2021-10-04 07:47:40',
            ),

        ));
    }
}
