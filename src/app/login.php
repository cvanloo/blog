<?php 
	require '/var/settings/config.php';
	require PHP_ROOT.'session.php';
?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="css/general.css">

</head>
<body>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		Username: <input type="text" name="name"><br>
		Password: <input type="password" name="pw"><br>
		<input type="submit">
	</form>

</body>
</html>

<?php
	// TODO: Put this in an external file

	require PHP_ROOT.'sanitize.php';
	require_once PHP_ROOT.'database.php';


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = sanitize($_POST["name"]);
		$password = sanitize($_POST["pw"]);

		$db = new database\DatabaseHandler();
		//$db->create_account("new@email.com", $username, $password);

		if ($db->validate_login($username, $password)) {
			echo "Valid";
		}
		else {
			echo "Invalid";
		}
	}

?>
