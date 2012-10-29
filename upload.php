<?php

$file = $value;

$fh = fopen($file, "r");

$ret = ftp_nb_fput($conn_id, $file, $fh, FTP_BINARY);

while ($ret == FTP_MOREDATA) {

    $current = ftell($fh);
    $ret = ftp_nb_continue($conn_id);
    show_status($current, filesize($file));
    usleep(100000);
}
if ($ret != FTP_FINISHED) {
    print ("error uploading\n");
    exit(1);
}

fclose($fh);

?>