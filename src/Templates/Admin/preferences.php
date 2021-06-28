<?php

require_once PHP_MODULES.'Input/sanitize.php';
require_once PHP_MODULES.'Database/DatabaseHandler.php';

use function Modules\Input\sanitize;
use Modules\Database\DatabaseHandler;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	switch ($_POST['form']) {
		case 'acc':
			$disname = sanitize($_POST['disname']);
			$email = sanitize($_POST['email']);

			updateAcc($disname, $email);
			break;
		case 'pw':
			$curpw = sanitize($_POST['curpw']);
			$newpw = sanitize($_POST['newpw']);
			$repnewpw = sanitize($_POST['repnewpw']);

			updatePw($curpw, $newpw, $repnewpw);
			break;
	}
}

function updateAcc($disname, $email) {
	$db = new DatabaseHandler();

	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$db->update_email($_SESSION['userid'], $email);
	}
	
	if (preg_match("/^[a-zA-Z-' ]*$/", $disname)) {
		$db->update_displayname($_SESSION['userid'], $disname);
	}
}

function updatePw($curpw, $newpw, $repnewpw) {
	$db = new DatabaseHandler();

	$pwhash = $db->retrieve_user_by_id($_SESSION['userid'])['id'];

	if (password_verify($curpw, $pwhash)) {
		if ($repnewpw == $newpw) {
			$db->update_password($_SESSION['userid'], $newpw);
		}
	}
}

?>
