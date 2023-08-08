<?php session_start();
header('Content-Type: application/json; charset=utf-8');
if(!isset($_SESSION['user'])){
    http_response_code(400);
    echo json_encode("You must be loged in to save post in favorites!!!");
    exit;
}
require_once("../config/config.php");
require_once("connection.php");
require_once("function.php");

if(!isset($_POST['id'])){
    http_response_code(400);
    exit;
}


$id_post = (int)$_POST['id'];
$id_user = $_SESSION['user']->id;

$res = InsertDeleteFavorites($id_post,$id_user);

if($res){
    http_response_code(200);
    echo json_encode($res);
}else{
    http_response_code(500);
    echo json_encode($res);
}



?>