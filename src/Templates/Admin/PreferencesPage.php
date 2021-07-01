<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<!-- AJAX JQuery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<title>User Preferences: <?php echo $_SESSION['accname'] ?></title>

	<style>
		input[type="text"], input[type="email"], input[type="password"] {
			min-height: 50px;
		}
	
		.no-border {
			border-radius: 0px;
			border-top: 0px;
		}
		
		.no-border-top {
			border-top-right-radius: 0px;
			border-top-left-radius: 0px;
			border-top: 0px;
		}
	
		.no-border-bottom {
			border-bottom-right-radius: 0px;
			border-bottom-left-radius: 0px;
		}
	</style>

</head>
<body class="bg-dark text-light">

	<?php include_once PHP_TEMPLATES.'Blog/NavbarComponent.php'; ?>

<div class="container d-grid gap-5" style="margin-top: 60px;">
	<?php

	require PHP_MODULES.'Database/DatabaseHandler.php';
	use Modules\Database\DatabaseHandler;

	$db = new DatabaseHandler();
	
	$user = $db->retrieve_user_by_id($_SESSION['userid']);

	?>


	<div class="text-center mt-5 input-group input-group-lg">
		<form id="accForm" style="max-width: 300px; margin: auto">
			<h2 class="mb-3 h1">Update Account</h2>
			<p class="form-control bg-dark text-light">Account Name: <?php echo $user['account_name']; ?> </p>
			
			<input id="disname" type="text" placeholder="Display Name: <?php echo $user['account_name']; ?>"
				class="form-control bg-dark text-light no-border-bottom" />
			<input id="email" type="email" placeholder="Email Address: <?php echo $user['email']; ?>"
				class="form-control bg-dark text-light no-border-top" />
					
			<div class="mt-3 mb-1">
				<button id="btnSubmit" style="min-width: 300px"
					type="submit" class="btn btn-outline-success btn-lg btn-block">Update Account</button>
			</div>
			
			<p class="answer"></p>
		</form>


		<form id="pwForm" style="max-width: 300px; margin: auto">
			<h2 class="mb-3 h1">Update Password</h2>
			<p class="form-control bg-dark text-light">Account Name: <?php echo $user['account_name']; ?> </p>
			
			<input id="currpw" type="password" placeholder="Current Password"
				class="form-control bg-dark text-light no-border-bottom" />
			<input id="newpw" type="password" placeholder="New Password"
				class="form-control bg-dark text-light no-border" />
			<input id="repnewpw" type="password" placeholder="Repeat New Password"
				class="form-control bg-dark text-light no-border-top" />
			
			<div class="mt-3 mb-1">
				<button id="btnSubmit" style="min-width: 300px"
					type="submit" class="btn btn-outline-success btn-lg btn-block">Update Password</button>
			</div>
			
			<p class="answer"></p>
		</form>
	</div>

</div>

	<!-- Popper and Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>

<script>
$(function() {
	$('#accForm').submit(function(e) {
		$.ajax({
			method: "POST",
			url: "/pref.php",
			data: { 'form': 'acc', 'disname': $('#disname').val(), 'email': $('#email').val() },
			dataType: 'json',
			async: 'false'
		})
			.done(function(response) {
				$('p.answer').html(response['message']);
			});
		e.preventDefault();
	});
});

$(function() {
	$('#pwForm').submit(function(e) {
		$.ajax({
			method: "POST",
			url: "/pref.php",
			data: { 'form': 'pw', 'curpw': $('#curpw').val(), 'newpw': $('#newpw').val(), 'repnewpw': $('#repnewpw').val() },
			dataType: 'json',
			async: 'false'
		})
			.done(function(response) {
				$('p.answer').html(response['message']);
			});
		e.preventDefault();
	});
});
</script>
