<?php

	require PHP_MODULES.'Input/sanitize.php';
	require PHP_MODULES.'Auth/AuthHandler.php';
	
	use function Modules\Input\sanitize;
	use Modules\Auth\AuthHandler;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$identifier = sanitize($_POST['identifier']);
		$password = sanitize($_POST['password']);
		
		$auth = new AuthHandler();

		$result = $auth->login($identifier, $password);


		if (true == $result['success']) {
			$_SESSION['userid'] = $result['id'];
			$_SESSION['accname'] = $result['accname'];
			echo "<p>Successfully logged in.</p>";
		}
		else {
			echo "<p>Wrong credentials.</p>";
		}
	}

?>