<?php

namespace App\Repositories;
use App\Trip;
use App\Flight;

/**
 * Author: Christopher Hum
 * Date: September 17, 2017
 *
 * Class FlightRepository
 * @package App\Repositories
 *
 * Class used to do all searching logic for Flights in database
 */
class FlightRepository
{
    public function getFlightsForTrip(Trip $trip)
    {
        return Flight::where('trip_id', $trip->id)
            ->orderBy('trip_id', 'asc')
            ->get();
    }

    /**
     * public function getFlightsForOneTrip(int $trips)
     * Used by FlightController to get all flights for a specific Trip
     *
     * @param int $trips
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getFlightsForOneTrip(int $trips)
    {
        return Flight::where('trip_id', $trips)
            ->orderBy('trip_id', 'asc')
            ->get();
    }

    /**
     * public function getAllFlights()
     * Used by FlightController to return all existing Flight instances
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllFlights()
    {
        $flights = Flight::orderBy('trip_id')->get();

        return $flights;
    }


}