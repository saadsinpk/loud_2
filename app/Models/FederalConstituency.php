<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property string $name
 * @property int $senatorial_district_id
 * @property date $deleted_at
 * @property date $created_at
 * @property date $updated_at
 */

class FederalConstituency extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
        'senatorial_district_id'
    ];

    protected $table = 'federal_constituencies';

    public function senatorialDistrict(){
        return $this->belongsTo(SenatorialDistrict::class , 'senatorial_district_id');
    }

    public function lga(){
        return $this->hasMany(Lga::class);
    }
}
