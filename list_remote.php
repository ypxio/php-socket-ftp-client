<?php

// get the file list for /
$buff = ftp_rawlist($conn_id, '/');

// close the connection
ftp_close($conn_id);

foreach ($buff as $key => $value) {
	echo $value."\n";
}
?>