<?php
header('Access-Controll-Allow-Origin: *');
header('Content-Type: application/json');
header('Acces-Control-Allow-Methods: POST');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers,
Content-Type, Acces-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/User.php';

//DB
$database = new Database();
$db = $database->connect();

$user = new User($db);

//Get data from app
$data = json_decode(file_get_contents("php://input"));

$user->email = $data->email;
$user->heslo = md5($data->heslo);
$user->token = $data->token;
//User login check
if ($user->login()) {

    if ($user->token != "") { //empty ?
       if($user->tokenExpire($user->token)){
            echo json_encode(array('message' => 'OK'));
       }else{
            //create
       }
    } else {
            //create
    }

} else {
    echo json_encode(array('message' => 'Špatné jméno nebo heslo'));
}