<?php

namespace App\Repositories;
use App\Trip;
use App\Flight;

/**
 * Author: Christopher Hum
 * Date: September 17, 2017
 *
 * Class TripRepository
 * @package App\Repositories
 *
 * Class used by TripController to get all existing Trips (ordered by id)
 */
class TripRepository
{
    /**
     * public function getAllTrips()
     * Used to get all existing Trips (ordered by id)
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllTrips()
    {
        $trips = Trip::orderBy('id')->get();

        return $trips;
    }
}