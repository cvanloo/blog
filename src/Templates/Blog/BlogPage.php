<!-- Blog -->

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<title>Blog <?php echo '???' ?></title>

<head>
<body class="bg-dark text-light">

<?php

	include_once PHP_TEMPLATES.'Blog/NavbarComponent.php';

?>

<div class="container d-grid gap-5">
<?php
	echo $_SERVER['REQUEST_URI'];

	require PHP_VENDOR.'erusev/parsedown/Parsedown.php';
	
	$md = file_get_contents('/uploads/uff/todo.md');
	
	$MDParser = new \Parsedown();

	echo $MDParser->text($md);
?>
</div>

<div class="container d-grid gap-5">
<!-- Comment Section -->
<!-- Create Comment -->
	<form >
		<input type="text" name="comment" placeholder="Write a comment" />
		<input type="button" name="submit" value="Comment" />
	</form>

<!-- Comments -->
	<?php

	require PHP_MODULES.'Database/DatabaseHandler.php';
	use Modules\Database\DatabaseHandler;

	$db = new DatabaseHandler();
	$comments = $db->retrieve_comments(20);
	
	foreach ($comments as $comment) {
		var_dump($comment);
		echo '<br>';
	}

	?>

</div>

	<!-- Popper and Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>
