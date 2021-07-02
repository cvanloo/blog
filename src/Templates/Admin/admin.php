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

		echo "<div class=\"text-center mt-5 input-group input-group-lg\">";
		echo "<form method=\"POST\" action=\"\" style=\"max-width: 300px; margin: auto\">";

		foreach ($access_rights as $right) {
			echo <<< EOL
			<label>{$right['ar_key']}: </label>
			<input name="{$right['ar_key']}" type="text" placeholder="{$right['ar_value']}" class="form-control bg-dark text-light" />
			EOL;
		}

		echo "<label>Blocked: </label>";
		echo "<input name=\"is_blocked\" type=\"text\" placeholder=\"{$user['is_blocked']}\" class=\"form-control bg-dark text-light\" />";

		echo <<< EOL
		<div class="mt-3 mb-1">
			<button id="btnSubmit" style="min-width: 300px"
				type="submit" class="btn btn-outline-success btn-lg btn-block">Update</button>
		</div>
		EOL;

		echo "</form>";
		echo "</div>";
	}
	else {
		echo '<p>User '.$accname.' does not exist.</p>';
	}

}

?>
