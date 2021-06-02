<?php

// Make sure to require this on the very first line in every page of the site!
session_start();

$user = $_SESSION['userid'];
if (isset($user)) {
	echo "<p>$user</p>";
}

?>
