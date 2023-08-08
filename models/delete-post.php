<?php session_start();

header('Content-Type: application/json; charset=utf-8');

if(!isset($_SESSION['user'])){
    http_response_code(400);
    exit;
}
require_once("../config/config.php");
require_once("connection.php");
require_once("function.php");

if(!isset($_GET['id'])){
    http_response_code(400);
    exit;
}
/*if(!is_numeric($_GET['id'])){
    http_response_code(400);
    exit;
}*/

$id = $_GET['id'];
try{


 DeletePost($id,$_SESSION['user']->id);
 
http_response_code(200);
echo json_encode("good");

}catch(PDOException $e){
    echo json_encode($e->getMessage());

    http_response_code(400);
    
}


?>