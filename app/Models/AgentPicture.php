<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $path
 * @property string $description
 * @property date $deleted_at
 * @property date $created_at
 * @property date $updated_at
 */

class AgentPicture extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'path',
        'description',
        'political_party_agent_id'
    ];

    protected $table = 'agent_pictures';

    public function politicalPartyAgent(){
        return $this->belongsTo(PoliticalPartyAgent::class);
    }
}
