<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<title>Personal Blog, Publish></title>

<head>
<body  class="bg-dark text-light">
	
	<style>
		/* html, body {
			background-color: black;
			color: white;
		} */
	</style>

	<form method="post" action="/upload" enctype="multipart/form-data">
		Upload File:
		<input type="file" name="new_file" id="fileToUpload">
		<input type="submit" name="submit" value="Publish"> 
	</form>

	<div class="text-center mt-5 input-group input-group-lg">
		<form style="max-width: 300px; margin: auto" method="post" action="/upload" enctype="multipart/form-data">
			<h1 class="mb-3 h1">Upload File:</h1>
			<input name="new_file" type="file" class="form-control bg-dark text-light"
				required id="fileToUpload" />
			<div class="mt-3 mb-1">
				<button id="btnSubmit" disabled style="min-width: 300px"
					type="submit" class="btn btn-outline-success btn-lg btn-block">Sign in</button>
			</div>
		</form>
	</div>

	<!-- Popper and Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>

<?php

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$upload_dir = "/uploads/";
		$allowedFileExt = ['txt', 'md'];
		
		$errors = [];

		var_dump($_FILES);

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
