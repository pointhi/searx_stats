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

// http://net.tutsplus.com/tutorials/php/organize-your-next-php-project-the-right-way/

$config = array(
    // Database Configuration (MYSQL)
    "db" => array(
        "dbname"    => "searx_states",
        "username"  => "searx_states",
        "password"  => "",
        "host"      => "localhost",
        "tblprefix" => "searx_"
    ),
);

// do not edit, required to search library paths!
defined("LIBRARY_PATH")
	or define("LIBRARY_PATH", realpath(dirname(__FILE__) . '/library'));

/*
	Error reporting.
*/
ini_set("error_reporting", "true");
error_reporting(E_ALL | E_STRICT);

?>
