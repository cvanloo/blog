<?php

require PHP_MODULES.'Database/DatabaseHandler.php';
use Modules\Database\DatabaseHandler;

// If string doesn't end with a / add one
if (substr($uri, -1) !== '/') {
	$uri = $uri.'/';
}

// Get everything between @ and / or end of string
preg_match('~@(.*?)/~', $uri, $output);

$accname = $output[1];
$db = new DatabaseHandler();

$user = $db->retrieve_user_by_name($accname);

// Check if the url contains more than just a username
$blog_post = str_replace($output[0], '', $uri);
$blog_post = str_replace($output[1], '', $blog_post);

// Remove / from start and end, if there are any
$blog_post = trim($blog_post, '/');

define('user', $user);

if ($blog_post) {
	// TODO: The user can put anything into an url, validate it first!
	$blog = $db->retrieve_blog_by_name(user['id'], $blog_post);

	if (null !== $blog) {
		define('blog', $blog);
	}
}

if (defined('blog')) {
	include_once PHP_TEMPLATES.'Blog/BlogPage.php';
}
else {
	include_once PHP_TEMPLATES.'Blog/UserPage.php';
}

?>
