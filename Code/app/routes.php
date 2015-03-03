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

Route::get('/blog/wp-admin', function(){

    return Redirect::to("http://ziwaphihealth.codeforafrica.net/wp-admin");

});

Route::get('/match_drugs', function(){

    $q = Input::get('q');

    return (new MedicineController())->matchSearch_Socrata($q);
});

Route::get('/', function()
{
	return (new HomeController())->showWelcome();
});

Route::get('single_story', function()
{
    $q = Input::get('q');

    return (new HomeController())->singleStory($q);
});

Route::get('/filterFeed', function()
{
    return (new HomeController())->filterFeed();
});



Route::get('embed_widget', function()
{
    $widget = Input::get('q');

    return View::make('widget_view', array("widget"=>$widget));
});

Route::get('dodgydocs_embed/', function()
{
    $widget = 1;

    return View::make('widget_view', array("widget"=>$widget));
});

Route::get('doctor', function()
{
    $term = Input::get('q');

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

Route::get('medicine_price', function()
{
    $name = Input::get('q');

    $result = '';

    if(isset($name)){
        $result = (new MedicineController())->drugDetails_FT($name);
    }
    return $result;
});

Route::get('medicine_generics', function()
{
    $name = Input::get('q');

    $result = '';

    if(isset($name)){
        $result = (new MedicineController())->getGeneric($name);
    }
    return $result;
});
Route::get('find_hospitals', function()
{
    $name = Input::get('q');

    $result = '';

    if(isset($name)){
        $result = (new HospitalsController())->getHospitals($name);
    }
    return $result;
});
Route::get('reverse_geocode', function()
{
    $name = Input::get('q');

    $result = '';

    if(isset($name)){
        $result = (new HospitalsController())->geocode($name);
    }
    return $result;
});
Route::get('drugSuggestions', function()
{
    $name = Input::get('q');

    $result = '';

    if(isset($name)){
        $result = (new MedicineController())->matchSearch($name);
    }
    return $result;
});