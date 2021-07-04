<?php

namespace Modules\Auth;

require '/var/php/config/config.php';
require PHP_MODULES.'Database/DatabaseHandler.php';

use Modules\Database\DatabaseHandler;

class AuthHandler {

	public function register(string $email, string $acc_name, string $pw) {
		$db = new DatabaseHandler();
		$db->start_transaction();

		// Create user account
		$result = $db->store_user($email, $acc_name, $pw);

		if ($result->success) {
			// Retrieve id of just created account
			$user_id = $result->last_id;
	
			// Store user access rights
			$db->store_access_right($user_id, 'admin', 'false');
			$db->store_access_right($user_id, 'can_publish', 'true');
			$db->store_access_right($user_id, 'can_comment', 'true');

			$db->commit_transaction();
			return true;
		}

		$db->rollback_transaction();
		return false;
	}

	public function login(string $identifier, string $pw) {
		$db = new DatabaseHandler();
		
		$user = null; 
		if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
			// User authenticated via email
			$user = $db->retrieve_user_by_email($identifier);
		}
		else {
			// User authenticated via account name
			$user = $db->retrieve_user_by_name($identifier);
		}

		$pwhash = $user['pw_hash'];
		$id = $user['id'];
		$accname = $user['account_name'];
		$disname = $user['display_name'];

		// verify password
		if (password_verify($pw, $pwhash)) {
			// check if the passwords needs to be rehashed
			if (password_needs_rehash($pwhash, PASSWORD_DEFAULT, ['cost' => HASH_COST])) {
				$db->update_password($id, $pw);
			}

			return array('success' => true, 'id' => $id, 'accname' => $accname, 'disname' => $disname);
		}

		return array('success' => false);
	}

	public function logout() {}

	public function check_username(string $username) {}

	public function check_email(string $email) {}

	public function pw_match(string $pw, string $repeat) {}

}

?>
