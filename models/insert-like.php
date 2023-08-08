<?php
session_start();


header('Content-Type: application/json; charset=utf-8');

if(!isset($_SESSION['user'])){
    http_response_code(400);
    echo json_encode("You must be loged in!!!");
    exit;
}
require_once("../config/config.php");
require_once("connection.php");
require_once("function.php");

$text = $_POST['text'];
$stars = $_POST['stars'];

$stars = (int)$stars;
if($stars > 5 || $stars < 0){
    http_response_code(400);
}
$text = addslashes($text);

$id_whom = (int)$_POST['id'];

$id_user = $_SESSION['user']->id;

if($id_whom == $id_user){
    echo json_encode("You cannot give yourself a review !!!");
    http_response_code(400);
    exit;
}


$ver = VerificationLike($id_user,$id_whom);



if($ver >= 1){
    
    echo json_encode("You cannot give two ratings on the same seller!!!");
    http_response_code(400);
    exit;
}

$res = InsertLike($id_user,$id_whom,$text,$stars);

if($res){
    http_response_code(204);
    echo json_encode($res);
}else http_response_code(500);






?>