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

$limit = (int)$_GET['limit'];

$arr = GetAllRequest($limit);

for($i =0 ; $i < count($arr);  $i++){

    $x = GetUserForId($arr[$i]['id']);
    $x->prepaid = $arr[$i]['prepaid'];
    $x->send = $arr[$i]['send'];

    $arr[$i] = $x;
}

http_response_code(200);
echo json_encode($arr);