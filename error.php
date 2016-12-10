<!--
Author: StefanoPicozzi@gmail.com
Blog: https://StefanoPicozzi.blog
GitHub: https://github.com/StefanoPicozzi/cotd.git
Date: 2016
-->

<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>COTD</title>
	<!-- <link rel="stylesheet"  href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css"> -->
	<link rel="stylesheet"  href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<link rel="stylesheet" href="css/jqm-demos.css">
	<link rel="stylesheet" href="css/swipe-page.css">
	<link rel="shortcut icon" href="css/favicon.ico">
	<script src="js/jquery.js"></script>
	<script src="js/index.js"></script>
	<!-- <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script> -->
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="js/swipe-page.js"></script>
	<script src="js/rateThis.js"></script>

<script>
$.ajaxSetup ({
// Disable caching of AJAX responses
cache: false
});
</script>

</head>
<body>

Oops.
<?php echo $_SESSION['message']; ?>

</body>

</html>