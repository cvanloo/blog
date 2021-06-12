<div class="text-center mt-5 input-group input-group-lg">
	<form style="max-width: 300px; margin: auto" method="post" action="/admin">
		<span class="input-group-text border-0 bg-dark text-light">
			<input type="text" name="search_field" placeholder="Enter username"
				class="form-control bg-dark text-light"/>
			<input type="submit" name="submit" value="Search"
				class="btn btn-outline-success "/>
		</span>
	</form>
	<!-- TODO: JQuery or React?-->
</div>

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
