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
	<h1>Create Account</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		Email: <input type="text" name="email"><br>
		Username: <input type="text" name="name"><br>
		Password: <input type="password" name="pw"><br>
		Repeat Password: <input type="password" name="pw"><br>
		<input type="submit">
		<a href="login.php">Login</a>
	</form>
</div>

</body>
</html>

<?php
	require_once PHP_ROOT.'sanitize.php';
	require_once PHP_ROOT.'database.php';


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = sanitize($_POST["email"]);
		$username = sanitize($_POST["name"]);
		$password = sanitize($_POST["pw"]);

		$db = new database\DatabaseHandler();
		$db->create_account($email, $username, $password);
	}

?>
