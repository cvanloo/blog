<?php

namespace Modules\Auth;

require 'var/php/config/config.php';
require PHP_MODULES.'Database/DatabaseHandler.php';
use Modules\Database;

class AuthHandler {

	public function register(string $email, string $acc_name, string $pwhash,
		string $display_name = null)
	{
		if (null == $display_name) {
			$display_name = $acc_name;
		}

		$db = DatabaseHandler();

		$db->store_user($email, $acc_name, $pwhash, $display_name);
	}

	public function login(string $identifier, string $pwhash) {
		$db = DatabaseHandler();

		$user = $db->retrieve_user($identifier);

		if (0 == strcmp($pwhash, $user['pw_hash'])) {
			return; // TODO: Successfull
		}

		return; // TODO: Failed
	}

	public function logout() {}

	public function check_username(string $username) {}

	public function check_email(string $email) {}

	public function pw_match(string $pw, string $repeat) {}

}

?>
