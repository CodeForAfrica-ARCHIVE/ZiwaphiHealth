<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 10/20/14
 * Time: 3:45 PM
 */

class MedicineController extends BaseController {

    public static function getPrice($q){
        $view_uid = "mba4-xngh";
        $root_url = "https://data.code4sa.org/";
        $app_token = "j2sV7o19f9ZLBipzxb64KJSR9";
        $response = NULL;

        $socrata = new Socrata($root_url, $app_token);

        $params = array("\$q" => "$q");

        $response = $socrata->get("/resource/$view_uid.json", $params);

        $result = "";

        foreach($response as $row){
            $cname = $row['active_ingredients'];
            $result .= "$cname\n";
        }

        return $result;
    }

}

?>