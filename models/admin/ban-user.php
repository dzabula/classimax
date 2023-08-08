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
if(!isset($_POST['id']) || !isset($_POST['active'])){
    http_response_code(400);
    exit;
}
$id_user = (int)$_POST['id'];
$active = (int)$_POST['active'];

$message['text'] = BanReban($id_user,$active);

http_response_code(200);
echo json_encode($message);