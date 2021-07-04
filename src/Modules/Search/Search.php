<?php

require_once PHP_MODULES.'Database/DatabaseHandler.php';
use Modules\Database\DatabaseHandler;

$db = new DatabaseHandler();
$term = $_POST['term'];
$results = [];

// if search starts with '@' -> search for a user
if (starts_with($term, '@')) {
	$name = substr($term, 1);
	$results = $db->retrieve_user_by_name($name);
}
// if search starts with '#' -> search for blog with tags
else if (starts_with($term, '#')) {
	echo "starts with #";
	//$results = $db->retrieve_blogs_with_tags();
}
// else, search is just text -> search for blog with title
else {
	$results = $db->retrieve_blogs_by_name($term);
}

//var_dump($results);

function starts_with($haystack, $needle) {
	$len = strlen($needle);
	return substr($haystack, 0, $len) === $needle;
}
?>