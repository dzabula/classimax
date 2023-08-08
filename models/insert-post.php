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

$title = $_POST['title'];
$desc = $_POST['desc'];


if($title == "" || $title == null || $desc == "" || $desc ==null){
    $_SESSION['error']="Description and title are required field";
    header("Location: ../index.php?page=add-ads");
    
    exit;

}

if(!isset($_POST['promotions'])){
    header("Location: ../index.php?page=add-ads");
   
    exit;
}

if(!isset($_POST['youtube'])){
    $youtube = null;
}else{
    $youtube = $_POST['youtube'];
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


$delivery = $_POST['delivery'];
$category = $_POST['category'];
$subcategory = $_POST['subcategory'];
if($subcategory == 0) $subcategory = $category;

$promotion = $_POST['promotions'];






if($_FILES['pic']['name'][0] != ""){
    
  
    

    for($i=0;$i<Count($_FILES['pic']['name']); $i++){
        
    
        $tmp = $_FILES['pic']['tmp_name'][$i];
        $size = $_FILES['pic']['size'][$i];
        $name = $_FILES['pic']['name'][$i];



        if($size >  8388608){
            $_SESSION['error']="The image must not be larger than 8MB !";
            header("Location: ../index.php?page=add-ads");
            http_response_code(400);
            exit;

        }

        $type = $_FILES['pic']['type'][$i];
        $ext = explode("/",$type)[1];

        if($ext != "jpeg" && $ext != "png" && $ext != "jpg"){
            $_SESSION['error']="The image must be png or jpeg format!";
            header("Location: ../index.php?page=add-ads");
            http_response_code(400);
            exit;
        }


        $new_path = "user-image/".time().rand().".".$ext;

       
        



        list($wid, $ht) = getimagesize($tmp);

        $new_width = 1000;
    
        $quota = $wid / $new_width;
    
        $new_height = $ht / $quota;
    
        switch($ext){
            case "jpeg":{
                $source = imagecreatefromjpeg($tmp);break;
                
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
            
            $min_pic_path = "user-image/min-".time().".".$ext;

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


            $id_post = InsertPost($title,$desc,$state,$price_status,$delivery,$subcategory,$new_path,$min_pic_path,$promotion,$youtube);
            
           
            
            if($id_post == false){
                header("Location: ../index.php?page=add-ads");
                $_SESSION['error'] = "Somethings go wrong!";
                exit;
            
            }
            InsertPrice($id_post,$price,$currency);

        }

        if($id_post == false){
                header("Location: ../index.php?page=add-ads");
                $_SESSION['error'] = "Somethings go wrong!";
                exit;
            
        }
    
        

        InsertImage($id_post, $new_path,$name);
          
        
    }


}else{
    $new_path= null;
    $min_src = null;
   
   $res =  InsertPost($title,$desc,$state,$price_status,$delivery,$subcategory,$new_path,$min_src,$promotion,$youtube);
   

   if($res == false){
        header("Location: ../index.php?page=add-ads");
        
        exit;

    }else{
        $id_post = $res;
        $new_path = "user-image/empty.png";
        $name =  "empty photo products";
        InsertImage($id_post, $new_path,$name);
       
        InsertPrice($id_post,$price,$currency);
    }



}







    header("Location: ../index.php?page=my-ads");

    exit;






?>9