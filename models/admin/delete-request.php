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

$id_user = (int)$_POST['id'];
DeletePrepaidRequest($id_user);

http_response_code(204);
echo json_encode("Request are denciled");


