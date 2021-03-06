<?php

namespace Modules\Upload;

require '/var/php/config/config.php';
require PHP_MODULES.'Session/session.php';
require PHP_MODULES.'Database/DatabaseHandler.php';

use Modules\Database\DatabaseHandler;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$errors = [];
	
	$answer = array(
		'success' => false,
		'messages' => array(),
	);

	if (!isset($_SESSION['accname'])) {
		$errors[] = "User is not logged in.";
	}
	
	$upload_dir = "/uploads/" . $_SESSION['accname'] . '/';
	$allowedFileExt = ['txt', 'md'];
	
	// Get file information
	$fileName = $_FILES['new_file']['name'];
	$fileSize = $_FILES['new_file']['size'];
	$fileTmpName = $_FILES['new_file']['tmp_name'];
	$fileType = $_FILES['new_file']['type'];
	$fileExt = strtolower(end(explode('.', $fileName))); // gets the file extension
		
	$target_file = $upload_dir . uniqid() . basename($fileName);
	
	if (!in_array($fileExt, $allowedFileExt)) {
		$errors[] = "File Extension not allowed. Please upload a Text or Markdown file.";
	}
	
	if ($fileSize > 5242880) {
		$errors[] = "File exceeds maximum size (5MiB).";
	}

	$mimeType = mime_content_type($fileTmpName);
	if ("text/plain" !== $mimeType) {
		$errors[] = "Mime type '" . $mimeType . "' disallowed.";
	}
	
	// file_exists works on Linux since everything is a file, even directories. For windows
	// additionally is_dir should be checked too.
	if (!file_exists($upload_dir) || !is_dir($upload_dir)) {
		/* File (directory) permissions: 0664
			* 0 -> no special settings
			* 6 -> owning user can read + write (4 = read, 2 = write)
			* 6 -> owning group can read + write
			* 4 -> All others can only read
			*/
		if (!mkdir($upload_dir , 0775)) {
			$errors[] = "Upload directory doesn't exist and couldn't be created.";
		}
	}
	
	if (empty($errors)) {
		$uploadSuccess = false;
	
		// Move file from temporary upload location to target location
		if (move_uploaded_file($fileTmpName, $target_file)) {
			$db = new DatabaseHandler();
	
			// store blog meta data in db
			$result = $db->store_blog($_SESSION['userid'], $_POST['title'], $target_file, $_POST['description']);
			$uploadSuccess = $result->success;
			$blog_id = $result->last_id;

			if ($uploadSuccess) {
				// store new and retrieve existing blog tags in/from db
				$tags = $_POST['tags'];
				$tags = explode(' ', $tags);
				foreach ($tags as &$tag) {
					if (substr($tag, 0, 1) !== '#') {
						$tag = '#' . $tag;
					}

					$tag_id = NULL;
					$tag_exist = $db->retrieve_tag_by_name($tag);
					if (NULL == $tag_exist) {
						$result = $db->store_tag($tag);
						$tag_id = $result->last_id;
					}
					else {
						$tag_id = $tag_exist['id'];
					}

					$db->store_blog_tags($blog_id, $tag_id);
				}
			}
		}
	
		if ($uploadSuccess) {
			$answer['success'] = true;
			$answer['messages'] = ["Successfully uploaded " . basename($fileName) . "."];
		}
		else {
			$answer['messages'] = ["Failed to upload post."];
		}
	}
	else {
		$answer['messages'] = $errors;
	}

	$json = json_encode($answer);
	echo $json;
}

?>
