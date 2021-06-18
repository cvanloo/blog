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

	if ($user) {
		$access_rights = $db->retrieve_access_rights($user['id']);
		
		foreach ($access_rights as $right) {
			echo $right['ar_key'] . ': ' . $right['ar_value'];
			echo '<br/>';
		}

		echo 'Blocked: ' . $user['is_blocked'];
	}
	else {
		echo '<p>User '.$accname.' does not exist.</p>';
	}

}

?>
