<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FederalConstituency;

class FederalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
FederalConstituency::create( [
'id'=>17,
'name'=>'      Baruten/kaiama',
'senatorial_district_id'=>NULL
] );


            
FederalConstituency::create( [
'id'=>18,
'name'=>'Edu/moro/patigi',
'senatorial_district_id'=>NULL
] );


            
FederalConstituency::create( [
'id'=>19,
'name'=>'Ekiti/isin/irepodun/oke-ero',
'senatorial_district_id'=>NULL
] );


            
FederalConstituency::create( [
'id'=>20,
'name'=>'Ifelodun/offa/oyun',
'senatorial_district_id'=>NULL
] );


            
FederalConstituency::create( [
'id'=>21,
'name'=>'Ilorin East/ilorin South',
'senatorial_district_id'=>NULL
] );


            
FederalConstituency::create( [
'id'=>22,
'name'=>'Ilorin West/asa',
'senatorial_district_id'=>NULL
] );


    }
}
