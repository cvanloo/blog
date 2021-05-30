<?php

namespace database;

// Since we are in a different namespace (database), we need to include PDO's
// classes here
// Another way would be to just prefix the classes with '\' like: "new \PDO("
use PDO; 
use PDOException;

class DatabaseHandler {
	private $conn;

	// Constructor
	// Initialize a connection to the database.
	function __construct() {
		try {
			$this->conn = new PDO(DB_CONNECT, "admin", "tst");
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
		catch (PDOException $pdeoEx) {
			die("Failed to connect to database");
			//echo "Failed to connect to database.";
		}
	}
}

?>
