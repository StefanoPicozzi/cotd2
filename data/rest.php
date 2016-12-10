<!--
Author: StefanoPicozzi@gmail.com
Blog: https://StefanoPicozzi.blog
GitHub: https://github.com/StefanoPicozzi/cotd.git
Date: 2016
-->

<?php

// Populate using rest CALL

$service_url = 'http://'.getenv('SERVICE').':8080/rest_items.json';

$curl = curl_init($service_url);                                                                                                                           
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$response = curl_exec($curl); 
if ($curl_response === false) { 
    $info = curl_getinfo($curl); 
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));                                                                                                             
}
curl_close($curl);

$response = json_decode($response, true);  

$_SESSION['item'] = array();

// Find theme
$selector = $_SESSION['selector'];
$i = 0;

foreach ($response['items'] as $item) {

    $id = $item['Item']['id'];
    $name = $item['Item']['name'];
    $theme = $item['Item']['theme'];
    $caption = $item['Item']['caption'];
    $rank = $item['Item']['rank'];
    $trivia = $item['Item']['trivia'];
    $filename = $item['Item']['filename'];

    // Filter by theme
    if ( $selector == $theme ) {
        $_SESSION['item'][$i] = array(
            'name' => $name,
            'theme' => $theme,      
            'rank' => $rank,
            'caption' => $caption,
            'trivia' => $trivia, 
            'filename' => $filename,
            'prev' => $name,
            'next' => $name,
            'rating' => 0
        );
        $i = $i+1;
    }
}

?>
