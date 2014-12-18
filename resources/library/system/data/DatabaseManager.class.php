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

require_once(realpath(dirname(__FILE__) . "/../../../../resources/config.inc.php"));

class DatabaseManager {
   
    private static $connection  = NULL;
    private $result  = NULL;
    private $counter = NULL;
    
    public function __construct() {
        
        if(!is_resource(DatabaseManager::$connection))
            {
            DatabaseManager::connect();
            }
        }
    
    public static function connect()
        {
        if(!is_resource(DatabaseManager::$connection))
            {
            global $config;
            
            DatabaseManager::$connection = mysql_connect($config["db"]["host"],$config["db"]["username"],$config["db"]["password"]);    //,TRUE
            if(DatabaseManager::$connection)
                {
                mysql_select_db($config["db"]["dbname"], DatabaseManager::$connection) or die ("Could not set Database Name");
                }
            else
                {
                echo "Could not Connect to MySQL Database";
                die;
                }
            }
        }
 
    public static function disconnect() 
        {
        if (is_resource(DatabaseManager::$connection))
            {
            mysql_close(DatabaseManager::$connection);
            DatabaseManager::$connection = NULL;
            }
        }
 
    public function query($query)
        {
        global $config;
        
        // required to have a replacable prefix
        $mysql_querry = str_replace('#',$config["db"]["tblprefix"],$query);    
 
        $this->result=mysql_query($mysql_querry,DatabaseManager::$connection);
        $this->counter = NULL;
        }
        
    public function errorcheck()
        {
            return $this->result;
        }
 
    public function fetchRow()
        {
        return mysql_fetch_assoc($this->result);
        }
 
    public function count()
        {
        if($this->counter == NULL && is_resource($this->result))
            {
            $this->counter=mysql_num_rows($this->result);
            }
	return $this->counter;
        }
    
/*
 *  SQL-Injection save string-escaping
 */
        
    public static function correctString($String)
        {
        $CorrectedString = mysql_real_escape_string($String);
        return htmlentities($CorrectedString);
        }
        
    }

?>
