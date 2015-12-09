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

class SearxEngines {

    private $DatabaseHandler = NULL;
    private $engines = NULL;

    public function __construct() {
        $this->DatabaseHandler = new DatabaseManager();

        $this->LoadEngines();
    }
    
    public function LoadEngines() {
        $this->engines = NULL;
        
        // get all Engines from Database
        $this->DatabaseHandler->query('SELECT * FROM #engines WHERE `ACTIVE`=1 ORDER BY NAME');
        
        while ($row = $this->DatabaseHandler->fetchRow()) {
            // parse timestamp
            if($row['LAST_UPDATE'] == 0) {
                $timestamp = 0;
            } else{
                $timestamp = strtotime($row['LAST_UPDATE']);
            }
            
            // get single Engine
            $this->engines[] = array(
                id  => (int)$row['ID'],
                name => utf8_encode($row['NAME']),
                is_working => (bool)$row['IS_WORKING'],
                last_update => $timestamp
            );
        }
    }
    
    public function GetEngines() {
        return $this->engines;
    }
}

?>
