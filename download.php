<?php
	$f = $_GET["f"];
	echo "$f";
	$file = ("htdocs/$f");

	$filetype = filetype($filetype);

	$filename = basename($file);

	header("Content-Type: " .$filetype);

	header("Content-Length: " .filesize($file));

	header("Content-Disposition: attachment; filename=" .$filename);

	readfile($file);
?>