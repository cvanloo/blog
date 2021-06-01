<?php

require '/var/settings/config.php';
require PHP_ROOT.'session.php';

if (isset($_SESSION['userid'])) {
	echo "hey, you are already logged in!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<title>Blog, Create an Account</title>

</head>
<body class="bg-dark text-light">

	<style>
		.no-border-top {
			border-top-left-radius: 0px;
			border-top-right-radius: 0px;
		}

		.no-border {
			border-radius: 0px;
		}

		.no-border-bottom {
			border-bottom-left-radius: 0px;
			border-bottom-right-radius: 0px;
		}

		.bigger {
			min-height: 50px;
		}
	</style>

	<div class="text-center mt-5 input-group input-group-lg">
		<form style="max-width: 300px; margin: auto">
		<h1 class="mb-3 h1">Create Account</h1>
		<input type="email" placeholder="Email" class="form-control bg-dark text-light no-border-bottom bigger" />
		<input type="text" placeholder="Username" class="form-control bg-dark text-light no-border bigger" />
		<input type="password" placeholder="Password" class="form-control bg-dark text-light no-border bigger" />
		<input type="password" placeholder="Repeat Password" class="form-control bg-dark text-light no-border-top bigger" />

		<div class="checkbox mt-3">
			<label>
				<input type="checkbox" /> Remember Me!
			</label>
		</div>

		<div class="mt-3 mb-1">
			<button style="min-width: 300px"type="button" class="btn btn-outline-success btn-lg btn-block">Create Account</button>
		</div>

		<a href="login.html" class="badge badge-secondary">Sign in instead</a>

		</form>
	</div>
	
	<!-- Popper and Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>
