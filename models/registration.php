<?php session_start();
if(isset($_SESSION['user'])){
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

if(!isset($_POST['first-name']) || !isset($_POST['first-name']) ||!isset($_POST['last-name']) ||!isset($_POST['email']) ||!isset($_POST['city']) ||!isset($_POST['adress']) ||!isset($_POST['password']) || !isset($_POST['agree'])){
    header("Location: ../index.php?page=registration");
    $_SESSION['registration-error'] = "Data is incomplete !";
    exit;
}

if($_POST['agree']!="on"){
    header("Location: ../index.php?page=registration");
    $_SESSION['registration-error'] = "Data is incomplete !";
    exit;
}

$regName = '/^([a-zA-Z]{2,}(\s[a-zA-Z]{2,})?)$/i';
$regAdress = '/^([a-zA-Z0-9]{2,}(\s[a-zA-Z0-9]{1,})*)$/i';
$regEmail = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/i';
$regPass = '/^(?=.*?[a-z])(?=.*?[0-9])(?=.*?[?!@$%^\.&*-]).{8,}$/i';
$regPhone = '/^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/i';

if(!preg_match($regPhone,$_POST['phone']) || !preg_match($regName,$_POST['first-name']) || !preg_match($regName,$_POST['last-name'])|| !preg_match($regEmail,$_POST['email']) || !preg_match($regAdress,$_POST['adress']) || !preg_match($regPass,$_POST['password']) ){
    header("Location: ../index.php?page=registration");
    $_SESSION['registration-error'] = "Registration field. Incorrect data format";
    exit;
}

$src = "user-image/ghost.png";

if(isset($_FILES['image'])){
    $tmp = $_POST['path'];
    $old_path = $_POST['path'];
    $new_tmp = "../$old_path";
    $name = $_FILES['image']['name'];
    $size = $_FILES['image']['size'];
    $type = $_FILES['image']['type'];
   


    if($size > 8388608){
        header("Location: ../index.php?page=registration");
        $_SESSION['registration-error'] = "Registration field. The image must not be larger than 8MB ! ";
        exit;
    }
    
    $ext = explode("/",$type)[1];

    if($ext != "jpeg" && $ext != "jpg" && $ext != "png"){
        header("Location: ../index.php?page=registration");
        $_SESSION['registration-error'] = "Registration field. The image extension must not be jpg or png ! ";
        exit;
    }

    
    

    
    


   

    list($wid, $ht) = getimagesize($new_tmp);

    $new_width = 200;

    $quota = $wid / $new_width;

    $new_height = $ht / $quota;

  /*  switch($ext){
        case "png":{*/
            

            $source = imagecreatefrompng($new_tmp);

   /*     };
    }
*/
    $blank = imagecreatetruecolor($new_width, $new_height);

    imagecopyresampled($blank, $source, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);

    

    $src = $tmp;

    switch($ext){
        case "jpeg":{

            imagejpeg($blank,$new_tmp);
            imagedestroy($blank);break;

        };
        case "png":{
            imagepng($blank,$new_tmp);
            imagedestroy($blank);
            
        };
    }

}





$name = trim($_POST['first-name'])." ".trim($_POST['last-name']);
$phone = trim($_POST['phone']);
$email = $_POST['email'];
$adress = $_POST['adress'];
$city = $_POST['city'];
$date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
$password = $_POST['password'];

$res = Registration($name,$email,$city,$adress,$date,$password,$src,$phone);



if($res['activation_link'] == null){

    $_SESSION['registration-error'] = "Email alreay exist! ";
    header("Location: ../index.php?page=registration");
    exit;
}else{
    

   // InsertAndSendVerification($user->id,$user->email);

   $link = "https://classimaxx.000webhostapp.com/models/verification.php?id=".$res['activation_link'];
   
   $subject = "Verification Email.";
   $to_email = $email;
   $to_fullname = $name;
   $from_email = "markodasic70@gmail.com";
   $from_fullname = "Marko Dasic";
   $text = "Please click link below, to verificate your email adress and activate your account. ";
   
    $res = SednMail($subject,$to_email,$to_fullname,$from_email,$from_fullname,$text,$link);
    
    if($res){
            $_SESSION['notification'] = "You must confirm your registration with your email";
    }else{
            $_SESSION['notification'] = "Problem with send email!";
    }
    
    header("Location: ../index.php?page=home");
    exit;



   /* echo $res['activation_link'];
    $res = mail("markodasic70@gmail.com","Naslov","HEllo world");
    var_dump($res);
    #  header("Location: ../activation.php");*/
}








?>