<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $political_party
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
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
 * @property boolean $party_id
 * @property boolean $constituency_id
 * @property boolean $latitude
 * @property boolean $longitude
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
        'first_name',
        'middle_name',
        'last_name',
        'slug',
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
        'party_id',
        'constituency_id',
        'latitude',
        'longitude'
    ];

    protected $table = 'political_party_agents';


    public function party(){
        return $this->belongsTo(Party::class , 'party_id');
    }

    public function constituency(){
        return $this->belongsTo(Constituency::class,'constituency_id');
    }


    public function lga(){
        return $this->belongsTo(Lga::class);
    }

    public function ward(){
        return $this->belongsTo(Ward::class,'wards_id');
    }

    public function pollingUnit(){
        return $this->belongsTo(PollingUnit::class);
    }


    public function agentPicture(){
        return $this->hasMany(AgentPicture::class);
    }
    

    protected static function boot()
    {
        parent::boot();
        static::created(function ($agent) {
            $agent->slug = $agent->generateSlug($agent->first_name.' '.$agent->middle_name.' '.$agent->last_name)
            $agent->save();
               
               
        });

        static::retrieved(function ($agent) {
            if($agent->slug == null){
                $agent->slug = $agent->generateSlug($agent->first_name.' '.$agent->middle_name.' '.$agent->last_name)
                $agent->save();
            }
        });
    }

    private function generateSlug($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::whereName($name)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    } 

}
