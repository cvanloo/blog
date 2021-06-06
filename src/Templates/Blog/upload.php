<!DOCTYPE html>
<html>

	<title>Blog, Publish</title>

	<style>
		html, body {
			background-color: black;
			color: white;
		}
	</style>

<body>

	<form method="post" action="/upload" enctype="mulitpart/form-data">
		Upload File:
		<input type="file" name="new_file" id="fileToUpload">
		<input type="submit" name="submit" value="Publish"> 
	</form>

</body>
</html>

<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$upload_dir = "/uploads/";
		$allowedFileExt = ['txt', 'md'];
		
		$errors = [];

		var_dump($_FILES);
		exit();

		$fileName = $_FILES['new_file']['name'];
		$fileSize = $_FILES['new_file']['size'];
		$fileTmpName = $_FILES['new_file']['tmp_name'];
		$fileType = $_FILES['new_file']['type'];
		$fileExt = strtolower(end(explode('.', $fileName)));
		
		$target_file = $upload_dir . basename($fileName);
		
		if (isset($_POST['submit'])) {
			if (!in_array($fileExt, $allowedFileExt)) {
				$errors[] = "File Extension not allowed. Please upload a Text or Markdown file";
			}
		
			if ($fileSize > 5242880) {
				$errors[] = "File exceeds maximum size (5MiB)";
			}
		
			if (empty($errors)) {
				$uploadSuccess = move_uploaded_file($fileTmpName, $target_file);
		
				if ($uploadSuccess) {
					echo "Successfully uploaded " . basename($fileName);
				}
				else {
					echo "An error occured.";
				}
			}
			else {
				foreach ($errors as $error) {
					echo $error . "\n";
				}
			}
		}
	}

?>
