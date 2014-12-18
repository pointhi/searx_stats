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
if(!is_readable(realpath(dirname(__FILE__) . '/resources/config.inc.php')))
    die("config-file not found!");

require_once(realpath(dirname(__FILE__) . '/resources/config.inc.php'));

require_once(LIBRARY_PATH . '/system/data/DatabaseManager.class.php');
require_once(LIBRARY_PATH . '/system/data/Input.class.php');

DatabaseManager::connect();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap theme -->
    <link href="../../dist/css/bootstrap-theme.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="css/searx_stats.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <!--<span class="icon-bar"></span>-->
            <!--<span class="icon-bar"></span>-->
          </button>
          <a class="navbar-brand" href="#">searx stats</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <!--<li><a href="#instances">Instances</a></li>-->
            <!--<li><a href="#engines">Engines</a></li>-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Welcome</h1>
        <p>This is a little website, to show up-to-date informations about searx-engines and public searx Instances.</p>
        <p>searx is a privacy-respecting, hackable metasearch engine, which can everyone host by itself.</p>
        <p><a href="https://github.com/asciimoo/searx" class="btn btn-primary btn-lg" role="button">View searx on Github &raquo;</a></p>
      </div><!-- /.container -->

    <div class="row">
        <div class="col-md-7">
            <h2>public searx Instances</h2>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>url</th>
                    <th>online-status</th>
                    <th>searx-version</th>
                    <th>last update</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                    require_once(LIBRARY_PATH . '/system/SearxInstances.class.php');
                    
                    $SearxInstancesObject = new SearxInstances();
                    
                    $instances = $SearxInstancesObject->GetInstances();

                    foreach ($instances as $single_instance) {
                        echo '<tr>';

                        echo '<td>'.$single_instance['id'].'</td>';

                        // print url of engine, and add http:// if not done yet
                        if(strpos($single_instance['url'], 'http') === 0 or strpos($single_instance['url'], 'https') === 0) {
                            echo '<td><a href="'.$single_instance['url'].'">'.$single_instance['url'].'</a></td>';
                        } else {
                            echo '<td><a href="http://'.$single_instance['url'].'">'.$single_instance['url'].'</a></td>';
                        }
                        
                        // parse and show formated return-code
                        echo '<td>';
                        switch($single_instance['return_code']) {
                            case 0:
                                echo '<span class="label label-default">'.'unknow'.'</span>';
                                break;
                            case 200:
                                echo '<span class="label label-success">'.$single_instance['return_code'].' - OK'.'</span>';
                                break;
                            case 301:
                                echo '<span class="label label-warning">'.$single_instance['return_code'].' - Moved Permanently'.'</span>';
                                break;
                            case 302:
                                echo '<span class="label label-warning">'.$single_instance['return_code'].' - Found'.'</span>';
                                break;
                            case 303:
                                echo '<span class="label label-warning">'.$single_instance['return_code'].' - See Other'.'</span>';
                                break;
                            case 400:
                                echo '<span class="label label-danger">'.$single_instance['return_code'].' - Bad Request'.'</span>';
                                break;
                            case 401:
                                echo '<span class="label label-danger">'.$single_instance['return_code'].' - Unauthorized'.'</span>';
                                break;
                            case 403:
                                echo '<span class="label label-danger">'.$single_instance['return_code'].' - Forbidden'.'</span>';
                                break;
                            case 404:
                                echo '<span class="label label-danger">'.$single_instance['return_code'].' - Not Found'.'</span>';
                                break;
                            case 408:
                                echo '<span class="label label-danger">'.$single_instance['return_code'].' - Request Timeout'.'</span>';
                                break;
                            case 500:
                                echo '<span class="label label-danger">'.$single_instance['return_code'].' - Internal Server Error'.'</span>';
                                break;
                            case 501:
                                echo '<span class="label label-danger">'.$single_instance['return_code'].' - Not Implemented'.'</span>';
                                break;
                            case 502:
                                echo '<span class="label label-danger">'.$single_instance['return_code'].' - Bad Gateway'.'</span>';
                                break;
                            case 503:
                                echo '<span class="label label-danger">'.$single_instance['return_code'].' - Service Unavailable'.'</span>';
                                break;
                            case 504:
                                echo '<span class="label label-danger">'.$single_instance['return_code'].' - Gateway Timeout'.'</span>';
                                break;
                            default:
                                if($single_instance['return_code'] >= 200 && $single_instance['return_code'] < 300)
                                    echo '<span class="label label-success">'.$single_instance['return_code'].' - Success'.'</span>';
                                else if($single_instance['return_code'] >= 300 && $single_instance['return_code'] < 400)
                                    echo '<span class="label label-warning">'.$single_instance['return_code'].' - Redirection'.'</span>';
                                else if($single_instance['return_code'] >= 400 && $single_instance['return_code'] < 500)
                                    echo '<span class="label label-danger">'.$single_instance['return_code'].' - Client Error'.'</span>';
                                else if($single_instance['return_code'] >= 500 && $single_instance['return_code'] < 600)
                                    echo '<span class="label label-danger">'.$single_instance['return_code'].' - Server Error'.'</span>';
                                else
                                    echo '<span class="label label-default">'.$single_instance['return_code'].'</span>';
                                break;
                        } 
                        echo '</td>';
                        
                        // show version of instance
                        if($single_instance['searx_version'] == '') {
                            echo '<td><em class="text-muted">unknow</em></td>';
                        } else {
                            echo '<td>'.$single_instance['searx_version'].'</td>';
                        }
                        
                        // show last update-time
                        if($single_instance['last_update'] == 0) {
                            echo '<td><em class="text-muted">unknow</em></td>';
                        } else {
                            echo '<td>'.date("d.m.Y",$single_instance['last_update']).'</td>';
                        }
                        echo '</tr>';
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <h2>Engines</h2>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>name</th>
                    <th>is working</th>
                    <th>last update</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                    require_once(LIBRARY_PATH . '/system/SearxEngines.class.php');
                    
                    $SearxEnginesObject = new SearxEngines();
                    
                    $engines = $SearxEnginesObject->GetEngines();
                    
                    foreach ($engines as $single_engine) {
                        echo '<tr>';
                        
                        echo '<td>'.$single_engine['id'].'</td>';
                        echo '<td>'.$single_engine['name'].'</td>';

                        // show, if engine provide results
                        if($single_engine['is_working'] == true) {
                            echo '<td><span class="label label-success">provide results</span></td>';
                        } else {
                            // if dataset has not update-time, show label in grey
                            if($single_engine['last_update'] == 0) {
                                echo '<td><span class="label label-default">no results!</span></td>';
                            } else {
                                echo '<td><span class="label label-danger">no results!</span></td>';
                            }
                        }
                        
                        // show last update-time
                        if($single_engine['last_update'] == 0) {
                            echo '<td><em class="text-muted">unknow</em></td>';
                        } else {
                            echo '<td>'.date("d.m.Y",$single_engine['last_update']).'</td>';
                        }
                        
                        echo '</tr>';
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php

DatabaseManager::disconnect();

?>
