<?php

$buff = ftp_rawlist($conn_id, $current_dir);

foreach ($buff as $key => $value) {
	echo $value."\n";
}

?>
