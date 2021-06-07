<?php
namespace Modules\Database;

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
			echo $pdoEx;
			die("Failed to connect to database. See error above.");
		}
	}

	// Destructor
	// Remove the connection
	public function __destruct() {
		$this->conn = null;
	}

	// Tests if a connection to the database can be made.
	public static function connection_test() : DatabaseResult {
		try {
			$conn = new PDO(DB_CONNECT, DB_USER, DB_PW, array(PDO::ATTR_ERRMODE
							=> PDO::ERRMODE_EXCEPTION));
		}
		catch (PDOException $pdoEx) {
			return new DatabaseResult(false, $pdoEx->getMessage());
		}

		return new DatabaseResult(true);
	}
	
	public function query_from_file(string $filepath) {
		$query = file_get_contents($filepath);
		if (false == $query) {
			throw new \Exception("Failed to open file."); // TODO: Make proper exceptions
		}

		$this->conn->exec($query);
	}

	// Stores a new account in the database
	public function store_user(string $email, string $acc_name, string $pw,
		string $display_name) : bool
	{
		$statement = "INSERT INTO user (email, account_name, display_name, pw_hash)
			VALUES (:email,:account_name,:display_name,:pw_hash)";

		$data = [
			'email' => $email,
			'account_name' => $acc_name,
			'display_name' => $display_name,
			'pw_hash' => $pwhash
		];

		$stmt = $this->conn->prepare($statement);

		try {
			$stmt->execute($data);
		}
		catch (PDOException $pdoEx) {
			return false;
		}

		return true;
	}

	public function retrieve_user(string $acc_name) {
		$statement = "SELECT * FROM user WHERE account_name = ?";
		$stmt = $this->conn->prepare($statement);

		$stmt->execute([$acc_name]);
		$user = $stmt->fetch();

		return $user;
	}

	public function update_password() {

	}

	public function update_accountname() {

	}

	public function update_displayname() {

	}
}

class DatabaseResult {
	public $success;
	public $message;

	public function __construct(bool $success, string $message = NULL) {
		$this->success = $success;
		$this->message = $message;
	}

	public function __toString() : string {
		return "$this->success: $this->message";
	}
}

?>
