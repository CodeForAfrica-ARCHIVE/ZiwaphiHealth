<?php

class HospitalsController extends BaseController {

    public static function getHospitals($q){
        $view_uid = "ft5b-smjr";
        $root_url = "https://data.code4sa.org/";
        $app_token = "j2sV7o19f9ZLBipzxb64KJSR9";
        $response = NULL;

        $socrata = new Socrata($root_url, $app_token);


        $latitude = -26;
        $longitude = 28;
        $range = 100000;

        $params = array("\$where" => "within_circle(location_1, $latitude, $longitude, $range)");

        $response = $socrata->get("/resource/$view_uid.json", $params);

        $total = 0;

        $result = "";

        print_r($response);

        return $result;
    }
}