<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Maybe just once in index.php -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<!-- AJAX JQuery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<title>Blog, Goodbye!</title>

</head>
<body class="bg-dark text-light">

<div class="text-center mt-5 input-group input-group-lg">
		<div style="max-width: 300px; margin: auto">
			<h1 class="mb-3 h1">Do you really want to logout?</h1>

			<div class="mt-3 mb-1">
				<button id="btnBye" style="min-width: 300px" type="submit" class="btn btn-outline-success btn-lg btn-block">Logout</button>
			</div>

			<a href="/" class="badge badge-secondary">Go back</a>

		</div>
	</div>

	<!-- Popper and Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	session_unset();
	session_destroy();
}

?>

<script>
$(function() {
	$('#btnBye').click(function() {
		$.ajax({
			method: "POST",
		})
			.done(function(response) {
				window.location = "/";
			});
	});
});
</script>
