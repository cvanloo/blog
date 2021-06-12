<?php
require PHP_MODULES.'Database/DatabaseHandler.php';
use Modules\Database\DatabaseHandler;

function checkAuth() : bool {
	$db = new DatabaseHandler();
	$access_right = $db->retrieve_access_right($_SESSION['userid'], 'admin');
	
	$is_admin = $access_right['ar_value'];
	return $is_admin === 'true' ? true : false;
}

define('is_admin', checkAuth());

?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<title>Admin Page: <?php echo is_admin ? 'Authorized' : 'Unauthorized'; ?></title>

</head>
<body class="bg-dark text-light">

<?php

if (is_admin) {
	include_once PHP_TEMPLATES.'Admin/admin.php';
}
else {
	include_once PHP_TEMPLATES.'Admin/goaway.php';
}

?>

	<!-- Popper and Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>
