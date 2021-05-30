<?php

namespace database;
use PDO; // Since we are in a different namespace (database), we need to include
         // the PDO namespace

class DatabaseHandler {
	private $conn;

	function __construct() {
		try {
			$this->conn = new PDO(DB_CONNECT, "admin", "test");
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
		catch (Exception $ex) {
			echo "Failed to connect to database";
		}
	}
}

?>
