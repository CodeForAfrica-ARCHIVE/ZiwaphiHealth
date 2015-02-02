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
	return (new HomeController())->showWelcome();
});
Route::get('dodgydocs_embed/', function()
{
    return View::make('dodgydocs_embed');
});
Route::get('doctor', function()
{
    $term = Input::get('q');

    $name = Input::get('name');

    $result = '';

    if(isset($term)){
        $result = DoctorController::getData($term);
    }
    return $result;
});
Route::get('doctordetails', function()
{
    $name = Input::get('name');

    $result = '';

    if(isset($name)){
        $result = DoctorController::singleDoctor($name);
    }
    return $result;
});