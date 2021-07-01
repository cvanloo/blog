<?php

$comment_id = $comment['id'];
$parent_id = $comment['parent_id'];
$parent_text = "none";

if (NULL !== $parent_id) {
	$parent_text = $db->retrieve_comment($parent_id)['content'];
}

$user = $db->retrieve_user_by_id($comment['creator_id']);
$display_name = $user['display_name'];
$account_name = $user['account_name'];
$time = $comment['create_datetime'];
$content = $comment['content'];

echo <<< EOL
<span>
	<h6 style="margin-bottom: -20px; color: gray;">answer to: $parent_text</h6><br>
	<h6>
		<a href="/@$account_name">$display_name</a>
		$time
		<button onclick="show_answer('answer-box-$comment_id')" style="max-width: 70px;">Answer</button><br>
		$content
	</h6>
	<div id="answer-box-$comment_id" style="display: none">
		<form class="p-2 border border-success border-2" method="post" action="$uri">
			<input type="text" name="comment" placeholder="Write a comment" />
			<input type="submit" name="submit" value="Comment" />
			<input type="text" name="parent_comment" value="$comment_id" style="display: none;"/>
		</form>
	</div>
</span>
EOL;

?>

<script>
	function show_answer(el) {
		var answer_div = document.getElementById(el);
		if ('none' == answer_div.style.display) {
			answer_div.style.display = 'block';
		}
		else {
			answer_div.style.display = 'none';
		}
	}
</script>

<!--

Username, Time Date
-------------------
Comment

Answer-Btn
[Answer-Box]

-->
