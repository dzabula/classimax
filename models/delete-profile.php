<?php session_start();
if(isset($_SESSION['user'])){
    header("..index.php?page=login");
    exit;
}



require_once("../config/config.php");
require_once("connection.php");
require_once("function.php");


DeleteProfile($_SESSION['user']->id);
unset($_SESSION['user']);

header("..Location: index.php");




?>