<?php

session_start();
if(!isset($_SESSION['username'])) header('Location: /login');


include "database.php";
ini_set('max_execution_time', '300');
$hooks = array("https://discord.com/api/webhooks/1181330916736520253/M5_1FyabUf6VKftE2Oi4jWIVhadaLoKu7Ca2OjXhM1pIMQGdklXDjWYedrSwmpdXt_tH", //message-loader
"https://discord.com/api/webhooks/1181694812336959518/PrPadO8RrfVsss2f-7Cz-teskMLJaR3SlBvI-yVadNIO8gjXrVaz5GQTgvk2h-W4Lshn",                //message-loader2
"https://discord.com/api/webhooks/1181968319092359248/qa2qe1ujJ0Wj1LRcZa8GUi6u_jCSBz3QfpCnbnVQn1gdvrLnba6yvLpTopLMSxSZJdLi",                //message-loader3
"https://discord.com/api/webhooks/1181968367612084305/TiMVL2UXFB4LC9Fv-oUgOkB8SSeBulrJAtVs2KlvyLzbH3EjkxP-n5CIcIyJqET7poM5");               //message-loader4


if(isset($_POST['upload'])){
    $data = readCSV();
    removeBurnedCards($data);
    $data = removeExitsCodes($data);
    saveCards($data);
    //debugData($data);
    
    //CSOMAGOLÁS
    $packs = getPacks($hooks);
    
    $botCounter = 0;
    $packCounter= 0;

    foreach($packs as $p){
        $packCounter++;
        if($botCounter > count($hooks)-1){
            $botCounter = 0;
        }
        //sendToDiscord($p, $hooks[$botCounter]);
        //echo $p;
        sleep(1); //Ez csak debug ki kell szedni prodba
        echo '<script>draw('.((count($packs)/$packCounter)*100).');</script>';
        $botCounter++;
    }
    //sendToDiscordEndMessage('Embeds sent!', "https://discord.com/api/webhooks/1181230412735979623/RPbzoIoglGEwJ-n73iV0sTQjlgJFAY5YlOGfjmkcE5liU7QE9YM3eO7I5AhSopDhgkbT");
    header('Location: /?uploadSuccess');
}

function removeBurnedCards($data){
    $conn = new kapcsolat();
    $oldData = $conn->getAllCardsByUserID();
    $codes = array();
    foreach($oldData as $d){
        array_push($codes, $d["code"]);
    }


    for($i = 0; $i < count($codes); $i++){
        foreach($data as $d){
            if($d[0] == $codes[$i]) $codes[$i] = "";
        }
    }

    foreach($codes as $c){
        $conn->deleteLink($c);
    }

}

function getPacks($hooks){
   
    $botPacks = array();

    $conn = new kapcsolat();
    $cards = $conn->getEmptyLinks();

    $codeArray = array();
    foreach($cards as $card){
        array_push($codeArray, $card['code']);
    }

    
    $cardsCount = $cards->num_rows;
    $hookCount = count($hooks);

    $packs = array();
    $counter = 0;
    $packCounter = 0;
    $pack = "";

    $packSize = 100;
    if($packSize > $cardsCount){
        $packSize = $cardsCount/2;
    }

    foreach($codeArray as $code){
        
        if($counter >= $packSize-1){
            $pack = $pack . $code . ";";
            $counter=0;
            $pack = substr($pack, 0, -1);
            array_push($packs, $pack);
            $pack = "";
        }else{
            $counter++;
            $pack = $pack . $code . ";";
        }
        
    }
    $pack = substr($pack, 0, -1);
    array_push($packs, $pack);
    

    
    return $packs;
}

function saveCards($data){
    
    $conn = new kapcsolat();
    for ($i = 0; $i < count($data);$i++) {
        $conn->saveCard($data[$i]);
    }
    
}

function debugData($data){
    print("<pre>");
    print_r($data);
    print("</pre>");
}

function removeExitsCodes($data){
    $newData = array();
    $conn = new kapcsolat();
    for($i = 1; $i < count($data); $i++){
        if(!$conn->isCodeExits($data[$i][0]) && $data[$i][0] !== ''){
            $newCard = array();
            array_push($newCard, 
            $data[$i][0], //code 0 
            $data[$i][1], //number 1
            $data[$i][2], //edition 2
            $data[$i][3], //char_name 3
            $data[$i][4], //series 4
            $data[$i][5], //quality 5
            $data[$i][11], //frame 6
            $data[$i][16], //wishlists 7
            $data[$i][22] //effort 8
        );
            array_push($newData, $newCard);
        }
    }
    
    return $newData;
}

function readCSV(){

    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == UPLOAD_ERR_OK) {
        // Áthelyezzük a feltöltött fájlt egy ideiglenes mappába
        $tmpFile = $_FILES["file"]["tmp_name"];

        // Nyissa meg a fájlt olvasásra
        $file = fopen($tmpFile, 'r');

        // Ellenőrizze, hogy a fájl megnyitása sikeres volt-e
        if ($file === false) {
            die("A fájl megnyitása sikertelen");
        }

        // Tömb az adatok tárolására
        $data = [];

        // Olvassa be a fájl tartalmát, és tárolja az adatokat a $data tömbben
        while (($row = fgetcsv($file)) !== false) {
            $data[] = $row;
        }

        // Zárja be a fájlt
        fclose($file);

        // Kiírja az adatokat a képernyőre (ez csak a példa kedvéért)
        return $data;
    } else {
        die("Hiba a fájl feltöltésekor");
    }

}

function sendToDiscord($msg, $webhook){
    //$url = $webhook;
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

