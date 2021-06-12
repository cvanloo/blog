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
echo $blog_post;

?>
