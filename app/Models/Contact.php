<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property string $device_id
 * @property string $device_type
 * @property string $firebase_token
 * @property string $os_version
 * @property boolean $visitor
 * @property int $user_id
 * @property date $created_at
 * @property date $updated_at
 */

class Contact extends Model
{
    use HasFactory , SoftDeletes;
}
