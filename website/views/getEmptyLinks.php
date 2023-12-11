<?php


include "database.php";
ini_set('max_execution_time', '300');
$hooks = array("https://discord.com/api/webhooks/1181330916736520253/M5_1FyabUf6VKftE2Oi4jWIVhadaLoKu7Ca2OjXhM1pIMQGdklXDjWYedrSwmpdXt_tH",                 //message-loader
                "https://discord.com/api/webhooks/1181694812336959518/PrPadO8RrfVsss2f-7Cz-teskMLJaR3SlBvI-yVadNIO8gjXrVaz5GQTgvk2h-W4Lshn",                //message-loader2
                "https://discord.com/api/webhooks/1181968319092359248/qa2qe1ujJ0Wj1LRcZa8GUi6u_jCSBz3QfpCnbnVQn1gdvrLnba6yvLpTopLMSxSZJdLi",                //message-loader3
                "https://discord.com/api/webhooks/1181968367612084305/TiMVL2UXFB4LC9Fv-oUgOkB8SSeBulrJAtVs2KlvyLzbH3EjkxP-n5CIcIyJqET7poM5");               //message-loader4


if(isset($_POST['b'])){
    $botNum = $_REQUEST['b'];

    //CSOMAGOLÁS
    $pack = getPack();



    if($pack != ''){
        sendToDiscord($pack, $hooks[$botNum-1]);
        sleep(1);
        sendToDiscordEndMessage('Embeds sent! Bot:'.$botNum.'', "https://discord.com/api/webhooks/1181230412735979623/RPbzoIoglGEwJ-n73iV0sTQjlgJFAY5YlOGfjmkcE5liU7QE9YM3eO7I5AhSopDhgkbT");
    }
    print("Okés");
}

function getPack(){


    $conn = new kapcsolat();
    $cards = $conn->getEmptyLinks();

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