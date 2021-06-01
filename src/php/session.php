<?php

// Make sure to require this on the very first line in every page of the site!
session_start();

if (isset($_SESSION["loggedin"])) {
	$user = $_SESSION["loggedin"];
	echo "<p>Logged in as $user</p>";
}

?>
