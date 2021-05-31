<?php

require '/var/settings/config.php';
require PHP_ROOT.'database.php';

use PHPUnit\Framework\TestCase;

final class DatabaseTest extends TestCase
{
	public function testValidateLogin(): void {
		$db = new database\DatabaseHandler();
		
		$db->create_account("testcase@email.com", "testcase", "12345test");

		$this->assertEquals(true, $db->validate_login("testcase", "12345test"));
	}
}

?>
