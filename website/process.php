<?php
if(isset($_POST['file'])){
    $file = $_REQUEST['file'];


}


function sendToDiscord($msg, $webhook){
    $url = $webhook;
    $headers = ['Content-Type: application/json; charset=utf-8'];
    $embed = [
        'description' => $msg
    ];

    $embeds = [$embed];

    $POST = ['embeds' => $embeds];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
    $response   = curl_exec($ch);
    sleep(1);
}

?>