<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Author: Christopher Hum
 * Date: September 17, 2017
 *
 * Class Flight
 * @package App
 *
 * Create dependency that a Flight instance can be linked to one Trip (but not more)
 */
class Flight extends Model
{
    protected $fillable = ['airport_from', 'airport_to', 'trip_id'];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * A flight belongs to one Trip
     */
    public function trips()
    {
        return $this->belongsTo(Trip::class);
    }


}
