<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main Page
Route::get('/tripbuilder', 'TripController@index');
//Redirect from root to Main Page (/tripbuilder)
Route::get('/', function () {return redirect('/tripbuilder');});

//Add new Flight from airports chosen
Route::post('/addflight', ['uses' => 'FlightController@store']);

// Page displayed of Flights corresponding to the selected Trip
Route::get('/edittrip', 'FlightController@getFlights');

// Route that sends flight number to delete as {flight}
Route::delete('/removeFlight/{flight}', 'FlightController@destroy');

Route::get('/airportsearch', 'SearchController@airportSearch'  );
Route::get('/search/{country_name}', ['uses' => 'SearchController@airportNameSearch']);

