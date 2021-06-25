<?php

	require PHP_VENDOR.'erusev/parsedown/Parsedown.php';

	$MDParser = new \Parsedown();
	$MDParser->setSafeMode(true);

	echo $MDParser->text("# Hello _Parsedown_!\n* How are you?");

?>
