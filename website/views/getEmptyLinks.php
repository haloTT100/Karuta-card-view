<?php


include "database.php";
include "config.php";
ini_set('max_execution_time', '300');


if(isset($_POST['b'])){
    $botNum = $_REQUEST['b'];

    //CSOMAGOLÁS
    $pack = getPack($botNum);



    if($pack != ''){
        sendToDiscord($pack, $hooks[$botNum-1]);
        sleep(1);
        sendToDiscordEndMessage('Embeds sent! Bot:'.$botNum.'', "https://discord.com/api/webhooks/1181230412735979623/RPbzoIoglGEwJ-n73iV0sTQjlgJFAY5YlOGfjmkcE5liU7QE9YM3eO7I5AhSopDhgkbT");
    }
    print("Okés");
}

function getPack($bn){


    $conn = new kapcsolat();
    $cards = $conn->getEmptyLinks($bn);
    //$conn->clearInvalid();

    $codeArray = "";
    foreach($cards as $card){
        $codeArray = $codeArray.$card['code'].';';
    }

    $codeArray = substr($codeArray, 0, -1);
    

    
    return $codeArray;
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

function sendToDiscordEndMessage($msg, $webhook){
    $url = $webhook;
    $headers = ['Content-Type: application/json; charset=utf-8'];


    $POST = ['content' => $msg];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
    $response   = curl_exec($ch);
}
?>