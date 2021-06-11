<!-- Blog -->

<!DOCTYPE html>
<html>
<body>

<?php

	include_once PHP_TEMPLATES.'Blog/NavbarComponent.php';

?>

<div class="container d-grid gap-5">
<?php
	echo $_SERVER['REQUEST_URI'];

	require PHP_VENDOR.'erusev/parsedown/Parsedown.php';
	
	$md = file_get_contents('/uploads/uff/test.md');
	
	$MDParser = new \Parsedown();

	echo $MDParser->text($md);
?>
</div>

<!-- Comment Section -->
<!-- Create Comment -->

<!-- Comments -->
</body>
</html>