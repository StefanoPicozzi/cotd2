<!--
Author: StefanoPicozzi@gmail.com
Blog: https://StefanoPicozzi.blog
GitHub: https://github.com/StefanoPicozzi/cotd.git
Date: 2016
-->

<?php

// Populate using direct DB access

if ( empty($_SESSION['DBHOST']) ) { return; }

$mysql_hostname = $_SESSION['DBHOST'];
$mysql_port     = $_SESSION['DBPORT'];
$mysql_username = $_SESSION['DBUSER'];
$mysql_dbname   = $_SESSION['DBNAME'];
$mysql_password = $_SESSION['DBPASSWORD'];

try {
    $dbh = new PDO("mysql:host=$mysql_hostname;port=$mysql_port;dbname=$mysql_dbname", $mysql_username, $mysql_password);
    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $dbh -> prepare("
        SELECT
            name AS :name,
            rank AS :rank,
            caption AS :caption,
            trivia AS :trivia, 
            filename AS :filename
        FROM 
            items
        WHERE theme =:theme
        ORDER by id ASC
    ");

    $name = '';
    $rank = 0;
    $caption = '';
    $trivia = '';
    $filename = '';
    $theme = $_SESSION['selector'];

    $stmt -> bindParam(':theme', $theme, PDO::PARAM_STR);
    $stmt -> bindParam(':name', $name, PDO::PARAM_STR);
    $stmt -> bindParam(':rank', $rank, PDO::PARAM_STR);
    $stmt -> bindParam(':caption', $caption, PDO::PARAM_STR);
    $stmt -> bindParam(':trivia', $trivia, PDO::PARAM_STR);
    $stmt -> bindParam(':filename', $filename, PDO::PARAM_STR);

    $_SESSION['item'] = array();
    $i = 0;
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {

        $name = $row[0];
        $rank = $row[1];
        $caption = $row[2];
        $trivia = $row[3];
        $filename = $row[4];

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
        $i = $i + 1;

    }
  
} catch(Exception $e) {
   $_SESSION['message'] = "Failed to read items. ".$e;
   header("Location: error.php");
}

?>
