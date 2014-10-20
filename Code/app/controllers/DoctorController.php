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
        $key = "AIzaSyCAI2GoGWfLBvgygLKQp5suUk3RCG7r_ME";
        $table = "1qJ0yblV9aQWps3IICJdh6OSlWLGzXXgdi81RoVdh";

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

}

?>