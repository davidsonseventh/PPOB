<?php 
require '../../RGShenn.php';
header('Content-Type: application/vnd.api+json');
require _DIR_('library/session/session');

function err($x,$y,$z = null) {
    if($x == true) {
        return json_encode(['result' => true,'data' => $y,'target' => $z]);
    } else {
        return json_encode(['result' => false,'message' => $y]);
    }
}
$key = '83c8aae66f3c8ea';

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' && isset($data_user)) {
    if(!isset($_POST['target']) || !isset($_POST['category'])) exit(err(false,'No direct script access allowed!'));
    
    $c = isset($_POST['category']) ? strtoupper(filter($_POST['category'])) : '';
    $id = isset($_POST['target']) ? filter($_POST['target']) : '';
    $id2 = isset($_POST['target2']) ? filter($_POST['target2']) : '';
            
     if($c == 'MOBILE LEGEND') {
        $url = 'https://api-rekening.my.id/trueid/game/mobilelegends/?id='.$id.'&server='.$id2.'&key='.$key;
    } else if ($c == 'FREE FIRE') {
        $url = 'https://api-rekening.my.id/trueid/game/freefire/?id='.$id.'&key='.$key;
    } else if ($c == 'CALL OF DUTY MOBILE') {
        $url = 'https://api-rekening.my.id/trueid/game/callofduty/?id='.$id.'&key='.$key;
    } else if ($c == 'HAGO') {
        $url = 'https://api-rekening.my.id/trueid/game/hago/?id='.$id.'&key='.$key;
    } else if ($c == 'SAUSAGE MAN') {
        $url = 'https://api-rekening.my.id/trueid/game/sausageman/?id='.$id.'&key='.$key;
    } else if ($c == 'POINT BLANK') {
        $url = 'https://api-rekening.my.id/trueid/game/pointblank/?id='.$id.'&key='.$key;
    } else if ($c == 'ARENA OF VALOR') {
        $url = 'https://api-rekening.my.id/trueid/game/aov/?id='.$id.'&key='.$key;
    } 
    
    //else if($c == 'RAGNAROK M: ETERNAL LOVE')  
    //else if($c == 'FREE FIRE')              
    //else if($c == 'ARENA OF VALOR')         
    //else if($c == 'CALL OF DUTY MOBILE')    
    //else if($c == 'PUBG MOBILE')            
    //else if($c == 'LAPLACE M')              
    //else if($c == 'SPEED DRIFTERS')         
    //else if($c == 'LIFEAFTER CREDITS')      
    //else if($c == 'HAGO')                   
    //else if($c == 'VALORANT')               
    
    else exit(err(false,'The game is not registered, please contact the developer!'));
    $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        $result = json_decode($response, true);
        curl_close($curl);
    
    if ($c == 'PUBG MOBILE') {
            if(isset($result['data']['attributes']['id'])) {
                exit(err(true,$result['data']['attributes']['name'],$id));
            } else {
                exit(err(false,'Player not found!'));
            }
    } else {
    if(isset($result['result'])) {
        if($result['result']['status'] == '200') {
            if(isset($result['nickname'])) {
                exit(err(true,$result['nickname'],$id.'='.$id2));
            } else {
                exit(err(false,'Player not found!'));
            }
        } else {
            exit(err(false,'Data not Found!'));
        }
    } else {
        exit(err(false,'Connection Failed!'));
    }
}
} else {
	exit(err(false,'No direct script access allowed!'));
}