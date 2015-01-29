<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 10/20/14
 * Time: 3:45 PM
 */

class DoctorController extends BaseController {

    /**
     * Show the profile for the given user.
     */


    public static function getData($q)
    {
        $q = strtoupper($q);

        $key = Config::get('fusion_tables.api_key');
        $table = Config::get('fusion_tables.table');

        $url = "https://www.googleapis.com/fusiontables/v1/query?";

        $sql = "SELECT * FROM ".$table." WHERE Name LIKE '%".$q."%'";

        $options = array("sql"=>$sql, "key"=>$key, "sensor"=>"false");

        $url .= http_build_query($options,'','&');

        $page = file_get_contents($url);

        $data = json_decode($page, TRUE);

        $rows = $data['rows'];

        $result = "";

        foreach($rows as $row){
            $cname = $row['0'];
            $result .= "$cname\n";
        }

        return $result;
    }

    public static function singleDoctor($name){

        if($name==''){
            $result = "Please enter a name!";
        }else{

            $key = Config::get('fusion_tables.api_key');
            $table = Config::get('fusion_tables.table');

            $url = "https://www.googleapis.com/fusiontables/v1/query?";

            $sql = "SELECT * FROM ".$table." WHERE Name = '".$name."'";

            $options = array("sql"=>$sql, "key"=>$key, "sensor"=>"false");

            $url .= http_build_query($options,'','&');

            $page = file_get_contents($url);

            $data = json_decode($page, TRUE);



            $rows = $data['rows'];

            $total = 0;

            $result = '';

            foreach($rows as $doc){
                $total++;
                $result .= "<p>";
                $result .= "Address: ".$doc['1'];
                $result .= "<br />";
                $result .= "Telephone: ".$doc['2'];
                $result .= "<br />";
                $result .= "Email: ".$doc['3'];
                $result .= "<br />";
                $result .= "Specialty: ".$doc['4'];
                $result .= "</p>";
            }
            if($total<1){
                $result .= "No registered doctor found with that name!";
            }
        }

        return $result;
    }

}

?>