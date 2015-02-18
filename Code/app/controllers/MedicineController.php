<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 10/20/14
 * Time: 3:45 PM
 */

class MedicineController extends BaseController {

    public function matchSearch($q)
    {

        $q = ucwords($q);

        $key = Config::get('custom_config.api_key');
        $table = Config::get('custom_config.medicine_table_ft');

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
            foreach($data['rows'] as $row){

                $drug_id = $row[6];
                if(!$this->in_multi_array($drug_id, $rows,6)){
                    array_push($rows, $row);
                }
            }
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

                $drug_id = $row[6];
                if(!$this->in_multi_array($drug_id, $rows,6)){
                    array_push($rows, $row);
                }
            }

        }


        $result = "";


        foreach($rows as $row){
            $cname = $row[6];
            $result .= "$cname\n";
        }

        return $result;
    }

    public function drugDetails_FT($q)
    {

        $key = Config::get('custom_config.api_key');
        $table = Config::get('custom_config.medicine_table_ft');

        $url = "https://www.googleapis.com/fusiontables/v1/query?";

        //Fusion Tables does not support OR WTF?

        $sql = "SELECT * FROM ".$table." WHERE ProprietaryName LIKE '%".$q."%'";

        $options = array("sql"=>$sql, "key"=>$key, "sensor"=>"false");

        $url .= http_build_query($options,'','&');

        $page = file_get_contents($url);

        $data = json_decode($page, TRUE);

        $rows = array();

        if(array_key_exists('rows', $data)){
            foreach($data['rows'] as $row){
                array_push($rows, $row);
            }
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

                $drug_id = $row[6];
                if(!$this->in_multi_array($drug_id, $rows,6)){
                    array_push($rows, $row);
                }
            }

        }


        $result = "";


        foreach($rows as $row){
            $cname = $row[6];
            $result .= "$cname\n";
        }

        return $result;
    }



    public function in_multi_array($elem, $array,$field)
    {
        $top = sizeof($array) - 1;
        $bottom = 0;
        while($bottom <= $top)
        {
            if($array[$bottom][$field] == $elem)
                return true;
            else
                if(is_array($array[$bottom][$field]))
                    if(in_multiarray($elem, ($array[$bottom][$field])))
                        return true;

            $bottom++;
        }
        return false;
    }

    public function getGeneric($q){

        $key = Config::get('custom_config.api_key');
        $table = Config::get('custom_config.medicine_table_ft');

        $url = "https://www.googleapis.com/fusiontables/v1/query?";

        //Fusion Tables does not support OR WTF?, hence $sql and $sql2

        $sql = "SELECT * FROM ".$table." WHERE ProprietaryName LIKE '%".$q."%' AND originator_or_generic='Generic'";

        $options = array("sql"=>$sql, "key"=>$key, "sensor"=>"false");

        $url .= http_build_query($options,'','&');

        $page = file_get_contents($url);

        $data = json_decode($page, TRUE);

        $rows = array();

        if(array_key_exists('rows', $data)){
            foreach($data['rows'] as $row){
                array_push($rows, $row);
            }
        }

        //then do similar search for active ingredients :(

        $sql2 = "SELECT * FROM ".$table." WHERE ActiveIngredients LIKE '%".$q."%' AND  originator_or_generic='Generic'";
        $options = array("sql"=>$sql2, "key"=>$key, "sensor"=>"false");

        $url .= http_build_query($options,'','&');


        $page = file_get_contents($url);

        $data = json_decode($page, TRUE);

        if(array_key_exists('rows', $data)){
            //check if rows already added
            foreach($data['rows'] as $row){

                $drug_id = $row[6];
                if(!$this->in_multi_array($drug_id, $rows,6)){
                    array_push($rows, $row);
                }

            }

        }

        $result = "";

        foreach($rows as $row){
            $cname = $row[6];
            $result .= "$cname\n";
        }

        return $result;

    }

    /*

    public function getPrice($q){
        $view_uid = Config::get('custom_config.socrata_medicine_table');
        $root_url = "https://data.code4sa.org/";
        $app_token = Config::get('custom_config.app_token');
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


    public function getGeneric($q){
        $view_uid = Config::get('custom_config.socrata_medicine_table');
        $root_url = "https://data.code4sa.org/";
        $app_token = Config::get('custom_config.app_token');
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
*/




}

?>