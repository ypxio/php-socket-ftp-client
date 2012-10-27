<?php

$file = 'Survival.mp3';

$ftp_server = "hmif.ub.ac.id";
$ftp_user_name = "hmif";
$ftp_user_pass = "EMIF2904";

$conn_id = ftp_connect($ftp_server);

$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

$fh = fopen($file, "r");
    
    $ret = ftp_nb_fput($conn_id, $file, $fh, FTP_BINARY);
    while ($ret == FTP_MOREDATA) {
        $current = ftell($fh);
        $ret = ftp_nb_continue($conn_id);
        // ob_clean();
        // echo $current;
        show_status($current, filesize($file));
        // usleep(100000);
    }
    if ($ret != FTP_FINISHED) {
        print ("error uploading\n");
        exit(1);
    }
    fclose($fh);
    

// for($i=0;$i<100000;$i++)
// {
// 	echo $i;
// 	// show_status($i, 100000);
// 	usleep(100000);
// }

function show_status($done, $total, $size=30) {

    static $start_time;

    // if we go over our bound, just ignore it
    if($done > $total) return;

    if(empty($start_time)) $start_time=time();
    $now = time();

    $perc=(double)($done/$total);

    $bar=floor($perc*$size);

    $status_bar="\r[";
    $status_bar.=str_repeat("=", $bar);
    if($bar<$size){
        $status_bar.=">";
        $status_bar.=str_repeat(" ", $size-$bar);
    } else {
        $status_bar.="=";
    }

    $disp=number_format($perc*100, 0);

    $status_bar.="] $disp%  $done/$total";

    $rate = ($now-$start_time)/$done;
    $left = $total - $done;
    $eta = round($rate * $left, 2);

    $elapsed = $now - $start_time;

    $status_bar.= " remaining: ".number_format($eta)." sec.  elapsed: ".number_format($elapsed)." sec.";

    echo "$status_bar  ";

    flush();

    // when done, send a newline
    if($done == $total) {
        echo "\n";
    }

}
?>