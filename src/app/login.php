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

<div id="form">
	<h1>Login</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		Username: <input type="text" name="name"><br>
		Password: <input type="password" name="pw"><br>
		<input type="submit">
		<a href="create_account.php">Create Account</a>
	</form>
</div>

</body>
</html>

<?php
	require_once PHP_ROOT.'sanitize.php';
	require_once PHP_ROOT.'database.php';


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = sanitize($_POST["name"]);
		$password = sanitize($_POST["pw"]);
		$db = new database\DatabaseHandler();

		$result = $db->validate_login($username, $password);

		if (true === $result->success) {
			$_SESSION["loggedin"] = $result->message;
			echo "Valid $result->message";
		}
		else {
			echo "Invalid";
		}
	}

?>
