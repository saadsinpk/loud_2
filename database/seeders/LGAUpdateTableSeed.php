<?php

namespace Database\Seeders;

use App\Models\Lga;
use Illuminate\Database\Seeder;

class LGAUpdateTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('lgas')->update(['state_id'=>'1']);
    }
}
