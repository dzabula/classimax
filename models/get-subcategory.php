<?php
session_start();
header('Content-Type: application/json');
if(!isset($_SESSION['user']) || !isset($_GET['id'])){
    
    http_response_code(401);
    exit;
}
    

    require_once("../config/config.php");
    require_once("connection.php");
    require_once("function.php");


    $id = $_GET['id'];

    $res =  GetSubCategory($id);
    
    echo json_encode($res);

?>