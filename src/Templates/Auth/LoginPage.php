<?php

//require '/var/php/config/config.php';
//require PHP_MODULES.'Session/session.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Maybe just once in index.php -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<title>Blog, Please login</title>

	<script>

	function generateHash(password) {
		const bcrypt = require('bcrypt');

		bcrypt.hash(password, 12, (err, hash) => {
			if (err) {
				console.error(err)
				return
			}
			console.log(hash)
		}
	}

	</script>

</head>
<body class="bg-dark text-light">

	<style>
		input[type="text"] {
			min-height: 50px;
			border-bottom-left-radius: 0px;
			border-bottom-right-radius: 0px;
		}

		input[type="password"] {
			min-height: 50px;
			border-top-left-radius: 0px;
			border-top-right-radius: 0px;
			border-top: 0px;
		}
	</style>

	<!--<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>-->
	<div class="text-center mt-5 input-group input-group-lg">
		<form style="max-width: 300px; margin: auto" method="post" action="/login">
		<h1 class="mb-3 h1">Login</h1>
		<input name="identifier" type="text" placeholder="Username/Email"
			class="form-control bg-dark text-light" required />
		<input name="password" type="password" placeholder="Password"
			class="form-control bg-dark text-light" required />

		<div class="checkbox mt-3">
			<label>
				<input name="remember_me" type="checkbox" /> Remember Me!
			</label>
		</div>

		<div class="mt-3 mb-1">
			<button style="min-width: 300px" type="submit" class="btn btn-outline-success btn-lg btn-block">Sign in</button>
		</div>

		<a href="register" class="badge badge-secondary">Create an Account</a>

		</form>
	</div>
	
	<!-- Popper and Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>

<?php

	require PHP_MODULES.'Input/sanitize.php';
	require PHP_MODULES.'Database/database.php';
	
	use Modules\Database\DatabaseHandler;
	use Modules\Database\DatabaseResult;
	use function Modules\Input\sanitize;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$identifier = sanitize($_POST['identifier']);
		$password = sanitize($_POST['password']);
		$db = new DatabaseHandler();

		$result = $db->validate_login($identifier, $password);


		if (true == $result->success) {
			$_SESSION['userid'] = $result->message;
			echo "<p>Successfully logged in</p>";
		}
		else {
			echo "<p>Wrong credentials</p>";
		}

		// TODO: This redirect would ONLY work if it was sent before any html tags
		// aka. <!DOCTYPE html>	
		//header("Location: http://localhost/", true, 302);
		//exit();
	}

?>
