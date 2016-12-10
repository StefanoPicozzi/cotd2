<!--
Author: StefanoPicozzi@gmail.com
Blog: https://StefanoPicozzi.blog
GitHub: https://github.com/StefanoPicozzi/cotd.git
Date: 2016
-->

<?php

$ini_file = '/etc/config/cotd.properties';                                                                                                               

// Test if OpenShift Online V2
if ( !empty(getenv('OPENSHIFT_MYSQL_DB_HOST')) ) {
    $_SESSION['DBHOST'] = getenv('OPENSHIFT_MYSQL_DB_HOST');
    $_SESSION['DBPORT'] = getenv('OPENSHIFT_MYSQL_DB_PORT');
    $_SESSION['DBUSER'] = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
    $_SESSION['DBPASSWORD'] = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
    $_SESSION['DBNAME'] = 'cotd';
    $_SESSION['V2'] = 'true';
    $_SESSION['DB'] = 'true';
} else if ( !empty(getenv('DBHOST')) ) {
    $_SESSION['V3'] = 'true';
    $_SESSION['DB'] = 'true';
}

    echo $_SESSION['V2'] = 'true';
    echo $_SESSION['DB'] = 'true';

// Determine active theme default to cats                                                                                                         
$_SESSION['selector'] = 'cats';
if ( $selector = getenv('SELECTOR') ) {                                                                                                                     
    $_SESSION['selector'] = $selector;                                                                                                                      
} elseif ( file_exists($ini_file) ) {                                                                                                                       
    $ini_array = parse_ini_file($ini_file);                                                                                                                 
    $_SESSION['selector'] = $ini_array['selector'];                                                                                                         
} elseif ( $_SESSION['V2'] == 'true' )  {
    $_SESSION['selector'] = 'pets'; 
}                                        

// Populate theme using local file or remote REST Service or DB
if ( $service = getenv('SERVICE') ) {                                                                                                                     
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
