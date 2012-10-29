<?php

$dir	= '/var/www/learn/socket/ftp';
$buff 	= scandir($dir);

foreach ($buff as $key => $value) {
	echo $value."\n";
}

?>