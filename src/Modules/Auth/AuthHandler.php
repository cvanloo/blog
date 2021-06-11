<?php

namespace Modules\Auth;

require '/var/php/config/config.php';
require PHP_MODULES.'Database/DatabaseHandler.php';

use Modules\Database\DatabaseHandler;

class AuthHandler {

	public function register(string $email, string $acc_name, string $pw)
	{
		$db = new DatabaseHandler();

		return $db->store_user($email, $acc_name, $pw);
	}

	public function login(string $identifier, string $pw) {
		$db = new DatabaseHandler();

		$user = $db->retrieve_user($identifier);

		$pwhash = $user['pw_hash'];
		$id = $user['id'];
		$accname = $user['account_name'];

		if (password_verify($pw, $pwhash)) {
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
