<?php

	require PHP_VENDOR.'erusev/parsedown/Parsedown.php';

	$MDParser = new \Parsedown();

	echo $MDParser->text('# Hello _Parsedown_!');

?>
