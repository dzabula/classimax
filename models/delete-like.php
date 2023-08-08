<?php
session_start();

header('Content-Type: application/json; charset=utf-8');

if(!isset($_SESSION['user'])){
    http_response_code(400);
    exit;
}
require_once("../config/config.php");
require_once("connection.php");
require_once("function.php");

if(!isset($_POST['id-whom'])){
    http_response_code(400);
    exit;
}

$id_whom = (int)$_POST['id-whom'];
$id_who = $_SESSION['user']->id;

$res = DeleteLike($id_whom,$id_who);

if($res){
    http_response_code(204);
    echo json_encode(true);
}else{
    http_response_code(500);
}



?>