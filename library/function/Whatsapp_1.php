 <?php
class Whatsapp
{

    public $base_url = 'https://wa.botgateway.my.id/'; // masukan link


    private function connect($x, $n = '')
    { 
   
       $curl = curl_init(); 
         curl_setopt($curl, CURLOPT_URL , $this->base_url . $n);
         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); 
         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($curl, CURLOPT_ENCODING, "");
         curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
         curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
         curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
         curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($x));    
        $response = curl_exec($curl);
        curl_close($curl); 
        
    }

    public function sendMessage($phone, $msg)
    {
        return $this->connect([
            'api_key' => conf('webmt',2),
            'sender' => conf('webmt',3),
            'number' => $phone,
            'message' => $msg 
            ] , 'send-message');
    }

    public function sendPicture($phone, $caption, $url, $filetype)
    {
        return $this->connect([
            'api_key' => conf('webmt',2),
            'sender' => conf('webmt',3),
            'number' => $phone,
            'message' => $caption,
            'url' => $url
        ], 'send-media');
    }

    public function sendDocument($phone, $filetype, $filename, $url )
    {
        return $this->connect([

            'number' => $phone,
            'filetype' => $filetype,
            'filename' => $filename,
            'url' => $url
        ], 'send-media');
    }

    public function sendAudio($phone, $voice, $url, $filetype)
    {
        return $this->connect([

            'number' => $phone,
            'filetype' => $filetype,
            'voice' => $voice,
            'url' => $url
        ], 'send-media');
    }
}