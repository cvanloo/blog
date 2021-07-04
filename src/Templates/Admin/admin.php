<?php

// Admin html
// * allow to modify the users access rights
// * allow to (un)block a user

require_once PHP_MODULES.'Input/sanitize.php';
require_once PHP_MODULES.'Database/DatabaseHandler.php';

use function Modules\Input\sanitize;
use Modules\Database\DatabaseHandler;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$accname = sanitize($_POST['search_field']);
	$db = new DatabaseHandler();

	$user = $db->retrieve_user_by_name($accname);
	$answer = NULL;

	if ($user) {
		$access_rights = $db->retrieve_access_rights($user['id']);
		$is_blocked = (bool)$user['is_blocked'];

		$answer = [
			'message' => '<p>User found.</p>',
			'is_admin' => get_value($access_rights, 'ar_key', 'admin', 'ar_value'),
			'can_publish' => get_value($access_rights, 'ar_key', 'can_publish', 'ar_value'),
			'can_comment' => get_value($access_rights, 'ar_key', 'can_comment', 'ar_value'),
			'is_blocked' => $is_blocked,
			'user_id' => $user['id']
		];
	}
	else {
		$answer = ['message' => '<p>User '.$accname.' does not exist.</p>'];
	}

	$json = json_encode($answer);
	echo $json;
}

function get_value($array, $key, $key_val, $val) {
	foreach ($array as $ar) {
		if ($ar[$key] === $key_val) {
			return $ar[$val];
		}
	}

	return NULL;
}

?>
