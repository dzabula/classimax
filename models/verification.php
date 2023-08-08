<?php session_start();

if(!isset($_GET['id'])){
    $_SESSION['notification'] = "Activation account field. Wrong activation link.";
    header("Location: ../index.php");
    exit;
}
$id = $_GET['id'];
if(!is_numeric($id)){
    
        $_SESSION['notification'] = "Activation account field. Wrong activation link.";
    header("Location: ../index.php");
    exit;
    
    
}
require_once("../config/config.php");
require_once("connection.php");
require_once("function.php");


$res = ActivateAccount($id);

if($res){
    $_SESSION['notification'] = "Activation account success. Now you can log in.";
    header("Location: ../index.php");
    exit;
}else{
       $_SESSION['notification'] = "Activation account field. Wrong activation link.";
    header("Location: ../index.php");
    exit;
}







?>