<?php session_start();

if(!isset($_SESSION['user'])){
    header("Location: ../index.php");
    exit;
}
require_once("../config/config.php");
require_once("connection.php");
require_once("function.php");

if($_SERVER['REQUEST_METHOD'] != "POST" || !isset($_POST['submit'])){
    header("Location: ../index.php");
    exit;
}

$full_name = trim($_POST['full-name']);

$email = trim($_POST['email']);
$adress = trim($_POST['adress']);
$id_user = $_SESSION['user']->id;

$src = $_SESSION['user']->src;





$regName = "/([a-zA-Z]{2,100}(\s[a-zA-Z]{2,100})?)/i";
$regAdress = "/^([a-zA-Z0-9]{2,}(\s[a-zA-Z0-9]{1,})*)$/i";


$r[0] = filter_var($email,FILTER_VALIDATE_EMAIL);
$r[1] = preg_match($regName,$full_name) == 1;
$r[2] = preg_match($regAdress,$adress) == 1;

if(!$r[0] || !$r[1] || !$r[2]){
    $_SESSION['error'] = "Data is incomplete !";
    header("Location: ../index.php?page=edit-profile");
    exit;
}

if($_FILES['image']['name'] == ""){

    $res = UpdateUser($id_user,$full_name,$email,$adress,$src);
    if($res){
        $_SESSION['success'] = "Changes are saved.";
        header("Location: ../index.php?page=edit-profile");
        $_SESSION['user']->full_name = $full_name;
        $_SESSION['user']->email = $email;
        $_SESSION['user']->adress = $adress;
        exit;
    }else{
        $_SESSION['error']="Somethigns go wrong";
        header("Location: ../index.php?page=edit-profile");
        exit;
    }

}else{



    
   /* $tmp = $_FILES['pic']['tmp_name'];*/
    $tmp = $_POST['src'];
    $tmp = explode(".",$tmp)[0] . ".png";
    $ext = explode(".",$tmp)[1];
    $tmp = "../$tmp";
    $size = $_FILES['image']['size'];
    $name = $_FILES['image']['name'];



    if($size >  8388608){
        $_SESSION['error']="The image must not be larger than 8MB !";
        header("Location: ../index.php?page=edit-profile");
        http_response_code(400);
        exit;

    }

   // $type = $_FILES['image']['type'];
    //$ext = explode(".",$tmp)[1];
   // $ext = "png";
    //$tmp = explode(".",$tmp)[0] . ".png";

    if($ext != "jpeg" && $ext != "png" && $ext != "jpg"){
        $_SESSION['error']="The image must be png or jpeg format!";
        header("Location: ../index.php?page=edit-profile");
        http_response_code(400);
        exit;
    }


    $new_path = "user-image/".time().time().".$ext";
   
   
    
    /*echo $ext;*/


    list($wid, $ht) = getimagesize($tmp);

    $new_width = 800;

    $quota = $wid / $new_width;

    $new_height = $ht / $quota;

    switch($ext){
        case "jpeg":{
            
            $source = imagecreatefromjpeg($tmp);break;
       
        };
        case "jpg":{
            
            $source = imagecreatefromjpeg($tmp);break;
       
        };
        case "png":{
            $source = imagecreatefrompng($tmp);break;

        };
    }

    $blank = imagecreatetruecolor($new_width, $new_height);

    imagecopyresampled($blank, $source, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);

    switch($ext){
        case "jpeg":{
           imagejpeg($blank,$tmp);break;

        };
        case "jpg":{
           imagejpeg($blank,$tmp);break;

        };
        case "png":{
            imagepng($blank,$tmp);


        };
    }
    
    imagedestroy($source);
    imagedestroy($blank);


    $res = UpdateUser($id_user,$full_name,$email,$adress,$tmp);
    if($res){
        $_SESSION['success'] = "Changes are saved.";
        header("Location: ../index.php?page=edit-profile");
        $_SESSION['user']->full_name = $full_name;
        $_SESSION['user']->email = $email;
        $_SESSION['user']->adress = $adress;
        $_SESSION['user']->src = $tmp;
        exit;
    }else{
        $_SESSION['error']="Somethigns go wrong";
        header("Location: ../index.php?page=edit-profile");
        exit;
    }


}





