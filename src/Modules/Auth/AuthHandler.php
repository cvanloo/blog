<?php

namespace Modules\Auth;

require '/var/php/config/config.php';
require PHP_MODULES.'Database/DatabaseHandler.php';

use Modules\Database\DatabaseHandler;

class AuthHandler {

	public function register(string $email, string $acc_name, string $pw)
	{
		$db = new DatabaseHandler();

		// Create user account
		if ($db->store_user($email, $acc_name, $pw)) {
			// Retrieve id of just created account
			$userid = $db->retrieve_user_by_name($acc_name)['id'];
	
			// Store user access rights
			$db->store_access_right($userid, 'admin', 'false');
			$db->store_access_right($userid, 'can_publish', 'true');
			$db->store_access_right($userid, 'can_comment', 'true');
		}

		return true; // TODO: Database Transactions & Rollback
	}

	public function login(string $identifier, string $pw) {
		$db = new DatabaseHandler();

		$user = $db->retrieve_user_by_name($identifier);

		$pwhash = $user['pw_hash'];
		$id = $user['id'];
		$accname = $user['account_name'];

		// verify password
		if (password_verify($pw, $pwhash)) {
			// check if the passwords needs to be rehashed
			if (password_needs_rehash($pwhash, PASSWORD_DEFAULT, ['cost' => 15])) {
				$db->update_password($id, $pw);
			}

			return array('success' => true, 'id' => $id, 'accname' => $accname);
		}

		return array('success' => false);
	}

	public function logout() {}

	public function check_username(string $username) {}

	public function check_email(string $email) {}

	public function pw_match(string $pw, string $repeat) {}

}

?>
