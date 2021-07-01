<!-- Blog -->

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<title><?php echo user['display_name'].': '.blog['title'] ?></title>

<head>
<body class="bg-dark text-light">

<?php

	include_once PHP_TEMPLATES.'Blog/NavbarComponent.php';

?>

<div class="container d-grid gap-5 mt-5 mb-5">
<?php
	require PHP_VENDOR.'erusev/parsedown/Parsedown.php';
	
	$md = file_get_contents(blog['content_path']);
	
	$MDParser = new \Parsedown();
	$MDParser->setSafeMode(true); // Prevent XSS

	echo $MDParser->text($md);
?>
</div>

<div class="container d-grid gap-5">
<!-- Comment Section -->
<!-- Create Comment -->
	<form class="p-2 border border-success border-2" method="post" action="<?php echo $uri ?>">
		<input type="text" name="comment" placeholder="Write a comment" />
		<input type="submit" name="submit" value="Comment" />
	</form>

<!-- Comments -->
	<?php

	require_once PHP_MODULES.'Database/DatabaseHandler.php';
	use Modules\Database\DatabaseHandler;

	$db = new DatabaseHandler();
	$comments = $db->retrieve_comments(blog['id'], 20);
	
	if (null !== $comments && !empty($comments)) {
		foreach ($comments as $comment) {
			// $user = $db->retrieve_user_by_id($comment['creator_id'])['display_name'];
			// echo "<p style=\"border-bottom: 2px solid;\">" . $user . ": " . $comment['content'] . "</p>";
			// echo '<br>';
			include PHP_TEMPLATES.'Blog/CommentComponent.php';
		}
	}
	else {
		echo '<p>There are no comments yet.<br>';
		echo 'Be the first to write one.</p>';
	}

	?>

</div>

	<!-- Popper and Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	var_dump($_POST);
	$db = new DatabaseHandler();
	$res = $db->store_comment($_SESSION['userid'], blog['id'], $_POST['comment'], $_POST['parent_comment']);
}

?>
