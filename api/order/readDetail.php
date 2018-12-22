<?php
header('Access-Controll-Allow-Origin: *');
header('Content-Type: application/json');
header('Acces-Control-Allow-Methods: POST');

include_once '../../config/Database.php';
include_once '../../models/Order.php';

//DB
$database = new Database();
$db = $database->connect();

$order = new Order($db);

//Get data from app
$data = json_decode(file_get_contents("php://input"));
//token
$order->token = $data->token;

if ($order->checkToken()) {

    //id
    $order->servisni_objednavka_id = $data->id;

    $result = $order->readDetail();
    $resultArray = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        $rowArray = array(
            'Datum' => $row['datum'],
            'Cena' => $row['cena'],
            'Popis' => $row['popis'],
            'Zasah' => $row['nazev'],
        );

        //Push
        array_push($resultArray, $rowArray);

    }

    //To Json
    echo json_encode($resultArray);
    http_response_code(200);
} else {
    http_response_code(403);
}