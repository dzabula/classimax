<?php
header('Content-Type: application/json; charset=utf-8');
require_once("../config/config.php");
require_once("connection.php");
require_once("function.php");






if($_SERVER['REQUEST_METHOD'] != "POST"){
    http_response_code(500);
    exit;
}
if(!isset($_POST['cities'])){

        $cities = null;
    
}else if(!is_int((int)$_POST['cities'])){

    $cities = null;
}else{
    $cities = $_POST['cities'];
}


if(!isset($_POST['categories'])){

    $categories = null;

}else if(!is_int((int)$_POST['categories'])){

    $categories = null;
}else{
    $categories = $_POST['categories'];
}


if(!isset($_POST['conditions'])){

    $conditions = null;

}else if(!is_int((int)$_POST['conditions'])){

    $conditions = null;
}else{
    $conditions = $_POST['conditions'];
}



if(strlen($_POST['curr']) > 4){
    $curr = null;
}else{
    $curr = $_POST['curr'];
}


if(!is_int((int)$_POST['price'])){
    $price = null;
}else{
    $price = $_POST['price'];
}

$gift = (int)$_POST['gift'];

if(isset($_POST['search'])){
    $search = $_POST['search'];
}else{
    $search = "";
}


if(isset($_POST['limit'])){
    $limit = $_POST['limit'];
}else{
    $limit = 0;
}

$list = file("../config/currency_list.txt");

foreach($list as $e){
    

    if(explode("=",$e)[0] == "USD")
        $qouta_usd = trim(explode("=",$e)[1]);
    else if(explode("=",$e)[0] == "EUR")    
        $qouta_eur = trim(explode("=",$e)[1]);

}

switch($curr){
    case "USD":{
        $price = $price * (float)$qouta_usd;break;
    };
    case "EUR":{
        $price = $price * (float)$qouta_eur;break;

    };
}

if($_POST['sort'] == 1) $sort = "stars DESC ";
else $sort = "stars ASC ";

$arr = FilterPost($cities,$categories,$conditions,$limit, $sort,$search,$price,$qouta_usd,$qouta_eur,$gift);

//$arr = FilerPrice($arr,$price,$qouta_usd,$qouta_eur,$gift); 

http_response_code(200);
echo json_encode($arr);






?>