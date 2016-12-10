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
        INSERT INTO ratings (sessionid, theme, name, rating)
	  	VALUES (:sessionid, :theme, :name, :rating); 
	;");

    $sessionid = session_id();
    $theme = $_SESSION['selector'];
    $name = $_SESSION['name'];
    $rating = $_SESSION['rating'];

	$stmt -> bindParam(':sessionid', $sessionid, PDO::PARAM_STR, 40);
	$stmt -> bindParam(':theme', $theme, PDO::PARAM_STR, 40);
	$stmt -> bindParam(':name', $name, PDO::PARAM_STR, 40);
	$stmt -> bindParam(':rating', $rating, PDO::PARAM_STR, 40);
	$stmt -> execute();
	$count = $stmt -> rowCount();

} catch(Exception $e) {
   $_SESSION['message'] = 'We are unable to save your rating. Please try again later. '.$e;
   header("Location: error.php");
}
?>
