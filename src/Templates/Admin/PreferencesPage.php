<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<title>User Preferences: <?php echo $_SESSION['accname'] ?></title>

</head>
<body class="bg-dark text-light">

	<?php include_once PHP_TEMPLATES.'Blog/NavbarComponent.php'; ?>

<div class="container d-grid gap-5" style="margin-top: 60px;">
	<?php

	require PHP_MODULES.'Database/DatabaseHandler.php';
	use Modules\Database\DatabaseHandler;

	$db = new DatabaseHandler();

	$user = $db->retrieve_user_by_id($_SESSION['userid']);

	echo '<p>Account Name: ' . $user['account_name'] . '</p>';
	echo '<p>Display Name: ' . $user['display_name'] . '</p>';
	echo '<p>Email Address: ' . $user['email'] . '</p>';
	// Password

	?>
</div>

</body>
</html>
