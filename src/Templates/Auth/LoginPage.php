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

		$answer = array(
			'success' => false,
			'message' => ""
		);

		if (true == $result['success']) {
			$_SESSION['userid'] = $result['id'];
			$_SESSION['accname'] = $result['accname'];
			$_SESSION['disname'] = $result['disname'];

			$answer['success'] = true;
			$answer['message'] = "Successfully logged in.";	
		}
		else {
			$answer['message'] = "Wrong credentials.";
		}

		$json = json_encode($answer);
		echo $json;
	}

?>
