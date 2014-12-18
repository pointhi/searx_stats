<?php

/*
 * searx-stats is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * searx-stats is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with searx-stats. If not, see < http://www.gnu.org/licenses/ >.
 *
 * (C) 2014- by Thomas Pointhuber
 */

define('_SEARX_STATS', 1);

// check if config-file is available
if(!is_readable(realpath(dirname(__FILE__) . '/../resources/config.inc.php')))
    die("config-file not found!");

require_once(realpath(dirname(__FILE__) . '/../resources/config.inc.php'));

require_once(LIBRARY_PATH . '/system/data/DatabaseManager.class.php');
require_once(LIBRARY_PATH . '/system/data/Input.class.php');

DatabaseManager::connect();

$DatabaseHandler = new DatabaseManager();

//###### Instances CronJob

if((bool)$config["instances"]["cronjob"] == True) {
    require_once(LIBRARY_PATH . '/system/SearxInstances.class.php');

    $SearxInstancesObject = new SearxInstances();

    $instances = $SearxInstancesObject->GetInstances();

    echo "<h1>Check searx-Instances</h1>";

    foreach ($instances as $single_instance) {
        echo $single_instance['id'].' - '.$single_instance['url'];
        
        $crl = curl_init();
        $timeout = (int)$config["instances"]["timeout"];
        curl_setopt ($crl, CURLOPT_URL,$single_instance['url']);
        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt ($crl, CURLOPT_SSL_VERIFYPEER, false);

        $res_http = curl_exec($crl);
        $res_total_time = (float)curl_getinfo($crl, CURLINFO_TOTAL_TIME );
        $res_http_code = (int)curl_getinfo($crl, CURLINFO_HTTP_CODE );
        // Rewrite to HTTP-CODE: 408 if timeout occour
        if($res_http_code === 0 && $res_total_time >= $timeout) {
            $res_http_code = 408;
            }
        
        curl_close($crl);
        
        $res_timestamp = time();
        $res_searx_version = NULL;
        
        // correct HTTP-CODE
        if($res_http_code >= 200 && $res_http_code < 300 and $res_http != NULL) {
        
            //Create a new DOM document
            $dom = new DOMDocument;

            //Parse the HTML. The @ is used to suppress any parsing errors
            //that will be thrown if the $html string isn't valid XHTML.
            @$dom->loadHTML($res_http);

            //Get all links. You could also use any other tag name here,
            //like 'img' or 'table', to extract other tags.
            $links = $dom->getElementsByTagName('meta');//<meta http-equiv="X-UA-Compatible" content="IE=edge">

            //Query the DOM
            //$links = $xpath->query( '//meta' );

            //Display the results as in the previous example
            foreach($links as $link){
                if($link->getAttribute('name') == 'generator')
                    $res_searx_version = $link->getAttribute('content');
            }
        }
        
        // save in database
        $query = "UPDATE `#instances` SET ".
            "`VERSION_STRING` = '".$res_searx_version."', ".
            "`RETURN_CODE` = '".$res_http_code."', ".
            "`LAST_UPDATE` = '".date('Y-m-d H:i:s',$res_timestamp)."' ".
            "WHERE `searx_instances`.`ID` =".$single_instance['id'].";";
        $DatabaseHandler->query($query);

        // print result
        if($res_http_code >= 200 && $res_http_code < 300)
            echo ' - HTTP-CODE: '.$res_http_code;
        else
            echo ' - <b>HTTP-CODE: '.$res_http_code.'</b>';
        echo ' - TIME: '.$res_total_time;
        echo ' - TIMESTAMP: '.$res_timestamp;
        echo ' - VERSION: '.$res_searx_version;
        echo '<br/>';
    }
}
//###### Engines CronJob

if((bool)$config["engines"]["cronjob"] == True) {
    require_once(LIBRARY_PATH . '/system/SearxEngines.class.php');

    $SearxEnginesObject = new SearxEngines();

    $engines = $SearxEnginesObject->GetEngines();

    echo "<h1>Check searx-Engines</h1>";
}
?>
