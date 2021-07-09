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

	
	$answer = array(
		'success' => false,
		'message' => ""
	);
	
	if ($password !== $rep_password) {
		$answer['message'] = "Passwords don't match.";
	} // TODO: validate E-Mail
	else {
		$auth = new AuthHandler();
	
		$result = $auth->register($email, $username, $password);
	
		if (true == $result) {
			$answer['success'] = true;
			$answer['message'] = "Account created.";
		}
		else {
			echo "Something went wrong.";
			$answer['message'] = "Something went wrong.";
		}
	}
	
	$json = json_encode($answer);
	echo $json;
}

?>
