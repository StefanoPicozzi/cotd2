<!--
Author: StefanoPicozzi@gmail.com
Blog: https://StefanoPicozzi.blog
GitHub: https://github.com/StefanoPicozzi/cotd.git
Date: 2016
-->

<?php

// Set up step through cycling

$count = sizeof( $_SESSION['item'] );
for ($i=0; $i < $count; $i++) {
    if ( $_SESSION['item'][$i]['rank'] == 1 ) {
        $firstitem = $_SESSION['item'][$i]['name'];
        $_SESSION['topitem'] = $firstitem;
    }
    if ( $_SESSION['item'][$i]['rank'] == $count ) {
        $lastitem = $_SESSION['item'][$i]['name'];
    }
}

for ($i=0; $i < $count; $i++) {
    $ranki = $_SESSION['item'][$i]['rank'];
    for ($j=0; $j < $count; $j++) {
        $rankj = $_SESSION['item'][$j]['rank'];
        if ( $rankj == ($ranki+1) ) {       
            $_SESSION['item'][$i]['next'] = $_SESSION['item'][$j]['name'];
        }
        if ( $rankj == ($ranki-1) ) {       
            $_SESSION['item'][$i]['prev'] = $_SESSION['item'][$j]['name'];
        }
    }
    if ( $ranki == 1 ) {       
        $_SESSION['item'][$i]['prev'] = $lastitem;
    }
    if ( $ranki == $count ) {       
        $_SESSION['item'][$i]['next'] = $firstitem;
    }   
}

?>

