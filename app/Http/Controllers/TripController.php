<?php

namespace App\Http\Controllers;

use App\Repositories\TripRepository;

/**
 * Author: Christopher Hum
 * Date: September 17, 2017
 *
 * Class TripController
 * @package App\Http\Controllers
 *
 * TripController handles all the logic to return all existing trips in the database
 */
class TripController extends Controller
{
    protected $trips;

    /**
     * TripController constructor.
     * @param TripRepository $trips
     */
    public function __construct(TripRepository $trips)
    {
        $this->trips = $trips;
    }

    /**
     * public function index()
     * Returns all trips in the trips database
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('trips.index',
            [
                'trips' => $this->trips->getAllTrips(),
            ]);
    }
}
