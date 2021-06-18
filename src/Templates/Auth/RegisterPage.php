<?php

require PHP_MODULES.'Input/sanitize.php';
require PHP_MODULES.'Auth/AuthHandler.php';

use function Modules\Input\sanitize;
use Modules\Auth\AuthHandler;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = sanitize($_POST['email']);
	$username = sanitize($_POST['username']);
	$password = sanitize($_POST['password']);
	$rep_password = sanitize($_POST['rep_password']);

	if ($password !== $rep_password) {
		echo "Passwords don't match.";
		exit();
	}
	
	$auth = new AuthHandler();

	$result = $auth->register($email, $username, $password);

	if (true == $result) {
		echo "Account created.";
	}
	else {
		echo "Something went wrong.";
	}
}

?>