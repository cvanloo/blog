<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<title>Blog, Create an Account</title>

	<script type="text/javascript">

	function validate() {
		var tbs = document.getElementsByTagName('input')
		var btn = document.getElementById('btnSubmit');

		for (i = 0; i < tbs.length; i++) {
			var tb = tbs[i];
			switch (tb.type) {
				case 'email':
					console.log('email');
					if (! /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(tb.value)) {
						btn.disabled = true;
						return;
					}
					break;
				case 'password':
				case 'text':
					console.log('password or text');
					if (!tb.value) {
						btn.disabled = true;
						return;
					}
					break;
			}
		}

		btn.disabled = false;
	}

	</script>

</head>
<body class="bg-dark text-light">

	<style>
		.no-border-top {
			border-top: 0px;
			border-top-left-radius: 0px;
			border-top-right-radius: 0px;
		}

		.no-border {
			border-radius: 0px;
		}

		.no-border-bottom {
			border-bottom: 0px;
			border-bottom-left-radius: 0px;
			border-bottom-right-radius: 0px;
		}

		.bigger {
			min-height: 50px;
		}
	</style>

	<div class="text-center mt-5 input-group input-group-lg">
		<form style="max-width: 300px; margin: auto" method="post" action="/register">
		<h1 class="mb-3 h1">Create Account</h1>
		<input name="email" type="email" placeholder="Email"
			class="form-control bg-dark text-light no-border-bottom bigger" 
			onkeyup="validate();" required />
		<input name="username" type="text" placeholder="Username"
			class="form-control bg-dark text-light no-border bigger"
			onkeyup="validate();" required />
		<input name="password" type="password" placeholder="Password"
			class="form-control bg-dark text-light no-border bigger" style="border-top: 0px;"
			onkeyup="validate();" required />
		<input name="rep_password" type="password" placeholder="Repeat Password"
			class="form-control bg-dark text-light no-border-top bigger"
			onkeyup="validate();" required />

		<div class="checkbox mt-3">
			<label>
				<input type="checkbox" /> Remember Me!
			</label>
		</div>

		<div class="mt-3 mb-1">
			<button id="btnSubmit" disabled style="min-width: 300px" type="submit" class="btn btn-outline-success btn-lg btn-block">Create Account</button>
		</div>

		<a href="login" class="badge badge-secondary">Sign in instead</a>

		</form>
	</div>
	
	<!-- Popper and Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>

<?php

	require PHP_MODULES.'Input/sanitize.php';
	require PHP_MODULES.'Auth/AuthHandler.php';
	
	use function Modules\Input\sanitize;
	use Modules\Auth\AuthHandler;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = sanitize($_POST['email']);
		$username = sanitize($_POST['username']);
		$password = sanitize($_POST['password']);
		$rep_password = sanitize($_POST['rep_password']);

		if ($password !== $rep_password) {
			echo "<p>Passwords don't match</p>";
			exit();
		}
		
		$auth = new AuthHandler();

		$result = $auth->register($email, $username, $password);

		if (true == $result) {
			echo "Account created.";
		}
		else {
			echo "Something went wrong.";
		}
	}

?>