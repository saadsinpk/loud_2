<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property date $deleted_at
 * @property date $created_at
 * @property date $updated_at
 */

class Election extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $table = 'elections';

    /**
     * Get ward's of election.
     */
    public function wards()
    {
        return $this->hasMany(ElectionProcesse::class)->where('model_type','App//Models//Ward');
    }

    /**
     * Get pu's of election.
     */
    public function pollingunit()
    {
        return $this->hasMany(ElectionProcesse::class)->where('model_type','App//Models//PollingUnit');
    }
}
