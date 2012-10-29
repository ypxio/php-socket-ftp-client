<?php


function show_status($done, $total, $size=50) {

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

function get_password($prompt)
{
   $ostty = `stty -g`;
   system(
           "stty -echo -icanon min 1 time 0 2>/dev/null || " .
           "stty -echo cbreak"
           );

   echo "$prompt: ";

   // Get rid of newline when reading stdin
   $r = substr(fgets(STDIN), 0, -1);

   echo "\n";
   system ("stty $ostty");

   return $r;
}