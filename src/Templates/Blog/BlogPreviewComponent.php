<!-- Blog Preview Component -->
<a href="<?php echo '/' . '@' . $user['account_name'] . '/' . $blog['title']; ?>"
	style="text-decoration: none; color: white;">
<div class="p-4 border" style="overflow: hidden;">
	<p>
		<?php

		if ($blog !== null) {
			/*require_once PHP_VENDOR.'erusev/parsedown/Parsedown.php';

			$md = file_get_contents($blog['content_path']);
	
			$MDParser = new \Parsedown();

			echo $MDParser->text($md);*/

			$title = $blog['title'];
			$desc = $blog['description'];
			$tags_str = "";



			foreach ($tags as $tag) {
				$tags_str .= $tag['name'] . ", ";
			}

			echo <<< EOF
			<p>{$user['display_name']}, {$blog['create_datetime']}</p>
			<h3>$title</h3>
			<p>$desc</p>
			<p>Tags: $tags_str</p>
			EOF;
		}

		?>
	</p>
</div>
</a>
