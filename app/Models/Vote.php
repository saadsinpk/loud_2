<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


/**
  * @property int 'id' ,
  * @property string 'name' ,
  * @property int 'polling_unit_id' ,
  * @property int 'election_id' ,
  * @property int 'ec8as' ,
  * @property int 'no_of_voters' ,
  * @property int 'voters_accredited' ,
  * @property int 'ballot_issued' ,
  * @property int 'ballot_used' ,
  * @property int 'rejected_ballot' ,
  * @property int 'spoilt_ballot' ,
  * @property int 'votes_cast' ,
  * @property int 'votes_rejected' ,
  * @property int 'error' ,
  * @property date 'deleted_at' ,
  * @property date 'created_at' ,
  * @property date 'updated_at' 
 */

class Vote extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
      'name' ,
      'polling_unit_id' ,
      'election_id' ,
      'ec8as' ,
      'no_of_voters' ,
      'voters_accredited' ,
      'ballot_issued' ,
      'ballot_used' ,
      'rejected_ballot' ,
      'spoilt_ballot' ,
      'votes_cast' ,
      'votes_rejected' ,
      'error' ,
    ];

    protected $table = 'votes';

    /**
     * Get election.
     */
    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    /**
     * Get Polling Unit.
     */
    public function pollingUnit()
    {
        return $this->belongsTo(PollingUnit::class);
    }
}
