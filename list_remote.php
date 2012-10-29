<?php

$buff = ftp_rawlist($conn_id, '/');

foreach ($buff as $key => $value) {
	echo $value."\n";
}

?>