<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

	<!-- AJAX JQuery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<title>Personal Blog, Publish</title>

<head>
<body  class="bg-dark text-light">
	
	<style>
		.no-border-top {
			border-top: 0px;
			border-top-left-radius: 0px;
			border-top-right-radius: 0px;
		}

		.no-border {
			border-radius: 0px;
		}

		.no-border-bottom {
			border-bottom: 0px;
			border-bottom-left-radius: 0px;
			border-bottom-right-radius: 0px;
		}

		.bigger {
			min-height: 50px;
		}
	</style>

	<?php include_once PHP_TEMPLATES.'Blog/NavbarComponent.php'; ?>

	<div class="text-center mt-5 input-group input-group-lg">
		<form id="upForm" style="max-width: 300px; margin: auto" method="post" enctype="multipart/form-data">
			<h1 class="mb-3 h1">Upload File:</h1>
			<input name="new_file" type="file" class="form-control bg-dark text-light no-border-bottom"
				required id="fileToUpload" />
			<input name="title" type="text" class="form-control bg-dark text-light bigger no-border"
				required id="title" placeholder="Title" />
			<input name="description" type="text" class="form-control bg-dark text-light bigger no-border-top"
				id="description" placeholder="Description (Optional)" />
			<div class="mt-3 mb-1">
				<button id="btnSubmit" style="min-width: 300px" type="submit"
					class="btn btn-outline-success btn-lg btn-block">Publish</button>
			</div>

			<p class="answer"></p>
		</form>
	</div>

	<!-- Popper and Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>

<script>
$(function() {
	$('#upForm').submit(function(e) {
		$.ajax({
			method: "POST",
			url: "/upload.php",
			data: new FormData(this),
			processData: false,
			contentType: false,
			//dataType: 'json',
			async: 'false'
		})
			.done(function(response) {
				answer = JSON.parse(response);
				messages = answer['messages'];
				$('p.answer').empty();

				for (i in messages) {
					$('p.answer').append(messages[i] + "<br>");
				}

				console.log(answer);	
				if (answer['success']) {
					window.location = "/";
				}
			});
		e.preventDefault()
	});
});
</script>
