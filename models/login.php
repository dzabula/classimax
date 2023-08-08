<?php session_start();
if(isset($_SESSION['user'])){
    header("Location: index.php");
    exit;
}

require_once("../config/config.php");
require_once("connection.php");
require_once("function.php");

if($_SERVER['REQUEST_METHOD'] != "POST" || !isset($_POST['submit'])){
    header("../Location: index.php");
    exit;
}
if(!isset($_POST['email']) ||!isset($_POST['password'])){
    header("Location: ../index.php?page=login");
    $_SESSION['error'] = "Incorect password or email!";
    exit;
}


$email = trim($_POST['email']);
$password = trim($_POST['password']);

$regEmail = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/i";
$regPass = "/^(?=.*?[a-z])(?=.*?[0-9])(?=.*?[?!@$%^\.&*-]).{8,}$/i";


if(!preg_match($regEmail,$email) || !preg_match($regPass,$password)){
    header("Location: ../index.php?page=login");
    $_SESSION['error'] = "Incorect format for password or email!";
    exit;
}




    $arr = file($_SERVER['DOCUMENT_ROOT']."/log/wrong-login.txt");
    $current_ip = $_SERVER['REMOTE_ADDR'];

    $res = 0;
    $limit = time() - 60*5;

    foreach($arr as $a){
        $ip_adress = explode("/",$a)[1];
        $ip_adress =explode("=",$ip_adress)[1];

        $date = explode("/",$a)[2];
        $date = explode("=",$date)[1];

        if($ip_adress == $current_ip && $date > $limit){
            $res++;
        }
        
            
        
    }
    


    if($res > 3){
        $link = "https://classimaxx.000webhostapp.com/models/verification.php?id=".DeactivateAccount($email);
       $res =  SendMail("WARRING somebody can login in your account",$email,"You","markodasic70@gmail.com","Marko Dasic","somebody can login in your account. Your account temporarily blocked. Click below link to reactivated account.",$link);
        
        $_SESSION['error'] ="You have entered the wrong data many times, you must reverification on your email";
        header("Location: ../index.php?page=login");
        exit;
    }




$user = LogIn($email, $password);

if($user){
    $_SESSION['user'] = $user;
    WriteLogForLogin($user->id,$user->full_name,$user->email);

   

    header("Location: ../index.php");



}else{


    WriteLogForWrongLogin($email);
    $_SESSION['error'] = "Incorect password or email!";
    header("Location: ../index.php?page=login");
}




?>