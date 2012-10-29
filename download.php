<?php

$file = $value;

$fp = fopen($file, 'w');							

$ret = ftp_nb_fget($conn_id, $fp, $file, FTP_BINARY);

$filesize = ftp_size($conn_id, $file);
while ($ret == FTP_MOREDATA) {

	$current = ftell($fp);
	$ret = ftp_nb_continue($conn_id);
	show_status($current, $filesize);
	usleep(100000);
}
if ($ret != FTP_FINISHED) {
	echo "There was an error downloading the file...";
	exit(1);
}

fclose($fp);

?>