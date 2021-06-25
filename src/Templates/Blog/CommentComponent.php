<?php

$user = $db->retrieve_user_by_id($comment['creator_id'])['display_name'];
$time = $comment['create_datetime'];
$content = $comment['content'];

echo "<span><h6><a href=\"/@$user\">$user</a> $time<br>$content</h6></span>";

?>

<button style="max-width: 60px;">Answer</button>

<!--

Username, Time Date
-------------------
Comment

Answer-Btn
[Answer-Box]

-->