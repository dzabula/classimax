<?php
header('Content-Type: application/json; charset=utf-8');
session_start();



require_once("../config/config.php");
require_once("connection.php");
require_once("function.php");

if(!isset($_SESSION['user'])){
    http_response_code(401);
    exit;
}
if(!isset($_POST['prepaid'])){
    http_response_code(400);
    exit;
}

$prepaid = (float)$_POST['prepaid'];
$id = $_SESSION['user']->id;


$exist = GetPrepaidRequest($id);

if($exist){
    http_response_code(401);
    echo json_encode("You have already sent request");
    exit;
}
try{
    
$f = fopen("../config/request_prepaid.txt","a+");

$str = "id=".$id."/prepaid=".$prepaid."/send=".date("Y-m-d")."\n";

fwrite($f,$str);

fclose($f);

    http_response_code(204);
    echo json_encode("Request are sent successfully");
    exit;
}
catch(Exception $e){
    http_response_code(500);
    echo json_encode("Somethings go wrong");
    exit;
}




?>