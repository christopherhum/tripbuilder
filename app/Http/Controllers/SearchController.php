<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Input;
use App\Repositories\SearchRepository;
use Illuminate\Http\Request;

/**
 * Author: Christopher Hum
 * Created: September 17, 2017
 *
 * Class SearchController
 * @package App\Http\Controllers
 *
 *  SearchController handles all the dynamic search logic for finding Airports when adding to a Flight
 */
class SearchController extends Controller
{
    protected $search_data;

    /**
     * SearchController constructor.
     *
     * Creates an instance of SearchRepository to handle database queries
     * @param SearchRepository $search_data
     */
    public function __construct(SearchRepository $search_data)
    {
        $this->searches = $search_data;
    }

    /**
     * public function airportNameSearch($country_name)
     * Searches in airport database by country name and returns all related countries
     *
     * @param $country_name
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function airportNameSearch($country_name)
    {
        return $this->searches->searchAirportName($country_name);
    }

}
