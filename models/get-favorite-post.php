<?php
session_start();

header('Content-Type: application/json; charset=utf-8');

if(!isset($_SESSION['user'])){
    http_response_code(400);
    exit;
}
require_once("../config/config.php");
require_once("connection.php");
require_once("function.php");

if(!isset($_GET['limit'])){
    http_response_code(400);
    exit;
}

/*if(!is_numeric($_GET['id'])){
    http_response_code(400);
    exit;
}*/

$limit = $_GET['limit'];
$id_user = $_SESSION['user']->id;

$res = FavoritePosts($id_user,$limit);


foreach($res as $el){
                   

    $price = GetPriceForPost($el->post_id);
    $currency = false;
    $active = false;
    $promotions = GetPromotionsForId($id_user,$el->post_id);
    $days_left = false;
  

    if($price == null ){
        $price = false;
    }else{
        $currency = GetCurrencyForPrice($price->id_currency);
        $price = $price->price;
    }
    


    if($promotions == null){
        $promotions = false;
    }

    if($promotions != false){

        $date = new DateTime($promotions->date_end);
        $timestamp = $date->getTimestamp();

        $active = $timestamp > time();
        
        if($active){
            $days_left = $timestamp - time();
            $days_left = $days_left / 60 / 60 / 24;
            $days_left = floor($days_left);
        }
        
    }
    $el->d_master_category  = GetCategoryForId($el->id_parrent);
    $el->d_price = $price;
    $el->d_currency = $currency;
    $el->d_promotions = $promotions;
    $el->d_active = $active;
    $el->d_days_left = $days_left;
}


echo json_encode($res);




?>

