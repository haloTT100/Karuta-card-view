<?php

    session_start();
    if(!isset($_SESSION['username'])) header('Location: /login');


include "database.php";
include "config.php";
ini_set('max_execution_time', '300');


if(isset($_POST['upload'])){
    $data = readCSV();
    removeBurnedCards($data);
    $data = removeExitsCodes($data);
    saveCards($data);
    //debugData($data);
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


function saveCards($data){
    
    $conn = new kapcsolat();

    $botCounter = 1;
    for ($i = 0; $i < count($data);$i++) {
        $conn->saveCard($data[$i], $botCounter);
        $botCounter++;
        if($botCounter > count($hooks)){
            $botCounter = 1;
        }
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
        if(!$conn->isCodeExits($data[$i][0], $data[$i][5]) && $data[$i][0] !== ''){
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



?>

