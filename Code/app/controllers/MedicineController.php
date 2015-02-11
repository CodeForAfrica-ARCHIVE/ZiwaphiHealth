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

        $total = 0;

        $result = "";

        if(count($response)<1){
            $result .= "No drugs found with that name!";
        }else{

            $result .= "Found ".count($response)." results for '".$q."'";

            foreach($response as $drug){

                if(array_key_exists('proprietary_name', $drug)){

                    $total++;

                    $result .='<div>';
                    $result .= $drug['proprietary_name'] ." (". $drug['strength'].$drug['unit'].")";
                    $result .='</div>';

                }
            }

        }


        return $result;
    }
    public static function getGeneric($q){
        $view_uid = "mba4-xngh";
        $root_url = "https://data.code4sa.org/";
        $app_token = "j2sV7o19f9ZLBipzxb64KJSR9";
        $response = NULL;

        $socrata = new Socrata($root_url, $app_token);

        $params = array("\$q" => "$q");

        $response = $socrata->get("/resource/$view_uid.json", $params);

        $total = 0;

        $result = "";

        if(count($response)<1){
            $result .= "No drugs found with that name!";
        }else{



            foreach($response as $drug){

                if(array_key_exists('originator_or_generic', $drug)){
                    if($drug['originator_or_generic'] == 'Generic'){

                        $total++;

                        $result .='<div>';
                        $result .= $drug['proprietary_name'] ." (". $drug['strength'].$drug['unit'].")";
                        $result .='</div>';

                    }
                }

            }
            $result .= "Found ".$total." results for '".$q."'";
            $total = 0;

            foreach($response as $drug){

                if(array_key_exists('originator_or_generic', $drug)){
                    if($drug['originator_or_generic'] == 'Generic'){

                        $total++;

                        $result .='<div>';
                        $result .= $drug['proprietary_name'] ." (". $drug['strength'].$drug['unit'].")";
                        $result .='</div>';

                    }
                }

            }

        }


        return $result;
    }

    /*
    public static function getPrice($q)
    {
        $q = ucwords($q);

        $key = Config::get('custom_config.api_key');
        $table = Config::get('custom_config.medicine_table');

        $url = "https://www.googleapis.com/fusiontables/v1/query?";

        //Fusion Tables does not support OR WTF?
        //$sql = "SELECT * FROM ".$table." WHERE ProprietaryName LIKE '%".$q."%' OR ActiveIngredients LIKE '%".$q."%'";

        $sql = "SELECT * FROM ".$table." WHERE ProprietaryName LIKE '%".$q."%'";

        $options = array("sql"=>$sql, "key"=>$key, "sensor"=>"false");

        $url .= http_build_query($options,'','&');

        $page = file_get_contents($url);

        $data = json_decode($page, TRUE);

        $rows = array();

        if(array_key_exists('rows', $data)){
            $rows = $data['rows'];
        }

        //then do similar search for active ingredients :(

        $sql2 = "SELECT * FROM ".$table." WHERE ActiveIngredients LIKE '%".$q."%'";
        $options = array("sql"=>$sql2, "key"=>$key, "sensor"=>"false");

        $url .= http_build_query($options,'','&');


        $page = file_get_contents($url);

        $data = json_decode($page, TRUE);

        if(array_key_exists('rows', $data)){
            //check if rows already added
            foreach($data['rows'] as $row){



            }

        }


        $result = "";


        foreach($rows as $row){
            $cname = $row['4'];
            $result .= "$cname\n";
        }

        return $result;
    }
    */

}

?>