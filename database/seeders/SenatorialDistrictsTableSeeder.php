<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SenatorialDistrict;

class SenatorialDistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SenatorialDistrict::create( [
        'id'=>9,
        'name'=>'KWARA CENTRAL',
        'state_id'=> 1
        ] );


                    
        SenatorialDistrict::create( [
        'id'=>10,
        'name'=>'KWARA NORTH',
        'state_id'=> 1
        ] );


                    
        SenatorialDistrict::create( [
        'id'=>11,
        'name'=>'KWARA SOUTH',
        'state_id'=> 1
        ] );
    }
}
