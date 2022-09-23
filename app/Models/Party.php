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

class Party extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'name',
        //'status'
    ];

    protected $table = 'parties';
}
