<?php
// Test driven development is a scam 😤

require '/var/settings/config.php';
require PHP_ROOT.'database.php';

use PHPUnit\Framework\TestCase;
use database\DatabaseHandler;

final class DatabaseTest extends TestCase
{
	private $db;

	public function __construct() {
		// Wait for the database to be ready to accept connections
		while ((DatabaseHandler::connection_test())->success == false) {
			sleep(0.2);
		}

		$this->db = new DatabaseHandler();

		parent::__construct();
	}

	/*public function testCreateAccount() : void {
		$this->db->create_account("testcase@email.com", "testcase", "12345test");
	}*/

	public function testValidateLogin() : void {
		$this->assertEquals(true, ($this->db->validate_login("testcase", "12345test"))->success);
	}

	/*public function testDeleteAccount() : void {
	}*/
}

?>
