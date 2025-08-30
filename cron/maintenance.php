<?php
require '../connect.php';
if(function_exists('date_default_timezone_set')) date_default_timezone_set('Asia/Jakarta');
$date = date_create(date("Y-m-d").' 23:00:00');
$a = ''.date("Y-m-d").' 23:00:00';
date_add($date, date_interval_create_from_date_string('1 hours'));
$b = date_format($date, 'Y-m-d H:i:s');
$c = $a < $b;
if ($c == 1) {
    $up = $call->query("UPDATE conf SET code = 'webmt' WHERE c1 = 'true' AND c2 = 'true'");
    if ($up == TRUE) {
        echo "Berhasil mengubah status true pada web maintenance";
    } else {
        echo "Error Database";
    }
} else {
    $up = $call->query("UPDATE conf SET code = 'webmt' WHERE c1 = 'false' AND c2 = 'false'");
    if ($up == TRUE) {
        echo "Berhasil mengubah status false pada web maintenance";
    } else {
        echo "Error Database";
    }
}
?>