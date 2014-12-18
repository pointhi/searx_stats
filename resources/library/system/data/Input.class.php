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

class Input {

    private function __construct() {}
    
    public static function get($get_parameter)
        {
        if(isset($_GET[$get_parameter]))
            {
            $GetQuerry = mysql_real_escape_string($_GET[$get_parameter]);
            return htmlentities($GetQuerry);
            }
        else
            {
            return NULL;
            }
        }
        
    public static function getInt($get_parameter)
        {
        if(is_numeric(Input::get($get_parameter)))
            {
            return Input::get($get_parameter);
            }
        else
            {
            return NULL;
            }
        }
    
    public static function post($post_paramter)
        {
        if(isset($_POST[$post_paramter]))
            {
            $PostQuerry = mysql_real_escape_string($_POST[$post_paramter]);
            return htmlentities($PostQuerry);
            }
        else
            {
            return NULL;
            }   
        }
        
    }

?>
