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
        //match search to provide only name suggesstions before full search
        $final_result = array();

        $key = Config::get('custom_config.google_api_key');
        $table = Config::get('custom_config.medicine_table_ft');

        $base_url = "https://www.googleapis.com/fusiontables/v1/query?";

        //Fusion Tables does not support OR WTF?
        //$sql = "SELECT * FROM ".$table." WHERE ProprietaryName CONTAINS IGNORING CASE '".$q."' OR ActiveIngredients CONTAINS IGNORING CASE '".$q."'";

        $sql = "SELECT * FROM ".$table." WHERE ProprietaryName CONTAINS IGNORING CASE '".$q."'";

        $options = array("sql"=>$sql, "key"=>$key, "sensor"=>"false");

        $url = $base_url . http_build_query($options,'','&');

        $page = file_get_contents($url);

        $data = json_decode($page, TRUE);

        $rows = array();

        if(array_key_exists('rows', $data)){
            foreach($data['rows'] as $row){

                if(!in_array(strtolower($row[7]), $final_result)){
                    $final_result[] = strtolower($row[7]);
                }

            }
        }

        //then do similar search for active ingredients :(

        $sql2 = "SELECT * FROM ".$table." WHERE ActiveIngredients CONTAINS IGNORING CASE '".$q."'";
        $options = array("sql"=>$sql2, "key"=>$key, "sensor"=>"false");

        $url = $base_url . http_build_query($options,'','&');


        $page = file_get_contents($url);

        $data = json_decode($page, TRUE);

        if(array_key_exists('rows', $data)){
            //check if rows already added
            foreach($data['rows'] as $row){

                if(!in_array(strtolower($row[7]), $final_result)){
                    $final_result[] = strtolower($row[7]);
                }
            }

        }

        return implode("\n", $final_result);
    }

    public function drugDetails_FT($q)
    {

        $key = Config::get('custom_config.google_api_key');
        $table = Config::get('custom_config.medicine_table_ft');

        $base_url = "https://www.googleapis.com/fusiontables/v1/query?";

        //Fusion Tables does not support OR WTF?

        $sql = "SELECT * FROM ".$table." WHERE ProprietaryName CONTAINS IGNORING CASE '".$q."'";

        $options = array("sql"=>$sql, "key"=>$key, "sensor"=>"false");

        $url = $base_url . http_build_query($options,'','&');

        $page = file_get_contents($url);

        $data = json_decode($page, TRUE);

        $rows = array();

        if(array_key_exists('rows', $data)){
            foreach($data['rows'] as $row){
                array_push($rows, $row);
            }
        }

        //then do similar search for active ingredients :(

        $sql2 = "SELECT * FROM ".$table." WHERE ActiveIngredients CONTAINS IGNORING CASE '".$q."'";
        $options = array("sql"=>$sql2, "key"=>$key, "sensor"=>"false");

        $url = $base_url . http_build_query($options,'','&');


        $page = file_get_contents($url);

        $data = json_decode($page, TRUE);

        if(array_key_exists('rows', $data)){
            //check if rows already added
            foreach($data['rows'] as $row){

                $drug_id = $row[0];
                if(!$this->in_multi_array($drug_id, $rows,0)){
                    array_push($rows, $row);
                }
            }

        }

        $result = "";

        function compareSEP($a, $b)
        {
            return (new MedicineController())->getDrugPrice($a[17]) - (new MedicineController())->getDrugPrice($b[17]);
        }

        usort($rows, 'compareSEP');

        if(count($rows)<1){
            $result .= "No results found for search term. Try a different result <br />";
        }else{
            $result .= "Found ".count($rows)." results for '".$q."' <br />";
        }

        foreach($rows as $row){

            $result .= $this->format_drug_row($row);

        }


        return $result;
    }

    public function format_drug_row($row){
        $result = "<div class='drug_row'>";

        $cname = $row[7];

        if($cname==''){
            $cname = $row[8];
        }

        $cname = "$cname ($row[9] / $row[10])";

        $type = $row[11];

        $result .= "<img src='img/".$this->drug_symbol($type)."'>";

        $result .= $cname;

        $result .= "<span class='drug_price'>R". round($this->getDrugPrice($row[17]), 1)."</span>";

        $result .= "</div>";

        return $result;
    }

    public function drug_symbol($type){


        switch($type){
            case "TAB":
                $img =  "pill.png";
                break;
            case "SYR":
                $img =  "syrup.png";
                break;
            case "INJ":
                $img =  "syringe.png";
                break;
            case "SOL":
                $img =  "bottle.png";
                break;
            case "INH":
                $img =  "inhaler.png";
                break;
            case "SPO":
                $img =  "inhaler.png";
                break;
            default:
                $img = "capsule.png";
                break;
        }

        return $img;

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

        $key = Config::get('custom_config.google_api_key');
        $table = Config::get('custom_config.medicine_table_ft');

        $base_url = "https://www.googleapis.com/fusiontables/v1/query?";

        //Fusion Tables does not support OR WTF?, hence $sql and $sql2

        $sql = "SELECT * FROM ".$table." WHERE ProprietaryName CONTAINS IGNORING CASE '".$q."' AND originator_or_generic='Generic'";

        $options = array("sql"=>$sql, "key"=>$key, "sensor"=>"false");

        $url = $base_url . http_build_query($options,'','&');

        $page = file_get_contents($url);

        $data = json_decode($page, TRUE);

        $rows = array();

        if(array_key_exists('rows', $data)){
            foreach($data['rows'] as $row){
                array_push($rows, $row);
            }
        }

        //then do similar search for active ingredients :(

        $sql2 = "SELECT * FROM ".$table." WHERE ActiveIngredients CONTAINS IGNORING CASE '".$q."' AND  originator_or_generic='Generic'";
        $options = array("sql"=>$sql2, "key"=>$key, "sensor"=>"false");

        $url = $base_url . http_build_query($options,'','&');


        $page = file_get_contents($url);

        $data = json_decode($page, TRUE);

        if(array_key_exists('rows', $data)){
            //check if rows already added
            foreach($data['rows'] as $row){

                $drug_id = $row[0];
                if(!$this->in_multi_array($drug_id, $rows,0)){
                    array_push($rows, $row);
                }

            }

        }

        $result = "";

        function compareSEP($a, $b)
        {

            return (new MedicineController())->getDrugPrice($a[17]) - (new MedicineController())->getDrugPrice($b[17]);
        }

        usort($rows, 'compareSEP');

        if(count($rows)<1){
            $result .= "No results found for search term. Try a different result <br />";
        }else{
            $result .= "Found ".count($rows)." results for '".$q."' <br />";
        }

        foreach($rows as $row){
            $result .= $this->format_drug_row($row);
        }

        return $result;

    }

    public function getDrugPrice($sep){

        $vat = 1.14;

        if ($sep < 85.70){
            return $sep + ($sep * 0.46 + 6.95) * $vat;
        }elseif($sep < 228.53){
            return $sep + ($sep * 0.33 + 18.55) * $vat;
        }elseif($sep < 799.85){
            return $sep + ($sep * 0.15 + 59) * $vat;
        }else{
            return $sep + ($sep * 0.05 + 140) * $vat;
        }


    }

    public function matchSearch_Socrata($q){
        $view_uid = Config::get('custom_config.medicine_table');
        $root_url = "https://data.code4sa.org/";
        $app_token = Config::get('custom_config.app_token');
        $response = NULL;

        $socrata = new Socrata($root_url, $app_token);

        $params = array("\$q" => "$q");

        $response = $socrata->get("/resource/$view_uid.json", $params);

        $result = "";

        if(count($response)<1){
            $result .= "No drugs found with that name!";
        }else{


            $result .= "Found ".count($response)." results for '".$q."'";

            foreach($response as $drug){

                        $result .='<div>';
                        $result .= $drug['proprietary_name'] ." (". $drug['strength'].$drug['unit'].")";
                        $result .='</div>';

            }

        }

        print $result;
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