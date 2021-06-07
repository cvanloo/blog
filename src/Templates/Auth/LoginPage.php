<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Maybe just once in index.php -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<title>Blog, Please login</title>

	<script type="text/javascript">

	function generateHash(password) {
		const bcrypt = require('bcrypt');

		bcrypt.hash(password, 12, (err, hash) => {
			if (err) {
				console.error(err)
				return
			}
			console.log(hash)
		})
	}

	function validate() {
		var btn = document.getElementById('btnSubmit');

		btn.disabled = false;
	}

	// TODO: When the focus leaves a textbox, validate it
	// TODO: When all textboxes are successfully validated, enable the "Sign in" button
	// TODO: When the "Sign in" button is pressed, create the hash and then make a call to php module
	// TODO: If the answer is successfull, the user is logged in and redirected

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
			class="form-control bg-dark text-light" required onkeyup="validate()" />
		<input name="password" type="password" placeholder="Password"
			class="form-control bg-dark text-light" required onkeyup="validate()" />

		<div class="checkbox mt-3">
			<label>
				<input name="remember_me" type="checkbox" /> Remember Me!
			</label>
		</div>

		<div class="mt-3 mb-1">
			<button id="btnSubmit" disabled style="min-width: 300px" type="submit" class="btn btn-outline-success btn-lg btn-block">Sign in</button>
		</div>

		<a href="register" class="badge badge-secondary">Create an Account</a>

		</form>
	</div>

	<!-- Popper and Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>
