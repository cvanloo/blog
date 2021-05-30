<?php 
	require 'config.php';
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

	require PHP_ROOT.'sanitize.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = sanitize($_POST["name"]);
		$password = sanitize($_POST["pw"]);

		echo "Username: $username";
		echo "Password: $password";
	}

?>
