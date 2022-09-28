<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PoliticalPartyAgent;

class AgentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PoliticalPartyAgent::create( [
        'id'=>6,
        'political_party' =>'PDP',
        'first_name'=>'PDP',
        'middle_name'=>'PDP',
        'last_name'=>'PDP',
        'party_id'=>68,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'election_id'=>1,

        
        'lga_id',
        'polling_unit_id',
        'designation' =>'designation',
        'home_address' =>'home_address',
        'mobile' =>'mobile' ,
        'name_party_chairman' =>'empty',
        'name_electoral_officer' =>'empty',
        'party_id',
       
        
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>9,
        'name'=>'APC',
        'party_id'=>18,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>2
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>10,
        'name'=>'PDP',
        'party_id'=>68,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>2
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>11,
        'name'=>'ACCORD',
        'party_id'=>1,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>2
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>12,
        'name'=>'SDP',
        'party_id'=>80,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>2
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>15,
        'name'=>'SADIQ UMAR/kWARA NORTH CENTRAL',
        'party_id'=>18,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>3
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>17,
        'name'=>' APC',
        'party_id'=>18,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>1
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>18,
        'name'=>'ACCORD',
        'party_id'=>1,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>1
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>19,
        'name'=>'YPP',
        'party_id'=>92,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>1
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>20,
        'name'=>'ANN',
        'party_id'=>14,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>1
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>21,
        'name'=>'AAC',
        'party_id'=>4,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>1
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>22,
        'name'=>'PT',
        'party_id'=>75,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>1
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>24,
        'name'=>'SDP',
        'party_id'=>80,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>1
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>25,
        'name'=>'ADP',
        'party_id'=>10,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>1
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>26,
        'name'=>'APC',
        'party_id'=>18,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>5
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>27,
        'name'=>'PDP',
        'party_id'=>68,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>5
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>28,
        'name'=>'ACCORD',
        'party_id'=>1,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>5
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>29,
        'name'=>'SDP',
        'party_id'=>80,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>5
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>30,
        'name'=>'ACC',
        'party_id'=>4,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>5
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>31,
        'name'=>'INV',
        'party_id'=>97,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>1
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>32,
        'name'=>'INVALID VOTE',
        'party_id'=>97,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>5
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>33,
        'name'=>'INVALID VOTE',
        'party_id'=>97,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>6
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>34,
        'name'=>'INVALID VOTE',
        'party_id'=>97,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>7
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>35,
        'name'=>'LP',
        'party_id'=>44,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>6
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>36,
        'name'=>'APC',
        'party_id'=>18,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>6
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>37,
        'name'=>'ACCORD',
        'party_id'=>1,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>6
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>38,
        'name'=>'SDP',
        'party_id'=>80,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>6
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>39,
        'name'=>'PDP',
        'party_id'=>68,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>6
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>40,
        'name'=>'LP',
        'party_id'=>44,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>5
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>41,
        'name'=>'APC',
        'party_id'=>18,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>7
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>42,
        'name'=>'ACCORD',
        'party_id'=>1,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>7
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>43,
        'name'=>'PDP',
        'party_id'=>68,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>7
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>44,
        'name'=>'SDP',
        'party_id'=>80,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>7
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>45,
        'name'=>'LABOUR PARTY',
        'party_id'=>44,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>7
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>46,
        'name'=>'ACTION DEMOCRATIC PARTY',
        'party_id'=>10,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>7
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>47,
        'name'=>'ACCORD',
        'party_id'=>1,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>8
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>48,
        'name'=>'APC',
        'party_id'=>18,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>8
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>49,
        'name'=>'AAC',
        'party_id'=>4,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>8
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>50,
        'name'=>'PDP',
        'party_id'=>68,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>8
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>51,
        'name'=>'INV',
        'party_id'=>97,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>8
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>52,
        'name'=>'ACCORD',
        'party_id'=>1,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>9
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>53,
        'name'=>'AAC',
        'party_id'=>4,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>9
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>54,
        'name'=>'APC',
        'party_id'=>18,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>9
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>55,
        'name'=>'PDP',
        'party_id'=>68,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>9
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>56,
        'name'=>'INV',
        'party_id'=>97,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>9
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>57,
        'name'=>'ACCORD',
        'party_id'=>1,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>10
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>58,
        'name'=>'AAC',
        'party_id'=>4,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>10
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>59,
        'name'=>'APC',
        'party_id'=>18,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>10
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>60,
        'name'=>'PDP',
        'party_id'=>68,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>10
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>61,
        'name'=>'SDP',
        'party_id'=>80,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>10
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>62,
        'name'=>'INV',
        'party_id'=>97,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>10
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>63,
        'name'=>'ACCORD',
        'party_id'=>1,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>11
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>64,
        'name'=>'AAC',
        'party_id'=>4,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>11
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>65,
        'name'=>'APC',
        'party_id'=>18,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>11
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>66,
        'name'=>'SDP',
        'party_id'=>80,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>11
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>67,
        'name'=>'PDP',
        'party_id'=>68,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>11
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>68,
        'name'=>'INV',
        'party_id'=>97,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>11
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>69,
        'name'=>'ACCORD',
        'party_id'=>1,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>12
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>70,
        'name'=>'AAC',
        'party_id'=>4,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>12
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>71,
        'name'=>'SDP',
        'party_id'=>80,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>12
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>72,
        'name'=>'PDP',
        'party_id'=>68,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>12
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>73,
        'name'=>'APC',
        'party_id'=>18,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>12
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>74,
        'name'=>'INV',
        'party_id'=>97,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>12
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>75,
        'name'=>'ACCORD',
        'party_id'=>1,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>4
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>76,
        'name'=>'AAC',
        'party_id'=>4,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>4
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>77,
        'name'=>'PDP',
        'party_id'=>68,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>4
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>78,
        'name'=>'APC',
        'party_id'=>18,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>4
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>79,
        'name'=>'SDP',
        'party_id'=>80,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>4
        ] );
                    
        PoliticalPartyAgent::create( [
        'id'=>80,
        'name'=>'INV',
        'party_id'=>97,
        'constituency_id'=>NULL,
        'wards_id'=>NULL,
        'number_of_votes'=>0,
        'election_id'=>4
        ] );
            }
}
