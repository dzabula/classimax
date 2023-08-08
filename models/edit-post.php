<?php session_start();
if(!isset($_SESSION['user'])){
    header("Location: ../index.php");
    exit;
}
require_once("../config/config.php");
require_once("connection.php");
require_once("function.php");

if($_SERVER['REQUEST_METHOD'] != "POST" || !isset($_POST['post-id'])){
    header("Location: ../index.php");
    exit;
}
$id_post = $_POST['post-id'];


$title = $_POST['title'];
$desc = $_POST['desc'];


if($title == "" || $title == null || $desc == "" || $desc ==null){
    $_SESSION['error']="Description and title are required field";
    header("Location: ../index.php?page=add-ads&id=".$id_post);
    
    exit;

}



$state = $_POST['state'];
$price_status = $_POST['price-status'];




if(isset($_POST['currency'])){
    $currency = $_POST['currency'];
    $price = floatval($_POST['price']);
    if($price < 0){
        $price = null;
    }
}else{
    $currency = null;
    $price = null;
}
$id_user = $_SESSION['user']->id;

$delivery = $_POST['delivery'];
$category = $_POST['category'];
$subcategory = $_POST['subcategory'];

if($subcategory == 0 ) $subcategory = $category;

$images = GetImagesForPost($id_post);

$post = GetPostForId($id_post);




if($_FILES['pic']['name'][0] == ""){
     $update_image = false;
    $new_path = $post->src;
    $min_pic_path = $post->min_src;
    $res = UpdatePost($title,$desc,$state,$price_status,$delivery,$subcategory,$new_path,$min_pic_path,$id_post,$id_user,$price,$currency);


   



}else{
    $update_image = true;

    DeleteAllImagesForPost($id_post);

    for($i=0;$i<Count($_FILES['pic']['name']); $i++){
        
    
        $tmp = $_FILES['pic']['tmp_name'][$i];
        $size = $_FILES['pic']['size'][$i];
        $name = $_FILES['pic']['name'][$i];



        if($size >  8388608){
            $_SESSION['error']="The image must not be larger than 8MB !";
            header("Location: ../index.php?page=add-ads&id=".$id_post);
            http_response_code(400);
            exit;

        }

        $type = $_FILES['pic']['type'][$i];
        $ext = explode("/",$type)[1];

        if($ext != "jpeg" && $ext != "png" && $ext != "jpg"){
            $_SESSION['error']="The image must be png or jpeg format!";
            header("Location: ../index.php?page=add-ads&id=".$id_post);
            http_response_code(400);
            exit;
        }


        $new_path = "user-image/".time().rand().".".$ext;

       
        



        list($wid, $ht) = getimagesize($tmp);

        $new_width = 800;
    
        $quota = $wid / $new_width;
    
        $new_height = $ht / $quota;
    
        switch($ext){
            case "jpeg":{
                $source = imagecreatefromjpeg($tmp);
                break;
            };
            case "png":{
                $source = imagecreatefrompng($tmp);
    
            };
        }
    
        $blank = imagecreatetruecolor($new_width, $new_height);
    
        imagecopyresampled($blank, $source, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);
    
        switch($ext){
            case "jpeg":{
               imagejpeg($blank,"../".$new_path);
    
            };
            case "png":{
                imagepng($blank,"../".$new_path);

    
            };
        }

        if($i==0){

            
            list($wid, $ht) = getimagesize($tmp);

            $new_width = 200;
        
            $quota = $wid / $new_width;
        
            $new_height = $ht / $quota;
        
            switch($ext){
                case "jpeg":{
                    $source = imagecreatefromjpeg($tmp);
                    break;
                };
                case "png":{
                    $source = imagecreatefrompng($tmp);
        
                };
            }
            
            $min_pic_path = "user-image/min-".time().rand().".".$ext;

            $blank = imagecreatetruecolor($new_width, $new_height);
        
            imagecopyresampled($blank, $source, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);
        
            switch($ext){
                case "jpeg":{
                    imagejpeg($blank,"../".$min_pic_path);
        
                };
                case "png":{
                    imagepng($blank,"../".$min_pic_path);

        
                };
            }

            $res = UpdatePost($title,$desc,$state,$price_status,$delivery,$subcategory,$new_path,$min_pic_path,$id_post,$id_user,$price,$currency);
            InsertPrice($id_post,$price,$currency);
          
        
        }

        InsertImage($id_post, $new_path,$name);


    }
}

if($res) header("Location: ../index.php?page=my-ads");
else header("Location: ../index.php?page=add-ads&id=".$id_post);


?>