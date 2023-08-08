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
if(!isset($_POST['prepaid']) || !isset($_POST['id'])){
    http_response_code(400);
    exit;
}

$prepaid = (float)$_POST['prepaid'];

$id_user = (int)$_POST['id'];


$res = AllowPrepaidRequest($id_user,$prepaid);

if($res){
    http_response_code(204);
    echo json_encode("Successful!");
    
}else http_response_code(500);



?>