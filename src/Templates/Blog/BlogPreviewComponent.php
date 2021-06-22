<!-- Blog Preview Component -->
<a href="<?php echo '/' . '@' . $user_name . '/' . $blog['title']; ?>"
	style="text-decoration: none; color: white;">
<div class="p-5 border">
	<p>
		<?php

		if ($blog !== null) {
			/*require_once PHP_VENDOR.'erusev/parsedown/Parsedown.php';

			$md = file_get_contents($blog['content_path']);
	
			$MDParser = new \Parsedown();

			echo $MDParser->text($md);*/

			$title = $blog['title'];
			$desc = $blog['description'];
			echo "<h3>$title</h3>";
			echo "<p>$desc</p>";
		}

		?>
	</p>
</div>
</a>
