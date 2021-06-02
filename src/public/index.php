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
		include_once PHP_TEMPLATES.'Auth/login.php';
		break;
	case '/register':
		include_once PHP_TEMPLATES.'Auth/create_account.php';
		break;
	case '/blog':
		include_once PHP_TEMPLATES.'Blog/blog.php';
		break;
	default:
		echo "<p>Not found<p>";
	}

?>

<!--</body>
</html>-->
