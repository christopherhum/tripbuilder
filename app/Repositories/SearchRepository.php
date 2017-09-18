<?php


namespace App\Repositories;
use App\Airport;
use App\Trip;
use App\Flight;


/**
 * Author: Christopher Hum
 * Date: September 17, 2017
 *
 * Class SearchRepository
 * @package App\Repositories
 *
 * Class used by SearchController to do database queries and return results
 */
class SearchRepository
{
    /**
     * public function searchAirportName(string $airport_search)
     * Return all airport names that match a similar search. Used in dynamic searching of airports
     *
     * @param string $airport_search
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function searchAirportName(string $airport_search)
    {
        return Airport::where('name', 'LIKE', '%'.$airport_search.'%')
            ->orderBy('name', 'asc')
            ->get();

    }

    /**
     * public function searchAirportName(string $airport_search)
     * Return all airports countries that match a similar search. Used in dynamic searching of airports
     *
     * @param string $airport_search
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function searchAirportCountry(string $airport_search)
    {
        return Airport::where('country', 'LIKE', '%'.$airport_search.'%')
            ->orderBy('name', 'asc')
            ->get();

    }
}