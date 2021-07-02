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
		string $display_name = null) : bool
	{
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

		try {
			$stmt->execute($data);
		}
		catch (PDOException $pdoEx) {
			return false;
		}

		return true;
	}

	public function retrieve_user_by_name(string $acc_name) {
		$statement = "SELECT * FROM user WHERE account_name = ?";
		$stmt = $this->conn->prepare($statement);
	
		try {
			$stmt->execute([$acc_name]);
			return $stmt->fetch();
		}
		catch (PDOException $pdoEx) {
			return null;
		}
	}
	
	public function retrieve_user_by_email(string $email) {
		$statement = "SELECT * FROM user WHERE email = ?";
		$stmt = $this->conn->prepare($statement);
	
		try {
			$stmt->execute([$email]);
			return $stmt->fetch();
		}
		catch (PDOException $pdoEx) {
			return null;
		}
	}

	public function retrieve_user_by_id(int $id) {
		$statement = "SELECT * FROM user WHERE id = ?";

		$stmt = $this->conn->prepare($statement);

		try {
			$stmt->execute([$id]);
			return $stmt->fetch();
		} catch (PDOException $pdoEx) {
			return null;
		}
	}

	public function store_blog(string $creator, string $title, string $path, string $description) : bool {
		$statement = "INSERT INTO blog (creator_id, title, content_path, description)
			VALUES (:creator,:title,:path,:description)";

		$data = [
			'creator' => $creator,
			'title' => $title,
			'path' => $path,
			'description' => $description
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

	public function retrieve_blog_by_name(string $user_id, string $name) {
		$statement = "SELECT * FROM blog
			WHERE title = :title
			AND creator_id = :id";

		$stmt = $this->conn->prepare($statement);

		$data = [
			'title' => $name,
			'id' => $user_id
		];

		try {
			$stmt->execute($data);
			return $stmt->fetch();
		}
		catch (PDOException $pdoEx) {
			return null;
		}
	}

	public function retrieve_blogs_by_name(string $name) {
		$statement = "SELECT * FROM blog
			WHERE title = ?";

		$stmt = $this->conn->prepare($statement);

		try {
			$stmt->execute([$name]);
			return $stmt->fetchAll();
		}
		catch (PDOException $pdoEx) {
			return null;
		}
	}
	
	public function retrieve_blog(int $limit, int $user_id = null) {
		$statement = "";

		if (null == $user_id) {
			$statement = "SELECT * FROM blog LIMIT :max";
		}
		else {
			$statement = "SELECT * FROM blog WHERE creator_id = :id LIMIT :max;";
		}
			
		$stmt = $this->conn->prepare($statement);

		try {
			$stmt->bindValue(':max', $limit, PDO::PARAM_INT); // pdo will put sinle quotes around the integer, this way should stop it from doing so.
			if (null != $user_id) { $stmt->bindValue(':id', $user_id); }
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch (PDOException $pdoEx) {
			return null;
		}
	}

	public function store_comment(int $creator_id, int $blog_id, string $content, int $parent_id = NULL) {
		$statement = "INSERT INTO comment (creator_id, blog_id, content, parent_id)
			VALUES (:creator,:blog,:content,:parent_id)";

		$data = [
			'creator' => $creator_id,
			'blog' => $blog_id,
			'content' => $content,
			'parent_id' => $parent_id
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

	public function retrieve_comments(int $blog_id, int $limit) {
		$statement = "SELECT * FROM comment
			WHERE blog_id = :id
			LIMIT :max";

		$stmt = $this->conn->prepare($statement);

		try {
			$stmt->bindValue(':max', $limit, PDO::PARAM_INT); // pdo will put sinle quotes around the integer, this way should stop it from doing so.
			$stmt->bindValue(':id', $blog_id);
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch (PDOException $pdoEx) {
			echo $pdoEx;
			return null;
		}
	}

	public function retrieve_comment(int $id) {
		$statement = "SELECT * FROM comment
			WHERE id = ?";

		$stmt = $this->conn->prepare($statement);

		try {
			$stmt->execute([$id]);
			return $stmt->fetch();
		}
		catch(PDOException $pdoEx) {
			echo $podEx;
			return null;
		}

	}

	public function store_access_right(int $user_id, string $key, string $value) {
		$statement = "INSERT INTO access_right (user_id, ar_key, ar_value)
			VALUES (:user,:key,:value)";

		$data = [
			'user' => $user_id,
			'key' => $key,
			'value' => $value
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

	public function retrieve_access_rights(int $user_id) {
		$statement = "SELECT ar_key, ar_value FROM access_right
			WHERE user_id = ?";

		$stmt = $this->conn->prepare($statement);

		try {
			$stmt->execute([$user_id]);
			return $stmt->fetchAll();
		}
		catch (PDOException $pdoEx) {
			return null;
		}
	}

	public function retrieve_access_right(int $user_id, string $key) {
		$statement = "SELECT ar_value FROM access_right
			WHERE user_id = :id AND ar_key = :key";

		$data = [
			'id' => $user_id,
			'key' => $key
		];

		$stmt = $this->conn->prepare($statement);

		try {
			$stmt->execute($data);
			return $stmt->fetch();
		}
		catch (PDOException $pdoEx) {
			return null;
		}
	}

	public function update_access_right(int $user_id, string $key, string $new_value) {
		$statement = "UPDATE access_right
			SET ar_value = :new_value
			WHERE user_id = :user_id AND ar_key = :key";

		$data = [
			'key' => $key,
			'new_value' => $new_value,
			'user_id' => $user_id
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

	public function update_password(int $id, string $new_password) {
		$statement = "UPDATE user
			SET pw_hash = :pwhash
			WHERE id = :id";

		$pwhash = password_hash($new_password, PASSWORD_DEFAULT, ["cost" => 15]);

		$data = [
			'pwhash' => $pwhash,
			'id' => $id
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

	public function update_email(int $id, string $new_email) {
		$statement = "UPDATE user
			SET email = :email
			WHERE id = :id";

		$data = [
			'email' => $new_email,
			'id' => $id
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

	public function update_displayname(int $id, string $new_displayname) {
		$statement = "UPDATE user
			SET display_name = :display_name
			WHERE id = :id";

		$data = [
			'display_name' => $new_displayname,
			'id' => $id
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

	public function store_tag(string $name) {
		$statement = "INSERT INTO tag (name)
			VALUES (?)";

		$stmt = $this->conn->prepare($statement);

		try {
			$stmt->execute([$name]);
		}
		catch (PDOException $pdoEx) {
			return false;
		}

		return true;
	}

	public function store_blog_tags(int $blog_id, int $tag_id) {
		$statement = "INSERT INTO blog_tag
			VALUES (:blog_id, :tag_id)";

		$data = [
			'blog_id' => $blog_id,
			'tag_id' => $tag_id
		];

		$stmt = $this->conn->prepare($statement);

		try {
			$stmt->execute($data);
		}
		catch (PDOException $pdoEx) {
			echo $pdoEx;
			return null;
		}
	}

	public function retrieve_blog_tags(int $blog_id) {
		$statement = "SELECT t.name FROM tag as t, blog_tag as bt
			WHERE bt.blog_id = ? AND bt.tag_id = t.id";

		$stmt = $this->conn->prepare($statement);

		try {
			$stmt->execute([$blog_id]);
			return $stmt->fetchAll();
		}
		catch (PDOException $pdoEx) {
			echo $pdoEx;
			return null;
		}
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
