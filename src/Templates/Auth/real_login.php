<?php

require '/var/settings/config.php';
require PHP_ROOT.'session.php';

?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="css/general.css">
	<script>
		function showForm(show_div) {
			document.getElementById('form').innerHTML = document.getElementById(
				show_div).innerHTML;
		}
	</script>

	<style>
		a {
			color: #2595db;
			text-decoration: underline;
			cursor: pointer;
		}

			a:hover{
				color: #0ee3f2;
			}
	</style>

</head>
<body>

<div id="form">

</div>

<div id="login" style="display:none">
	<h1>Login</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		Username/Email: <input type="text" placeholder="max@email.com" name="identifier"/><br/>
		Password: <input type="password" placeholder="*********" name="password"/><br/>
		<a onclick="showForm('create')">Create Account</a>
		<input type="submit" value="Log in"/> 
	</form
</div>

<div id="create" style="display:none">
	<h1>Create Account</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		Email: <input type="text" placeholder="max@email.com" name="email"/><br/>
		Username: <input type="text" placeholder="max" name="username"/><br/>
		Password: <input type="password" placeholder="*********" name="password"/><br/>
		Repeat: <input type="password" placeholder="*********" name="rep_password"/><br/>
		<a onclick="showForm('login')">Login</a>
		<input type="submit" value="Create Account"/> 
	</form
</div>

<script>
	showForm('login');
</script>

</body>
</html>

<?php

	require_once PHP_ROOT.'sanitize.php';
	require_once PHP_ROOT.'database.php';
	
	use database\DatabaseHandler;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$db = new DatabaseHandler();
		
		header("Location: http://localhost/index.php", true, 302);

		exit();
	}

?>
