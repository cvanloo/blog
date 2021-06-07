<?php
	require '/var/php/config/config.php';
	require PHP_MODULES.'Session/session.php';
?>

<!--<!DOCTYPE html>
<html>
<head>

	<!--link rel="stylesheet" href="assets/css/general.css" type="text/css"--><!--

</head>
<body>-->

<?php
	//echo '<h1>Yeah, it works!<h1>';
	
	//echo $_SERVER['REQUEST_URI'];

	$uri =  $_SERVER['REQUEST_URI'];

	switch ($uri) {
	case '/':
		phpinfo();
		break;
	case '/login':
		include_once PHP_TEMPLATES.'Auth/LoginPage.php';
		break;
	case '/register':
		include_once PHP_TEMPLATES.'Auth/RegisterPage.php';
		break;
	case '/blog':
		include_once PHP_TEMPLATES.'Blog/HomePage.php';
		break;
	case '/logout':
		include_once PHP_TEMPLATES.'Auth/LogoutPage.php';
		break;
	case '/upload':
		include_once PHP_TEMPLATES.'Blog/UploadPage.php';
		break;
	default:
		echo "<p>Not found<p>";
	}

?>

<!--</body>
</html>-->
