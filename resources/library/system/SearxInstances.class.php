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

defined('_SEARX_STATS') or die;

require_once(realpath(dirname(__FILE__) . "/../../../resources/config.inc.php"));

require_once(LIBRARY_PATH . "/system/data/DatabaseManager.class.php");

class SearxInstances {

    private $DatabaseHandler = NULL;
    private $instances = NULL;

    public function __construct() {
        $this->DatabaseHandler = new DatabaseManager();

        $this->LoadInstances();
    }
    
    public function LoadInstances() {
        $this->instances = NULL;
        
        // get all Instances from Database in a usefull order
        $this->DatabaseHandler->query('SELECT * FROM #instances WHERE `ACTIVE`=1 ORDER BY INET_ATON( SUBSTRING_INDEX( VERSION_STRING, \'/\', -1 ) ) DESC, RETURN_CODE, ID');
        
        while ($row = $this->DatabaseHandler->fetchRow()) {        
            // parse timestamp
            if($row['LAST_UPDATE'] == 0) {
                $timestamp = 0;
            } else{
                $timestamp = strtotime($row['LAST_UPDATE']);
            }

            // get single Instance
            $this->instances[] = array(
                id  => (int)$row['ID'],
                url => utf8_encode($row['URL']),
                return_code => (int)$row['RETURN_CODE'],
                searx_version => utf8_encode($row['VERSION_STRING']),
                last_update => $timestamp
            );
        }
    }
    
    public function GetInstances() {
        return $this->instances;
    }
}

?>
