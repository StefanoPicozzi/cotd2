<!--
Author: StefanoPicozzi@gmail.com
Blog: https://StefanoPicozzi.blog
GitHub: https://github.com/StefanoPicozzi/cotd.git
Date: 2016
-->

<?php

$ini_file = '/etc/config/cotd.properties';                                                                                                               

$dbv2 = getenv('OPENSHIFT_MYSQL_DB_HOST');
$dbv3 = getenv('DBHOST');

// Test if DB is OpenShift Online V2 or V3 Trial
if ( !empty($dbv2) ) {
    $_SESSION['DBHOST'] = getenv('OPENSHIFT_MYSQL_DB_HOST');
    $_SESSION['DBPORT'] = getenv('OPENSHIFT_MYSQL_DB_PORT');
    $_SESSION['DBUSER'] = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
    $_SESSION['DBPASSWORD'] = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
    $_SESSION['DBNAME'] = 'cotd';
    $_SESSION['V2'] = 'true';
    $_SESSION['DB'] = 'true';
} else if ( !empty($dbv3) ) {
    $_SESSION['DBHOST'] = getenv('DBHOST');
    $_SESSION['DBPORT'] = getenv('DBPORT');
    $_SESSION['DBUSER'] = getenv('DBUSER');
    $_SESSION['DBPASSWORD'] = getenv('DBPASSWORD');
    $_SESSION['DBNAME'] = getenv('DBNAME');
    $_SESSION['V3'] = 'true';
    $_SESSION['DB'] = 'true';
}

// Determine active theme default to cats                                                                                                         
$_SESSION['selector'] = 'cats';
$selector = getenv('SELECTOR');

if ( !empty($selector) ) {                                                                                                                     
    $_SESSION['selector'] = $selector;                                                                                                                      
} elseif ( file_exists($ini_file) ) {                                                                                                                       
    $ini_array = parse_ini_file($ini_file);                                                                                                                 
    $_SESSION['selector'] = $ini_array['selector'];                                                                                                         
} elseif ( $_SESSION['V2'] == 'true' )  {
    $_SESSION['selector'] = 'pets'; 
}                                        

$service = getenv('SERVICE');
// Populate theme using local file or remote REST Service or DB
if ( !empty($service) ) {                                                                                                                     
    include('data/rest.php');
} elseif ( $_SESSION['DB'] == 'true' ) {
    include('data/db.php');
} else {
    include('data/'.$_SESSION['selector'].'.php');
}

// Set up page next and prev
include('prevnext.php');

// Change App name tag here
$_SESSION['app'] = 'COTD';

?>
