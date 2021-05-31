<?php
namespace database;

// Since we are in a different namespace (database), we need to include PDO's
// classes here
// Another way would be to just prefix the classes with '\' like: "new \PDO("
use PDO; 
use PDOException;

// Witout any access modifiers specified, php treats everything as public
class DatabaseHandler {
	// Stores our database connection
	private $conn;

	// Constructor
	// Initialize a connection to the database.
	public function __construct() {
		try {
			$this->conn = new PDO(DB_CONNECT, DB_USER, DB_PW);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
		catch (PDOException $pdoEx) {
			die("Failed to connect to database");
		}
	}

	// Destructor
	// Remove the connection
	public function __destruct() {
		$this->conn = null;
	}
	
	public function query_from_file(string $filepath) {
		$query = file_get_contents($filepath);
		if (false == $query) {
			throw new \Exception("Failed to open file."); // TODO: Make proper exceptions
		}

		$this->conn->exec($query);
	}

	// Stores a new account in the database
	public function create_account(string $email, string $acc_name, string $pw,
									string $display_name = null) {
		if (null == $display_name) {
			$display_name = $acc_name;
		}

		// 'PASSWORD_DEFAULT' uses PHP's strongest hashing algorithm.
		// This can change, therefore the length of the hash can change too.
		// It is recommended to use 255 characters in the database.
		$options = [ "cost" => 15 ]; // shouldn't take longer than a 100ms to execute
		$pwhash = password_hash($pw, PASSWORD_DEFAULT, $options);
		
		$statement = "INSERT INTO user (email, account_name, display_name, pw_hash)
			VALUES (:email,:account_name,:display_name,:pw_hash)";

		$data = [
			'email' => $email,
			'account_name' => $acc_name,
			'display_name' => $display_name,
			'pw_hash' => $pwhash
		];

		$stmt = $this->conn->prepare($statement);
		$stmt->execute($data);
	}

	public function validate_login(string $acc_name, string $pw) : bool {
		$statement = "SELECT pw_hash FROM user WHERE account_name = ?";
		$stmt = $this->conn->prepare($statement);

		$stmt->execute([$acc_name]);
		$pwhash = $stmt->fetch()['pw_hash'];
		
		return password_verify($pw, $pwhash);
	}

	public function update_password() {

	}

	public function update_accountname() {

	}

	public function update_displayname() {

	}
}

?>
