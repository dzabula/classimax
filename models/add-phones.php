<?php
session_start();

header('Content-Type: application/json; charset=utf-8');

require_once("../config/config.php");
require_once("connection.php");
require_once("function.php");

if(!isset($_SESSION['user'])){
    http_response_code(401);
    exit;
}
if(!isset($_POST['val'])){
    http_response_code(401);
    exit;
}
$val = $_POST['val'];
$regPhone = '/^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/i';
if(preg_match($regPhone,$val) == 0){
    http_response_code(400);
    echo json_encode("Invalid data format");

}


$exist = IsExistPhone($val);

if($exist){

    $res = AddPhone($val,$_SESSION['user']->id);

    if($res){

        http_response_code(203);
        echo json_encode($res);
        
    }else{
        http_response_code(400);
        echo json_encode("You cannot have more than 5 phones!");
        
    }

}else{
    http_response_code(400);
    echo json_encode("This phone number already exist!");
}




?>