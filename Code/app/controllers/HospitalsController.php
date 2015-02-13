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

        $range = 10000;

        $params = array("\$where" => "within_circle(location_1, $latitude, $longitude, $range)");

        $response = $socrata->get("/resource/$view_uid.json", $params);

        $total = 0;

        $result = "";

        $hospitals = array();

        foreach($response as $r){

            $lat1 = $r['location_1']['latitude'];
            $lon1 = $r['location_1']['longitude'];

            if(!array_key_exists('classification', $r)){
                $r['classification'] = "General";
            }
            if(!array_key_exists('overall_performance', $r)){
                $r['overall_performance'] = "0";
            }

            $hospitals[] = array(
                "name"=>$r['name'],
                "distance"=>round($this->distance($lat1, $lon1, $latitude, $longitude), 2),
                "type"=>$r['classification'],
                "rating"=>$r['overall_performance']
            );
        }

        //sort results according to proximty
        $prox = array();

        foreach ($hospitals as $key => $row)
        {
            $prox[$key] = $row['distance'];
        }

        array_multisort($prox, SORT_ASC, $hospitals);


        //format result and return nearest 10
        $i = 0;

        foreach($hospitals as $h){

            if($i<15){

                $rating = round($h['rating']/20, 0);

                $result .= "<div>";
                $result .= $h['name']." (";
                $result .= $h['type'].")";
                $result .= "<span style='float:right;'>";

                for($j=0; $j<5; $j++){
                    if($rating>$j){
                        $result .= "<i class='fa fa-star'></i>";
                    }else{
                        $result .= "<i class='fa fa-star-o'></i>";
                    }
                }

                $result .= "</span>";
                $result .= "<br />";
                $result .= $h['distance']. " Km away";
                $result .= "</div>";

            }

            $i++;
        }


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

    public function geocode($q){
        $geocode_url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$q."&key=".Config::get("custom_config.google_api_key");

        $response = json_decode(file_get_contents($geocode_url));

        if($response->status =="OK"){
            return $response->results[0]->formatted_address;
        }else{
            return null;
        }

    }

    public function distance($lat1, $lon1, $lat2, $lon2) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);

        $miles = $dist * 60 * 1.1515;

        return ($miles * 1.609344);

    }


}