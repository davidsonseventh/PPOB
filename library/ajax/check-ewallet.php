<?php 
require '../../RGShenn.php';
require _DIR_('library/session/session');

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if(!isset($_SESSION['user'])) exit('<div class="alert alert-danger text-left fade show" role="alert">No direct script access allowed!</div>');
    if(!isset($_POST['game'])) exit('<div class="alert alert-danger text-left fade show" role="alerta">No direct script access allowed!</div>');

if(!empty($_POST["data"])) {
    $id = $_POST['data'];
    $game = $_POST['game'];
    $games = "";
    if($game == "dana"){
        $games = "dana";
    } else if ($game == "go pay"){
        $games = "gopay";
    } else if ($game == "ovo"){
        $games = "ovo";
    } else if ($game == "shopee pay"){
        $games = "shopeepay";
    } else if ($game == "linkaja"){
        $games = "linkaja";
    }
                    
    $header = array(
        'Content-Type: application/json',
        );
            $url = "https://api-rekening.my.id/trueid/ewallet/$games/?hp=$id&key=83c8aae66f3c8ea";

   $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL             => $url,
            CURLOPT_POST            => false,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_HEADER          => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4,
        ));

    $result = curl_exec($ch);
                    
    $data = json_decode($result);
    $name = $data->name;
 if (!empty($name)){
    echo "  <div class='card'>
                <div class='card-body p-2'>
                    <h5>Atas Nama : </h5>
                    <h3><b>$name</b></h3>
                </div>
            </div>";
  } else {
    echo "<div class='alert alert-danger text-center fade show mr-2 ml-2 mt-2' role='alert'>Nomor Tidak Ditemukan Harap Periksa Kembali</div>";
  }
  } else {
    echo "<span></span>";
  }
} else {
	exit('<div class="alert alert-danger text-left fade show" role="alert">No direct script access allowed!</div>');
}