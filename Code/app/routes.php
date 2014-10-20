<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});
Route::get('doctor/{q}', 'DoctorController@getData');
Route::get('user/{q}', 'UserController@getData');
Route::get('doctor', function()
{
    $term = Input::get('q');

    $result = '';
    if(isset($term)){
        $result = DoctorController::getData($term);

    }
    return $result;
});
