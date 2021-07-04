<?php

require_once PHP_MODULES.'Database/DatabaseHandler.php';
use Modules\Database\DatabaseHandler;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$db = new DatabaseHandler();
	$is_admin = false;

	if (isset($_SESSION['userid'])) {
		$access_right = $db->retrieve_access_right($_SESSION['userid'], 'admin');
		$is_admin = $access_right['ar_value'] == 'true' ? true : false;
	}

	if ($is_admin) {
		$user_id = $_POST['user_id'];

		$db->update_access_right($user_id, 'admin', $_POST['is_admin']);
		$db->update_access_right($user_id, 'can_publish', $_POST['can_publish']);
		$db->update_access_right($user_id, 'can_comment', $_POST['can_comment']);

		// TODO: Update 'is_blocked'
	}
}

?>
