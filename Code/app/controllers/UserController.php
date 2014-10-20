<?php

    class UserController extends BaseController {

    /**
    * Show the profile for the given user.
    */
    public function getData($q)
    {
        $key = "AIzaSyCAI2GoGWfLBvgygLKQp5suUk3RCG7r_ME";
        $table = "1sHohYSC7eaJQ3wenE6-4zrhIYc45lLX_Fb04Hzjo";

        $url = "https://www.googleapis.com/fusiontables/v1/query?";

        $sql = "SELECT * FROM ".$table." WHERE Names LIKE '%".$q."%'";

        $options = array("sql"=>$sql, "key"=>$key, "sensor"=>"false");

        $url .= http_build_query($options,'','&');

        $page = file_get_contents($url);

        $data = json_decode($page, TRUE);
        print_r($data);
        $rows = $data['rows'];

        $result = "";

        foreach($rows as $row){
            $cname = $row['2'];
            $result .= "$cname\n";
        }

        return $result;
    }

}

?>