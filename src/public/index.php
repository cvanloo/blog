<?php
	require '/var/php/config/config.php';
	require PHP_MODULES.'Session/session.php';
?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="assets/css/general.css" type="text/css">

</head>
<body>

<?php
	echo '<h1>Yeah, it works!<h1>';
	phpinfo();
?>

</body>
</html>
