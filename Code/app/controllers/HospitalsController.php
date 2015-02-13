<?php

class HospitalsController extends BaseController {

    public function getHospitals($q){
        $view_uid = Config::get('custom_config.hospitals_table');
        $root_url = "https://data.code4sa.org/";
        $app_token = Config::get('custom_config.app_token');
        $response = NULL;

        $socrata = new Socrata($root_url, $app_token);

        if($this->reverseGeocode($q) != null){

            $location = $this->reverseGeocode($q);
            $latitude = $location->lat;
            $longitude = $location->lng;

        }else{
            return "Location not found! Try different address/name.";
        }

        $range = 100000;

        $params = array("\$where" => "within_circle(location_1, $latitude, $longitude, $range)");

        $response = $socrata->get("/resource/$view_uid.json", $params);

        $total = 0;

        $result = "";

        print_r($response);

        return $result;
    }

    public function reverseGeocode($q){
        $geocode_url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$q."&key=".Config::get('custom_config.google_api_key');

        $response = json_decode(file_get_contents($geocode_url));

        if($response->status =="OK"){
            return $response->results[0]->geometry->location;

        }else{
            return null;
        }

    }

}