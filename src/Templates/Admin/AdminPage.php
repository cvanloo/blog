<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<title>Admin Page: <?php echo 'Unauthorized'; ?></title>

</head>
<body>

<?php

require PHP_MODULES.'Database/DatabaseHandler.php';
use Modules\Database\DatabaseHandler;

$db = new DatabaseHandler();
$access_right = $db->retrieve_access_right($_SESSION['userid'], 'admin');

$is_admin = $access_right['ar_value'];

if ($is_admin === 'true') {
	echo 'You are admin';

	// Admin html
	// * a search bar to search for a user account
	// * display the users access rights
	// * allow to modify the users access rights
	// * allow to (un)block a user
}
else {
	echo 'You are not an admin. Please go away :(';
}

?>

	<!-- Popper and Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>
