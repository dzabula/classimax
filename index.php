<?php
session_start();
require_once("views/fixed/head.php");
require_once("views/fixed/nav.php");
require_once("config/config.php");
require_once("models/connection.php");



if(isset($_GET['page'])){
    $page =$_GET['page'];

    switch($_GET['page']){
        case "category":{
            require_once("views/pages/category.php");break;
        };
        case "single":{
            if(!isset($_GET['id'])){
                require_once("views/pages/category.php");break;
            }else
                require_once("views/pages/single.php");break;
        };
        case "registration":{
            if(isset($_SESSION['user'])){
                require_once("views/pages/home.php");break;
                
            }else{
            require_once("views/pages/registration.php");break;
            }
  
        };
        case "author":{
            if(isset($_SESSION['user'])){
                require_once("views/fixed/author.php");break;
                
            }else{
            require_once("views/fixed/author.php");break;
            }
  
        };
        case "add-ads":{
            if(isset($_SESSION['user'])){
                require_once("views/pages/dashboard/add-ads.php");break;
            }
        }
        case "favorite-ads":{
            if(isset($_SESSION['user'])){
                require_once("views/pages/dashboard/favorite-ads.php");break;
            }
        }
        case "top-up-credits":{
            if(isset($_SESSION['user'])){
                require_once("views/pages/dashboard/top-up-credits.php");break;
            }
        }
        case "approval":{
            if(isset($_SESSION['user'])){
                require_once("views/pages/admin/approval.php");break;
            }
        }
        case "managment":{
            if(isset($_SESSION['user'])){
                require_once("views/pages/admin/user-managment.php");break;
            }
        }case "pricelist":{
            if(isset($_SESSION['user'])){
                require_once("views/pages/admin/pricelist.php");break;
            }
        }
        case "statistic":{
            if(isset($_SESSION['user'])){
                require_once("views/pages/admin/statistic.php");break;
            }
        }
        case "edit-profile":{
            if(isset($_SESSION['user'])){
                require_once("views/pages/dashboard/edit-profile.php");break;
            }
        }
        case "my-ads":{
            if(isset($_SESSION['user'])){
                require_once("views/pages/dashboard/my-ads.php");break;
            }
        }
        case "add-phones":{
            if(isset($_SESSION['user'])){
                require_once("views/pages/dashboard/add-phones.php");break;
            }
        }
        case "login": {
            if(isset($_SESSION['user'])){
                require_once("views/pages/home.php");break;
                
            }else{
            require_once("views/pages/login.php");break;
            }
        }
        default:{
            require_once("views/pages/home.php");
        }
    }
}
else{

    $page = "";
    require_once("views/pages/home.php");
}


require_once("views/fixed/footer.php");
require_once("views/fixed/script.php");

?>

  



