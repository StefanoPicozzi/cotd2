<!--
Author: StefanoPicozzi@gmail.com
Blog: https://StefanoPicozzi.blog
GitHub: https://github.com/StefanoPicozzi/cotd.git
Date: 2016
-->

<?php

$ini_file = '/etc/config/cotd.properties';                                                                                                               

// Test if OpenShift Online V2
$db = getenv('OPENSHIFT_MYSQL_DB_HOST');
                                                                                                                                                            
// Determine active theme default to cats                                                                                                         
if ( $selector = getenv('SELECTOR') ) {                                                                                                                     
    $_SESSION['selector'] = $selector;                                                                                                                      
} elseif ( file_exists($ini_file) ) {                                                                                                                       
    $ini_array = parse_ini_file($ini_file);                                                                                                                 
    $_SESSION['selector'] = $ini_array['selector'];                                                                                                         
} elseif ( ! empty($db) ) {
    $_SESSION['selector'] = 'pets'; 
} else {                                                                                                                                                    
    $_SESSION['selector'] = 'cats';                                                                                                                         
}                                        

// Populate theme using local file or remote REST Service or DB
if ( $service = getenv('SERVICE') ) {                                                                                                                     
    include('data/rest.php');
} elseif ( ! empty($db) ) {
    include('data/db.php');
} else {
    include('data/'.$_SESSION['selector'].'.php');
}

// Set up page next and prev
include('prevnext.php');

// Change App name tag here
$_SESSION['app'] = 'COTD';

?>
