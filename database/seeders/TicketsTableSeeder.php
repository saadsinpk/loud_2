<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::create( [
        'id'=>1,
        'hash'=>'05510bd5e80010bbf7101060112c9cec',
        'data'=>'hashim.ikram@yahoo.com',
        'expires'=>'2016-07-15 19:33:56'
        ] );
    }
}
