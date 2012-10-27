<?php

// open some file for reading
$file = 'Survival.mp3';

$fp = fopen($file, 'w');

$ftp_server = "hmif.ub.ac.id";
$ftp_user_name = "hmif";
$ftp_user_pass = "EMIF2904";

$conn_id = ftp_connect($ftp_server);

$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// Initate the download
$ret = ftp_nb_fget($conn_id, $fp, $file, FTP_BINARY);
while ($ret == FTP_MOREDATA) {

   // Do whatever you want
   $current = ftell($fp);
   echo $current; 

   // Continue downloading...
   $ret = ftp_nb_continue($conn_id);
}
if ($ret != FTP_FINISHED) {
   echo "There was an error downloading the file...";
   exit(1);
}

// close filepointer
fclose($fp);
?>