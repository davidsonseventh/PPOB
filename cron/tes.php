<?php
if(function_exists('date_default_timezone_set')) date_default_timezone_set('Asia/Jakarta');
//$datetime = date("Y-m-d H:i:s");
$date = date_create(date("Y-m-d").' 23:00:00');
//echo 'Waktu awal: '.date("Y-m-d").' 23:00:00<br/>';
date_add($date, date_interval_create_from_date_string('1 hours'));
//echo 'Kurangi 2 jam: '.date_format($date, 'Y-m-d H:i:s').'<br/><br/>';
/*if ($date >= $akhir) {
    echo "TRUE";
} else {
    echo "FALSE";
}*/

$a = ''.date("Y-m-d").' 23:00:00';
$b = date_format($date, 'Y-m-d H:i:s');

// menggunakan operator relasi lebih besar
$c = $a > $b;
echo "$a > $b: $c";
echo "<hr>";

// menggunakan operator relasi lebih kecil
$c = $a < $b;
echo "$a < $b: $c";
echo "<hr>";

// menggunakan operator relasi lebih sama dengan
$c = $a == $b;
echo "$a == $b: $c";
echo "<hr>";

// menggunakan operator relasi lebih tidak sama dengan
$c = $a != $b;
echo "$a != $b: $c";
echo "<hr>";

// menggunakan operator relasi lebih besar sama dengan
$c = $a >= $b;
echo "$a >= $b: $c";
echo "<hr>";

// menggunakan operator relasi lebih kecil sama dengan
$c = $a <= $b;
echo "$a <= $b: $c";
echo "<hr>";
?>