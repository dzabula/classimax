<?php
session_start();

header('Content-Type: application/json; charset=utf-8');

require_once("../../config/config.php");
require_once("../connection.php");
require_once("../function.php");
require_once("function.php");

if(!isset($_SESSION['user'])){
    http_response_code(401);
    exit;
}
if($_SESSION['user']->role != "admin"){
    http_response_code(401);
    exit;
}
if(!isset($_POST['duration']) || !isset($_POST['id']) || !isset($_POST['price'])){
    http_response_code(400);
    exit;
}

$id =(int)$_POST['id'];
$duration =(int)$_POST['duration'];
$price =(float)$_POST['price'];

if($price < 100 || $duration > 100 || $duration < 1){
    http_response_code(400);
    echo json_encode("Wrong params!");
    exit;
}

$res = UpdatePromotion($id,$duration,$price);


if($res){
    http_response_code(203);
    echo json_encode("Successful");
    

}else http_response_code(500);