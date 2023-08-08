<?php session_start();
header('Content-Type: application/json; charset=utf-8');




require_once("../config/config.php");
require_once("connection.php");
require_once("function.php");

if(!isset($_SESSION['user'])){
    http_response_code(401);
    exit;
}
if(!isset($_POST['id'])){
    http_response_code(401);
    exit;
}

$verification = PhoneIsUsers($_SESSION['user']->id,(int)$_POST['id']);

if($verification){

    $res = DeletePhone($_POST['id']);

    if($res){
        $id = [
            "id" => $_POST['id']
        ];
        http_response_code(200);
        echo json_encode($id);
        
        


    }
    else http_response_code(500);

}
else http_response_code(400);

