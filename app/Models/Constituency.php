<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $asembly
 * @property string $phone
 * @property double $latitude
 * @property double $longitude
 * @property date $created_at
 * @property date $updated_at
 */

class Constituency extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
        'asembly',
        'phone',
        'latitude',
        'longitude',
    ];

    protected $table = 'constituencies';
}
