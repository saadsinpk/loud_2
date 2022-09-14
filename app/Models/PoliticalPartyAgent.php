<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property string $political_party
 * @property string $name
 * @property string $agent_picture
 * @property int $lga_id
 * @property int $wards_id
 * @property int $polling_unit_id
 * @property text $designation
 * @property text $home_address
 * @property text $mobile
 * @property text $extra_mobile
 * @property boolean $signature_agent
 * @property boolean $signature_auth_party_officials
 * @property text $name_party_chairman
 * @property boolean $signature_party_chairman
 * @property text $name_electoral_officer
 * @property boolean $signature_electoral_officer
 * @property date $deleted_at
 * @property date $created_at
 * @property date $updated_at
 */

class PoliticalPartyAgent extends Model
{
    use HasFactory , SoftDeletes ;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'political_party',
        'name',
        'agent_picture',
        'lga_id',
        'wards_id',
        'polling_unit_id',
        'designation',
        'home_address',
        'mobile',
        'extra_mobile',
        'signature_agent',
        'signature_auth_party_officials',
        'name_party_chairman',
        'signature_party_chairman',
        'name_electoral_officer',
        'signature_electoral_officer',
    ];

    protected $table = 'political_party_agents';

    public function lga(){
        return $this->belongsTo(Lga::class);
    }

    public function ward(){
        return $this->belongsTo(Ward::class);
    }

    public function pollingUnit(){
        return $this->belongsTo(PollingUnit::class);
    }

}
