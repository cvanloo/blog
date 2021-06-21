<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<title>Home Blog: <?php echo $_SESSION['disname']; ?></title>

<head>
<body class="bg-dark text-light">

<?php

	include_once PHP_TEMPLATES.'Blog/NavbarComponent.php';

?>

<div class="container d-grid gap-5" style="margin-top: 60px;">
	<?php
		// Get blogs
		require_once PHP_MODULES.'Database/DatabaseHandler.php';
		use Modules\Database\DatabaseHandler;
		$db = new DatabaseHandler();

		$blogs = $db->retrieve_blog(50);

		if (null == $blogs) exit();

		// Display all blogs
		foreach ($blogs as $blog) {
			$user_name = $db->retrieve_user_by_id($blog['creator_id'])['account_name'];
			include PHP_TEMPLATES.'Blog/BlogPreviewComponent.php';
		}
	?>
</div>


	<!-- Popper and Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>
