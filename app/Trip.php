<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Author: Christopher Hum
 * Date: September 17, 2017
 *
 * Class Trip
 * @package App
 */
class Trip extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * Set up the dependency that a Trip instance has many Flights
     */
    public function Flight()
    {
        return $this->hasMany(Flight::class);

    }
}
