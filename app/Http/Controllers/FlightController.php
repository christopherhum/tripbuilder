<?php

namespace App\Http\Controllers;

use App\Repositories\FlightRepository;
use App\Flight;
use Illuminate\Http\Request;


/**
 * Author: Christopher Hum
 * Created: September 17, 2017
 *
 * Class FlightController
 * @package App\Http\Controllers
 *
 * FlightController controls all the logic to get/store and delete Flights for a Trip.
 * This includes accessing the Airport Database to get names of airports for From and To destinations for Flights.
 *
 */
class FlightController extends Controller
{

    /**
     * @var FlightRepository
     */
    protected $flights;

    /**
     * FlightController constructor.
     * Creates a FlightRepository instance which does database access and returns to this instance
     *
     * @param FlightRepository $flights
     */
    public function __construct(FlightRepository $flights)
    {
        $this->flights = $flights;
    }

    /**
     * function index(Request $request)
     * Retrieves all the flights for this instance
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('trips.index',
            [
                'flights' => $this->flights->getAllFlights(),
            ]);
    }

    /**
     * function getFlights(Request $request)
     * Retrieves all the flights for a specific Trip.  This method stores the current_trip number selected by user.
     * Using this trip number we can retrieve all the current flights for that trip.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFlights(Request $request)
    {
        //Note Session class holds the request for the next page
        \Session::put('current_trip', $request->input('selectedTrip')) ;
        return view('trips.trip',
            [
                'flights' => $this->flights->getFlightsForOneTrip($request->input('selectedTrip'))
            ]);
    }

    /**
     * public function store(Request $request)
     * Saves the selected flight (airport_from and airport_to) into current trip number.  After saving the user
     * is redirected to same page
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $flight = new Flight;
        $flight->fill(['airport_from' => $request->currentFrom, 'airport_to' => $request->currentTo, 'trip_id' => \Session::get('current_trip') ]);
        $flight->save();

        return redirect()->action( 'FlightController@getFlights',['selectedTrip' => \Session::get('current_trip') ]);
    }

    /**
     * public function destroy(Flight $flight)
     * Deletes a selected row from current Trip.  Redirects to same page
     *
     * @param Flight $flight
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Flight $flight)
    {
        $flight->delete();
        return redirect()->action( 'FlightController@getFlights',['selectedTrip' => \Session::get('current_trip') ]);
    }
}
