<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Election;

class ElectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Election::create( [
        'id'=>1,
        'name'=>'PRESIDENTIAL'
        ] );


                    
        Election::create( [
        'id'=>2,
        'name'=>'GOVERNORSHIP'
        ] );


                    
        Election::create( [
        'id'=>4,
        'name'=>'HOUSE OF REPRESENTATIVE A'
        ] );


                    
        Election::create( [
        'id'=>5,
        'name'=>'KWARA NORTH SENATORIAL'
        ] );


                    
        Election::create( [
        'id'=>6,
        'name'=>'KWARA CENTRAL SENATORIAL'
        ] );


                    
        Election::create( [
        'id'=>7,
        'name'=>'KWARA SOUTH SENATORIAL'
        ] );


                    
        Election::create( [
        'id'=>8,
        'name'=>'HOUSE OF REPRESENTATIVE B'
        ] );


                    
        Election::create( [
        'id'=>9,
        'name'=>'HOUSE OF REPRESENTATIVE C'
        ] );


                    
        Election::create( [
        'id'=>10,
        'name'=>'HOUSE OF REPRESENTATIVE D'
        ] );


                    
        Election::create( [
        'id'=>11,
        'name'=>'HOUSE OF REPRESENTATIVE E'
        ] );


                    
        Election::create( [
        'id'=>12,
        'name'=>'HOUSE OF REPRESENTATIVE F'
        ] );
    }
}
