<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

// List all league table
Route::get('leagueTable', 'FootballMatchController@index');

// Filter league table

Route::get('leagueTable/{group}', 'FootballMatchController@show');

// Create new match/es

Route::post('footballMatch', 'FootballMatchController@store');


// List all match/es
Route::get('footballMatches', 'MatchResultController@index');
