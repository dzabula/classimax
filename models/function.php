<?php
define("START_PREPAID", 8000);

// LOG
function WriteLog($id_user,$page,$action){
    $ip_adress = $_SERVER['REMOTE_ADDR'];
    $timestamp = time();
    $exist = 0;
    $str = "id_user=$id_user/ip_adress=$ip_adress/date=$timestamp/page=$page/action=$action\n";
    
    $arr = file($_SERVER['DOCUMENT_ROOT']."/log/log.txt");
    $new_arr = "";
    $limit = time() - 60*60*24*7;
    foreach($arr as $a){
        $cur_page = trim(explode("/",$a)[3]);
        $cur_page = trim(explode("=",$cur_page)[1]);
        $ip = trim(explode("/",$a)[1]);
        $ip = trim(explode("=",$ip)[1]);
        $date = trim(explode("/",$a)[2]);
        $date = (int)trim(explode("=",$date)[1]);
        if( $date > $limit){
            $new_arr .= $a;
        }
        if( $date > (time() - 3600* 24) AND $ip_adress == $ip AND $cur_page == $page){
            $exist =1;
        }
    }
    if($exist == 0){
           $new_arr .= $str;
    }
    $f = fopen($_SERVER['DOCUMENT_ROOT']."/log/log.txt","w");
    fwrite($f,$new_arr);
    fclose($f);
}


function WriteLogForLogin($id_user,$name,$email){
    $ip_adress = $_SERVER['REMOTE_ADDR'];
    $timestamp = time();

    $str = "name=$name/email=$email/id_user=$id_user/date=$timestamp/ip_adress=$ip_adress\n";


    $arr = file($_SERVER['DOCUMENT_ROOT']."/log/login.txt");
    $new_arr = "";
    $limit = time() - 10*60;
    foreach($arr as $a){
        $date = trim(explode("/",$a)[3]);
        $date = (int)trim(explode("=",$date)[1]);
        if( $date > $limit){
            $new_arr .= $a;
        }
    }
    $new_arr .= $str;
    $f = fopen($_SERVER['DOCUMENT_ROOT']."/log/login.txt","w");
    fwrite($f,$new_arr);
    fclose($f);
}

function WriteLogForWrongLogin($email){
    $ip_adress = $_SERVER['REMOTE_ADDR'];
    $timestamp = time();

    $str = "email=$email/ip_adress=$ip_adress/date=$timestamp \n";

    $arr = file($_SERVER['DOCUMENT_ROOT']."/log/wrong-login.txt");
    $new_arr = "";
    $limit = time() - 10*60;
    foreach($arr as $a){
        $date = trim(explode("/",$a)[2]);
        $date = (int)trim(explode("=",$date)[1]);
        if( $date > $limit){
            $new_arr .= $a;
        }
    }
    $new_arr .= $str;
    $f = fopen($_SERVER['DOCUMENT_ROOT']."/log/wrong-login.txt","w");
    fwrite($f,$new_arr);
    fclose($f);

}


/*Short text about description */
function Shorter($text, $chars_limit) {
    if (strlen($text) > $chars_limit) {
      $rpos = strrpos(substr($text, 0, $chars_limit), " ");
      if ($rpos!==false) {
        // if there's whitespace, cut off at last whitespace
        return substr($text, 0, $rpos).'...'; 
      }else{
        // otherwise, just cut after $chars_limit chars
        return substr($text, 0, $chars_limit).'...'; 
      }
    } else {
      return $text;
    }
  }

/*MAIL*/
function SendMail($subject,$to_email,$to_fullname,$from_email,$from_fullname,$text,$link){

  $headers  = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=utf-8\r\n";
  // Additional headers
  // This might look redundant but some services REALLY favor it being there.
  $headers .= "To: $to_fullname <$to_email>\r\n";
  $headers .= "From: $from_fullname <$from_email>\r\n";
  $message = "<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"en\" xml:lang=\"en\">\r\n
  <head>\r\n
    <title>Hello Test</title>\r\n
  </head>\r\n
  <body>\r\n
    <p></p>\r\n
    <p style=\"color: #00CC66; font-weight:600; font-style: italic; font-size:14px; float:left; margin-left:7px;\">$text</p>\r\n <a href=\"$link\"> Click Here</a></body>\r\n</html>";
  $res =  mail($to_email, $subject, $message, $headers);
  return $res;
    
  
}

function ActivateAccount($id){
    global $conn;
    $rand = rand().rand();
    $q = "UPDATE users SET active = 1, activation_link = $rand  WHERE activation_link = :activation_link";
    
    $stm = $conn->prepare($q);
    $stm->bindParam(":activation_link",$id);
    $res = $stm->execute();

    
    return $res;
}
function DeactivateAccount($email){
    global $conn;
    $rand = rand().rand();
    $q = "UPDATE users SET active = 0, activation_link = $rand  WHERE email = :email";
    
    $stm = $conn->prepare($q);
    $stm->bindParam(":email",$email);
    $res = $stm->execute();

    
    return $rand;
}


/*END MAIL*/
function InsertPrepaid($id_user, $prepaid){

    global $conn;

    $q = "INSERT INTO prepaids (id_user,prepaid) VALUES( $id_user, $prepaid)";

    $conn->query($q);



}

function InsertPhone($id_user,$phone){
    global $conn;

    $q = "INSERT INTO phones (id_user,phone) VALUES(:id_user,:phone)";
    $stm = $conn->prepare($q);
    $stm->bindParam(":id_user",$id_user);
    $stm->bindParam(":phone",$phone);

    $stm->execute();
}

function Registration($name,$email,$city,$adress,$date,$password, $src,$phone){
    $name = trim($name);
    $city = (int)$city;
    addslashes($adress);
    addslashes($name);
    addslashes($email);
    $password = md5($password);
    

    global $conn;



    $query = "INSERT INTO users (full_name, email, id_city,adress, date_birth, password, src, activation_link)
                VALUES(:full_name,:email,:id_city,:adress,:date_birth,:password,:src,:activation_link)";


    $activation_link = rand(). rand();
    $stm = $conn->prepare($query);
    $stm->bindParam(":full_name",$name);
    $stm->bindParam(":email",$email);
    $stm->bindParam(":id_city",$city);
    $stm->bindParam(":adress",$adress);
    $stm->bindParam(":date_birth",$date);
    $stm->bindParam(":password",$password);
    $stm->bindParam(":activation_link",$activation_link);
    $stm->bindParam(":src",$src);

    try{
    $stm->execute();

    $id = $conn->lastInsertId();

    InsertPrepaid($id,START_PREPAID);
    InsertPhone($id,$phone);

    return [
        "error" => "",
     "activation_link" =>   $activation_link
    ];
    }
    catch(PDOException $e){
        return [
            "error" => $e,
            "activation_link" => null
        ];
    }
   


    
   

}

function InsertAndSendVerification($id_user,$email){
    global $conn;
    $q = "UPDATE";
}


function LogIn($email, $password){
    

    addslashes($email);
    $password = md5($password);
    global $conn;

    $q = "SELECT * FROM users u JOIN roles r ON u.id_role = r.role_id  WHERE email = :email AND password = :password AND active = 1 AND date_deleted IS NULL";

    $stm = $conn->prepare($q);

    $stm->bindParam(":email",$email);
    $stm->bindParam(":password",$password);

    $stm->execute();

    return $stm->fetch();
}

function GetUserForId($id_user){

    global $conn;
    $id_user = (int)$id_user;
    $q = "SELECT * FROM users u WHERE id = $id_user AND active = 1 AND date_deleted IS NULL";



    return $conn->query($q)->fetch();
}

function GetAllPhonesForUser($id_user){
    global $conn;

    $q="SELECT * FROM phones WHERE id_user = $id_user";

    return $conn->query($q)->fetchAll();

}

function GetAllCategories(){
    global $conn;

    $res = $conn->query("SELECT * FROM categories  WHERE id_parrent IS NULL");

    return $res->fetchAll();

}
function GetAllCategoriesAndIcons(){
    global $conn;

    $res = $conn->query("SELECT *,c.id as category_id FROM categories c LEFT JOIN category_icons ci ON c.id = ci.id_category WHERE id_parrent IS NULL");

    return $res->fetchAll();
}

function GetAllStates(){
    global $conn;

    $res = $conn->query("SELECT * FROM states");

    return $res->fetchAll();

}

function GetAllCurrency(){
    global $conn;

    $res = $conn->query("SELECT * FROM currencies");

    return $res->fetchAll();

}

function GetAllDelivery(){
    global $conn;

    $res = $conn->query("SELECT * FROM deliveries");

    return $res->fetchAll();

}

function GetSubCategory($id){
    global $conn;

    $q = "SELECT * FROM categories WHERE id_parrent = :id";
    $stm = $conn->prepare($q);

    $stm->bindParam(":id",$id);

    $stm->execute();

    return $stm->fetchAll();


}



function GetAllStatuses(){
    global $conn;

    $res = $conn->query("SELECT * FROM price_statuses");

    return $res->fetchAll();

}



function GetAllPromotions(){
    global $conn;

    $res = $conn->query("SELECT * FROM promotions");

    return $res->fetchAll();

}

function GetPrepaid($id){

    global $conn;

    return $conn->query("SELECT prepaid FROM prepaids WHERE id_user = ".$id." ORDER BY date_created DESC LIMIT 0,1")->fetch();



}
function GetPostForId($id_post){
    global $conn;

    return $conn->query("SELECT * FROM posts WHERE id = ".$id_post." AND date_deleted IS NULL LIMIT 0,1")->fetch();



}

/*Category PAGE */
function GetAllCities(){
    global $conn;

    return $conn->query("SELECT * FROM cities")->fetchAll();


}




function GetAllAds($limit){
    global $conn;

    $q = "SELECT * ,p.id_user as id_user,c.category as category ,p.date_created as date_created,p.description as description ,p.id as post_id, i.date_start as date_start, i.date_end as date_end, pp.promotion as promotion FROM  
    posts p  JOIN states stat ON p.id_state = stat.id JOIN users usr ON usr.id = p.id_user
    LEFT JOIN categories c ON p.id_category = c.id  LEFT JOIN invoices i ON p.id = i.id_post 
    LEFT JOIN promotions pp ON i.id_promotion =  pp.id 
    WHERE p.date_deleted IS NULL AND usr.date_deleted IS NULL AND usr.active = 1
     ORDER BY pp.promotion DESC, p.date_created DESC
     LIMIT $limit , 12";

    $q2 = "SELECT COUNT(*) as num FROM posts WHERE date_deleted IS NULL";

    $res1 = $conn->query($q)->fetchAll();
    $res2 = $conn->query($q2)->fetch()->num;


    return [
        "arr" => $res1,
        "num" => $res2
    ];
    //((i.date_end > CURDATE() AND pp.promotion LIKE 'On Top') OR i.date_end IS NULL) 
}



function FilterPost($cities,$categories,$conditions, $limit, $sort,$search,$price,$qouta_usd,$qouta_eur,$gift){
    global $conn;

    if($gift) $gift = "Gift";
    else $gift = "";    


    /*$q = "SELECT pst.status as status ,stat.state as state ,p.title,p.min_src,p.id_user as id_user,c.category as category ,p.date_created as date_created,p.description as description ,p.id as post_id, i.date_start as date_start, i.date_end as date_end, pp.promotion as promotion,
     (SELECT SUM(stars) / COUNT(*)  as gradet FROM likes WHERE id_whom = usr.id) as stars
      FROM posts p JOIN states stat ON p.id_state = stat.id JOIN users usr ON usr.id = p.id_user
      JOIN price_statuses pst ON p.id_price_status = pst.id
       LEFT JOIN categories c ON p.id_category = c.id LEFT JOIN invoices i ON p.id = i.id_post 
       LEFT JOIN promotions pp ON i.id_promotion = pp.id
        WHERE p.date_deleted IS NULL AND usr.date_deleted IS NULL AND usr.active = 1 ";*/


    $q= "SELECT curr.currency,pr.price as price, pst.status as status ,stat.state as state ,p.title,p.min_src,p.id_user as id_user,c.category as category ,p.date_created as date_created,p.description as description ,p.id as post_id, i.date_start as date_start, i.date_end as date_end, pp.promotion as promotion,
    (SELECT SUM(stars) / COUNT(*)  as gradet FROM likes WHERE id_whom = usr.id) as stars
    FROM posts p JOIN states stat ON p.id_state = stat.id JOIN users usr ON usr.id = p.id_user
    JOIN price_statuses pst ON p.id_price_status = pst.id
   LEFT JOIN prices pr ON pr.id_post =p.id
   LEFT JOIN currencies curr ON pr.id_currency = curr.id
     LEFT JOIN categories c ON p.id_category = c.id LEFT JOIN invoices i ON p.id = i.id_post 
     LEFT JOIN promotions pp ON i.id_promotion = pp.id
      WHERE p.date_deleted IS NULL AND usr.date_deleted IS NULL AND usr.active = 1 AND 
      ( pst.status ";

    if($gift) $q.= "LIKE 'Gift' OR " ;
    else  $q.= " NOT LIKE 'Gift' AND ";
      
     $q.= " pr.id = (SELECT pricc.id FROM prices pricc JOIN currencies curren ON pricc.id_currency = curren.id
       WHERE pricc.id_post = p.id AND ((pricc.price * $qouta_usd < $price AND curren.currency LIKE 'USD') OR 
       (pricc.price  < $price AND curren.currency LIKE 'RSD') OR
         (pricc.price * $qouta_eur < $price AND curren.currency LIKE 'EUR'))
          ORDER BY pricc.date_created DESC LIMIT 0,1)) ";
    

    $q2= "SELECT COUNT(*) as num
    FROM posts p JOIN states stat ON p.id_state = stat.id JOIN users usr ON usr.id = p.id_user
    JOIN price_statuses pst ON p.id_price_status = pst.id
   LEFT JOIN prices pr ON pr.id_post =p.id
     LEFT JOIN categories c ON p.id_category = c.id LEFT JOIN invoices i ON p.id = i.id_post 
     LEFT JOIN promotions pp ON i.id_promotion = pp.id
      WHERE p.date_deleted IS NULL AND usr.date_deleted IS NULL AND usr.active = 1 AND 
      (pst.status";

      if($gift) $q2.= " LIKE 'Gift' OR " ;
      else  $q2.= " NOT LIKE 'Gift' AND ";
      
     $q2.= " pr.id = (SELECT pricc.id FROM prices pricc JOIN currencies curren ON pricc.id_currency = curren.id
       WHERE pricc.id_post = p.id AND ((pricc.price * $qouta_usd < $price AND curren.currency LIKE 'USD') OR 
       (pricc.price  < $price AND curren.currency LIKE 'RSD') OR
         (pricc.price * $qouta_eur < $price AND curren.currency LIKE 'EUR'))
          ORDER BY pricc.date_created DESC LIMIT 0,1))";

  /*  $q2= "SELECT COUNT(*) as num, p.id,
    (SELECT price FROM prices pricc JOIN currencies curren ON pricc.id_currency = curren.id WHERE pricc.id_post = p.id AND ((pricc.price * $qouta_usd > $price AND curren.currency LIKE 'USD') OR (pricc.price  > $price AND curren.currency LIKE 'RSD') 
    OR (pricc.price * $qouta_eur > $price AND curren.currency LIKE 'EUR')) ORDER BY pricc.date_created DESC LIMIT 0,1 ) as price
     FROM posts p JOIN states stat ON p.id_state = stat.id JOIN users usr ON usr.id = p.id_user
     JOIN price_statuses pst ON p.id_price_status = pst.id

      LEFT JOIN categories c ON p.id_category = c.id LEFT JOIN invoices i ON p.id = i.id_post 
      LEFT JOIN promotions pp ON i.id_promotion = pp.id
       WHERE p.date_deleted IS NULL AND usr.date_deleted IS NULL AND usr.active = 1 ";*/


    if($search != "" && $search !=null){
        $search = strtolower($search);
        $search = addslashes($search);

        $q.="AND (LOWER(p.title) LIKE '%".$search."%') "; 
        $q2.="AND (LOWER(p.title) LIKE '%".$search."%') "; 

    }
    

    
    if($cities != null){
        foreach($cities as $i => $c){
            $c = (int)$c;
            if($i == 0){
                $q.= "AND (usr.id_city = $c ";
                $q2.= "AND (usr.id_city = $c ";
                
            }
            if($i == count($cities)-1 ){
                $q.= "OR usr.id_city = $c) ";
                $q2.= "OR usr.id_city = $c) ";
                
            }           
            else{
                $q.= "OR usr.id_city = $c ";
                $q2.= "OR usr.id_city = $c ";
             
            }
        
        }
        
    }

    if($categories != null){
        foreach($categories as $i => $c){
            $c = (int)$c;

            if($i == 0){
                $q.= "AND (c.id_parrent = $c  OR c.id = $c ";
                $q2.= "AND (c.id_parrent = $c OR c.id = $c ";
                
            }if($i == count($categories)-1 ){
                $q.= "OR c.id_parrent = $c OR c.id = $c) ";
                $q2.= "OR c.id_parrent = $c OR c.id = $c) ";
              
            }           
            else{
                $q.= "OR c.id_parrent = $c OR c.id = $c ";
                $q2.= "OR c.id_parrent = $c OR c.id = $c ";
             
            }
        
        }
        
    }


    if($conditions != null){
        foreach($conditions as $i => $c){
            $c = (int)$c;

            if($i == 0){
                $q.= "AND (stat.id = $c ";
                $q2.= "AND (stat.id = $c ";
             
            }if($i == count($conditions)-1 ){
                $q.= "OR stat.id = $c) ";
                $q2.= "OR stat.id = $c) ";
                
            }           
            else{
                $q.= "OR stat.id = $c ";
                $q2.= "OR stat.id = $c ";
            
            }
        
        }
        
    }

    $q .=" ORDER BY pp.promotion DESC ,  ".$sort.", p.date_created DESC LIMIT $limit , 12";
    



    $res1 =  $conn->query($q)->fetchAll();
    $res2 =  $conn->query($q2)->fetch()->num;
  

    return [
        "result" => $res1,
        "num" => $res2
    ];




}
/*
function  FilerPrice($arr,$price,$qouta_usd,$qouta_eur,$gift){

    $res  = [];

    $arr2 = $arr['result'];
   
    foreach($arr2 as $e){

        if($e->price != null){
            $p = $e->price;
            $c = $e->currency;

            $price_c = 0;

            switch($c){
                case "USD":{
                    $price_c = $p * (float)$qouta_usd;break;
                };
                case "EUR":{
                    $price_c = $p * (float)$qouta_eur;break;
            
                };
                default:{
                    $price_c = $p;
                }
            }

      

            if($price_c <= $price){
                array_push($res,$e);
            }


        }else if($e->status == "Gift" && $gift == "1"){
            array_push($res,$e);

        }
        

    }

    if( Count($res) != Count($arr2)){


        $arr['num'] = Count($res);
    }


    return [
        "result" => $res,
        "num"=> $arr['num']
    ];
}
*/
function GetPrepaidRequest($id_user){
    $arr = file($_SERVER['DOCUMENT_ROOT']."/config/request_prepaid.txt");

    for($i = 0; $i < count($arr); $i++){
        $arr[$i] = trim($arr[$i]);

        $row = explode("/",$arr[$i]);
        $id = explode("=",$row[0])[1];

        $prepaid = explode("=",$row[1])[1];

        if($id == $id_user){
            return [
                "id"=>$id,
                "prepaid" => $prepaid
            ];
        }
    }
    return false;



};

/*END*/

function InsertPost($title,$desc,$state,$price_status,$delivery,$subcategory,$src,$min_src,$promotion,$youtube){

    $title = addslashes(trim($title));
    $desc = addslashes(trim($desc));
    $youtube = addslashes($youtube);
    $id_state = (int)$state;
    $id_price_status = (int)$price_status;
    
    $id_subcategory = (int)$subcategory;
    $id_delivery = (int)$delivery;
    $id_user = $_SESSION['user']->id;

    if($src == null){
        $src = "user-image/empty.png";
        $min_src = "user-image/min-empty.png";


    }
    


    global $conn;


    if($promotion != 0){

       
        $id_promotion = $promotion;

       
        $cost = $conn->query("SELECT price FROM promotions WHERE id = ".$id_promotion." LIMIT 0,1 ")->fetch()->price;
        $current_prepaid = $conn->query("SELECT prepaid FROM prepaids WHERE id_user = ".$id_user." ORDER BY date_created DESC  LIMIT 0,1 ")->fetch()->prepaid;
        
        
        $prepaid = $current_prepaid - $cost;
        

        if($prepaid > 0){

            $duration = $conn->query("SELECT day_duration from promotions WHERE id = ".$id_promotion)->fetch()->day_duration;
            $date_end = time() + ($duration * 24 * 60 * 60);
            $date_end = date("Y-m-d H:i:s",$date_end);

            /*INSERT POST*/
            $query = "INSERT INTO posts (title, description, id_state,id_price_status, src,min_src, id_user, id_delivery, id_category, you_tube)
            VALUES(:title,:description,:id_state,:id_price_status,:src,:min_src,:id_user,:id_delivery,:id_subcategory,:youtube)";

            $stm = $conn->prepare($query);
            $stm->bindParam(":title",$title);
            $stm->bindParam(":description",$desc);
            $stm->bindParam(":id_state",$id_state);
            $stm->bindParam(":id_price_status",$id_price_status);
            $stm->bindParam(":src",$src);
            $stm->bindParam(":min_src",$min_src);
            $stm->bindParam(":id_user",$id_user);
            $stm->bindParam(":id_delivery",$id_delivery);
            $stm->bindParam(":id_subcategory",$id_subcategory);
            $stm->bindParam(":youtube",$youtube);


            $stm->execute();
            $id_post = $conn->lastInsertId();

            /*END INSERT POST */

            $conn->query("INSERT INTO  prepaids (id_user,prepaid) VALUES($id_user,$prepaid)");
            $conn->query("INSERT INTO invoices (id_user, id_promotion, id_post,date_end) VALUES (".$id_user.",".$id_promotion.",".$id_post.",'".$date_end."') ");
        
            
           
            return $id_post;
        }else{
            $_SESSION['error'] = "You don't have enough credits!!!";
            return false;
        }
    }else{

        

        /*INSERT POST*/
        $query = "INSERT INTO posts (title, description, id_state,id_price_status, src,min_src, id_user, id_delivery, id_category,you_tube)
        VALUES(:title,:description,:id_state,:id_price_status,:src,:min_src,:id_user,:id_delivery,:id_subcategory,:youtube)";

        $stm = $conn->prepare($query);
        $stm->bindParam(":title",$title);
        $stm->bindParam(":description",$desc);
        $stm->bindParam(":id_state",$id_state);
        $stm->bindParam(":id_price_status",$id_price_status);
        $stm->bindParam(":src",$src);
        $stm->bindParam(":min_src",$min_src);
        $stm->bindParam(":id_user",$id_user);
        $stm->bindParam(":id_delivery",$id_delivery);
        $stm->bindParam(":id_subcategory",$id_subcategory);
        $stm->bindParam(":youtube",$youtube);

        $stm->execute();
        $id_post = $conn->lastInsertId();

        /*END INSERT POST */

        
        
       
        return $id_post;


    }








 


}

function InsertImage($id_post,$new_path,$alt){
    global $conn;


    $q= "INSERT INTO images (id_post,src,alt) VALUES (:id_post,:new_path,:alt)";

    $stm = $conn->prepare($q);
    $stm->bindParam(":id_post",$id_post);
    $stm->bindParam(":new_path",$new_path);
    $stm->bindParam(":alt",$alt);

    $res = $stm->execute();
   
}

function InsertPrice($id_post,$price,$id_currency){
    if($price != null && $id_currency != null){

        global $conn;
        $q = "INSERT INTO prices (id_post,id_currency,price) VALUES(:id_post,:id_currency,:price)";

        $stm = $conn->prepare($q);

        $stm->bindParam(":id_post", $id_post);
        $stm->bindParam(":id_currency", $id_currency);
        $stm->bindParam(":price", $price);

        $stm->execute();




    }
}

function GetCategoryForId($id){
    global $conn;
    $id = (int)$id;
    $q = "SELECT * FROM categories WHERE id = $id LIMIT 0, 1";

    return $conn->query($q)->fetch();


}

/*SINGLE PAGE */

function GetFullDataPostForId($id_post){
    global $conn;

    $id_post = (int)$id_post;

    $q = "SELECT p.you_tube,u.id as user_id,p.id as post_id, u.src as user_img, cat.id_parrent as id_parrent,cat.category,del.delivery,p.title,p.description,p.src,p.min_src,p.date_created as post_sreated,u.date_created as user_created, u.full_name as full_name,c.city, s.state,ps.status
     FROM posts p JOIN users u ON p.id_user = u.id JOIN cities c ON u.id_city = c.id JOIN states s ON p.id_state = s.id
    JOIN categories cat ON p.id_category = cat.id
    JOIN deliveries del ON p.id_delivery =del.id
    JOIN price_statuses ps ON p.id_price_status = ps.id WHERE p.date_deleted IS NULL AND p.id = $id_post AND u.date_deleted IS NULL AND u.active = 1";

    $res = $conn->query($q)->fetch();

    return $res;


}

function GetFullDataLikesForPost($id_user){
    global $conn;
    $id_user = (int)$id_user;
    $q = "SELECT l.date_created,u.full_name, u.src, l.id_who,l.id_whom,l.stars,l.message FROM likes l JOIN users u ON l.id_who = u.id
    WHERE u.date_deleted IS NULL AND l.id_whom = $id_user AND u.date_deleted IS NULL AND u.active = 1";

    return $conn->query($q)->fetchAll();

}

function verificationLike($id_user,$id_whom){
    global $conn;
    $q = "SELECT COUNT(*) as num FROM likes WHERE id_who = :id_user AND id_whom = :id_whom";

    $stm = $conn->prepare($q);

    $stm->bindParam(":id_user",$id_user);
    $stm->bindParam(":id_whom",$id_whom);

    $stm->execute();
    $res = $stm->fetch();

    return $res->num;
}


function InsertLike($id_user,$id_whom,$text,$stars){
    global $conn;

    try{

    $q = "INSERT INTO likes (id_who, id_whom, message, stars) VALUES (:id_who,:id_whom,:mess,:stars)";
    $stm = $conn->prepare($q);
    $stm->bindParam(":id_who",$id_user); 
    $stm->bindParam(":id_whom",$id_whom); 
    $stm->bindParam(":mess",$text); 
    $stm->bindParam(":stars",$stars);
    $stm->execute();

    return true;
    }catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
        return false;
    }
    
    
}


function InsertDeleteFavorites($id_post,$id_user){
    global $conn;

    try{
        $exist = $conn->query("SELECT COUNT(*) as num FROM favorites WHERE id_post = $id_post AND id_user = $id_user")->fetch()->num;

        if($exist > 0){
            $res = $conn->query("DELETE  FROM favorites WHERE id_post = $id_post AND id_user = $id_user");
        }else{
            $res = $conn->query("INSERT INTO favorites  (id_post,id_user) VALUES ($id_post,$id_user)");

        }
        return true;
    }
    catch(PDOException $e){

     return false;
    }

}

function IsFavorite($id_post){
    global $conn;
    $id_post = (int)$id_post;
    $id_user = $_SESSION['user']->id;
    $exist = $conn->query("SELECT COUNT(*) as num FROM favorites WHERE id_post = $id_post AND id_user = $id_user")->fetch()->num;

    if($exist > 0 ) return true;
    else return false;

}


function GetNumFavoritePost($id_user){
    global $conn;
    
    $id_user = $_SESSION['user']->id;
    $num = $conn->query("SELECT COUNT(*) as num FROM favorites WHERE  id_user = $id_user")->fetch()->num;

    return $num;

}


function FavoritePosts($id,$limit){
    global $conn;
    

    $q = "SELECT *,p.id as 'post_id' From posts p JOIN categories c ON p.id_category = c.id JOIN favorites fav ON fav.id_post = p.id WHERE date_deleted IS NULL AND fav.id_user = ".$id." LIMIT ". $limit.",10";

    

    return $conn->query($q)->fetchAll();



}

function DeleteLike($id_whom,$id_who){
    global $conn;

    $q = "DELETE FROM likes WHERE id_who = $id_who AND id_whom = $id_whom";
    try{
        $conn->query($q);
        return true;
    }catch(PDOException $e){
        return false;
    }
    
}
/*END*/


function UsersPostForId($id,$limit){
    global $conn;
    

    $q = "SELECT *,p.id as 'post_id' From posts p JOIN categories c ON p.id_category = c.id WHERE date_deleted IS NULL AND p.id_user = ".$id." LIMIT ". $limit.",10";

    

    return $conn->query($q)->fetchAll();



}



function GetPriceForPost($id){
    global $conn;
    

    $q = "SELECT * From prices WHERE id_post = $id AND date_deleted IS NULL ORDER BY date_created DESC LIMIT 0,1";


    return $conn->query($q)->fetch();
}

function GetCurrencyForPrice($id_currency){
    global $conn;
    

    $q = "SELECT * From currencies WHERE id = $id_currency" ;


    return $conn->query($q)->fetch();

}

function GetFullPriceForPost($id_post){
    global $conn;

    $q = "SELECT * FROM posts p JOIN price_statuses ps ON p.id_price_status = ps.id
        LEFT JOIN prices pp ON pp.id_post = p.id LEFT JOIN currencies cu ON pp.id_currency = cu.id
        WHERE p.id = $id_post AND p.date_deleted IS NULL ORDER BY pp.date_created DESC LIMIT 0,1";

    return $conn->query($q)->fetch();
}

function GetPromotionsForId($id_user,$id_post){

    global $conn;
    

    $q = "SELECT * ,p.id as 'promotion_id' From promotions p JOIN invoices i ON i.id_promotion = p.id WHERE id_post = $id_post AND id_user = $id_user  ORDER BY date_start DESC LIMIT 0,1";


    return $conn->query($q)->fetch();

}

function GetSubcategoryForPost($id_post){
    global $conn;
    

    $q = "SELECT * From posts p JOIN categories c ON p.id_category = c.id WHERE date_deleted IS NULL AND p.id = $id_post LIMIT 0,1 ";


    return $conn->query($q)->fetch();
}

function GetPriceStatusForPost($id_post){
    global $conn;
    

    $q = "SELECT *,p.status as 'price_status' From price_statuses p JOIN posts po ON p.id = po.id_price_status WHERE date_deleted IS NULL AND po.id = $id_post LIMIT 0,1 ";


    return $conn->query($q)->fetch();
}

function GetStateForPost($id_post){
    global $conn;
    

    $q = "SELECT * From posts p JOIN states s ON p.id_state = s.id WHERE date_deleted IS NULL AND p.id = $id_post LIMIT 0,1 ";


    return $conn->query($q)->fetch();

}


function GetImagesForPost($id_post){
    global $conn;
    

    $q = "SELECT * From images  WHERE id_post = $id_post  ";


    return $conn->query($q)->fetchAll();

}


function DeleteAllImagesForPost($id_post){
    global $conn;
    

    $q = "DELETE FROM images  WHERE id_post = $id_post  ";
    $q2 = "UPDATE posts SET src = '', min_src='' WHERE id = $id_post ";


    $conn->query($q);
    $conn->query($q2);
}

function UpdatePost($title,$desc,$state,$price_status,$delivery,$subcategory,$src,$min_src,$id_post,$id_user,$price,$currency){
    $title = addslashes(trim($title));
    $desc = addslashes(trim($desc));
    $id_state = (int)$state;
    $id_price_status = (int)$price_status;
    
    $id_subcategory = (int)$subcategory;
    $id_delivery = (int)$delivery;
    $id_user = $_SESSION['user']->id;

   

    if($src == null){
        $src = "user-image/empty.png";
        $min_src = "user-image/min-empty.png";
    }
    


    global $conn;
    $query = "UPDATE  posts SET title = :title, description = :description, id_state = :id_state, id_price_status = :id_price_status,
             src = :src, min_src = :min_src, id_user = :id_user, id_delivery =:id_delivery, id_category = :id_subcategory
            WHERE id = $id_post AND id_user = $id_user";


    

    $stm = $conn->prepare($query);
    $stm->bindParam(":title",$title);
    $stm->bindParam(":description",$desc);
    $stm->bindParam(":id_state",$id_state);
    $stm->bindParam(":id_price_status",$id_price_status);
    $stm->bindParam(":src",$src);
    $stm->bindParam(":min_src",$min_src);
    $stm->bindParam(":id_user",$id_user);
    $stm->bindParam(":id_delivery",$id_delivery);
    $stm->bindParam(":id_subcategory",$id_subcategory);



    try{
    $stm->execute();
        
    

    if($price != null && $price_status != 'Gift'){
        $q = "INSERT INTO prices (id_post,price,id_currency) VALUES( '$id_post', :price, :id_currency)";

        $stm = $conn->prepare($q);
        $stm->bindParam(":price", $price);
        $stm->bindParam(":id_currency", $currency);
        $stm->execute();
    }

    return true;

    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage() . "CODE: ".$e->getCode();
        return false;
        /*return [
            "error" => $e,
            "activation_link" => null
        ];*/
    }




}

function UpdateUser($id_user,$full_name,$email,$adress,$src){
    global $conn;

    $q = "UPDATE users SET full_name = :full_name, email = :email, adress = :adress, src = :src WHERE id = :id_user AND date_deleted IS NULL" ;

    $stm = $conn->prepare($q);

    $stm->bindParam(":full_name",$full_name);
    $stm->bindParam(":email",$email);
    $stm->bindParam(":adress",$adress);
    $stm->bindParam(":src",$src);
    $stm->bindParam(":id_user",$id_user);
    

    $res = $stm->execute();
    return $res;


}



//ADD PHONE NUMBER FOR USERS

function AddPhone($val,$id_user){

    global $conn;

    $q1 = "SELECT COUNT(*) as num FROM phones WHERE id_user = :id_user" ;

    $stm1 = $conn->prepare($q1);
    $stm1->bindParam(":id_user",$id_user);
    $stm1->execute();
    $res1 = $stm1->fetch()->num;
    if($res1 >= 5){
        return false;
    }





    $q = "INSERT INTO phones (phone,id_user) VALUES(:val,:id_user)" ;

    $stm = $conn->prepare($q);

    $stm->bindParam(":val",$val);
    $stm->bindParam(":id_user",$id_user);

    
    try{
    $stm->execute();


    $res = $conn->lastInsertId();
    return $res;
    }catch(PDOException $e){
        return false;
    }

}

/*Home PAGE */
function  GetCategoriesWithMostProducts($limit){

    global $conn;
    $q = "SELECT c.id,c.id_parrent, c.category,ci.icon, COUNT(*) as  num
    FROM categories c 
    JOIN posts p ON p.id_category = c.id
    JOIN category_icons ci ON c.id_parrent = ci.id_category
    WHERE p.date_deleted IS NULL
    GROUP BY c.id, c.category, ci.icon
    ORDER BY num DESC LIMIT 0, $limit;";

    return $conn->query($q)->fetchAll();


}

function GetTopAds(){
    global $conn;

    $q = "SELECT *,p.src as src, p.min_src as min_src ,c.category as category ,p.date_created as date_created,p.description as description ,p.id as post_id, i.date_start as date_start, i.date_end as date_end, pp.promotion as promotion FROM  
    posts p JOIN categories c ON p.id_category = c.id  JOIN invoices i ON p.id = i.id_post  JOIN
     promotions pp ON i.id_promotion =  pp.id 
     JOIN users usr ON usr.id = p.id_user
      JOIN states stat ON p.id_state = stat.id
        WHERE p.date_deleted IS NULL AND  usr.date_deleted IS NULL AND usr.active = 1 AND
    i.date_end > CURDATE() AND pp.promotion LIKE 'On home page'  ORDER BY pp.id DESC";

    $q2 = "SELECT COUNT(*) as num FROM posts pp JOIN invoices i ON pp.id = i.id_post JOIN promotions p ON i.id_promotion = p.id
     WHERE i.date_end > CURDATE() AND p.promotion LIKE 'On home page' AND pp.date_deleted IS NULL ";
     
     
    $res = $conn->query($q)->fetchAll();
    $res2 = $conn->query($q2)->fetch()->num;


    return [
        "arr" => $res,
        "num" => $res2
    ];


}

function GetNumLikesForPost($id_user){
    global $conn;

    $q = "SELECT SUM(stars) as sam, COUNT(stars) as num  FROM likes WHERE id_whom = $id_user";
    $res = $conn->query($q)->fetch();


    return $res;
}

function GetNumPostForCategory($id_category){
    global $conn;


    $q = "SELECT COUNT(p.id) as num FROM posts p JOIN categories c ON p.id_category = c.id JOIN users u ON p.id_user = u.id
    WHERE p.date_deleted IS NULL AND u.date_deleted IS NULL AND u.active = 1 AND (c.id_parrent = $id_category OR p.id_category = $id_category)";

    return $conn->query($q)->fetch()->num;



}





function GetSubCategoryAndNumberPost($id_category){
    global $conn;

    $q = "SELECT c.category as category , c.id as id, COUNT(p.id) as num FROM categories c  
    LEFT JOIN posts p ON p.id_category = c.id
    WHERE p.date_deleted IS NULL AND c.id_parrent = $id_category
    GROUP BY c.category , c.id";

    return $conn->query($q)->fetchAll();
}



/* Pagination */

function GetNumPost($id_user){
    global $conn;
   
   
    

    $q = "SELECT COUNT(*) as 'num' FROM posts WHERE id_user =  $id_user AND date_deleted IS NULL " ;

    


    $res = $conn->query($q)->fetch();

    if($res->num != null) return $res->num;
    else return 0;



}






/*Delete */

function DeletePost($id_post,$id_user){
    global $conn;
    $date = date('Y-m-d H:i:s');
   
    

    $q = "UPDATE posts SET date_deleted = '".$date. "' WHERE id_user = $id_user AND id =". $id_post  ;

    


    $conn->query($q);
    
}

function DeleteProfile($id_user){
    global $conn;
    $time = date(time());
    $q = "UPDATE users SET date_deleted = '".$time."' WHERE id = $id_user";
    $conn->query($q);
}

function PhoneIsUsers($id_user,$id_phone){
    global $conn;

    try{
    $q = "SELECT COUNT(*) as num FROM phones WHERE id = $id_phone AND id_user = $id_user";
    
    $res = $conn->query($q)->fetch()->num;

    if($res == 0) return true;
    else  return true;
    
    }catch(PDOException $e){
        return false;
    }


}


function DeletePhone($id_phone){
    global $conn;
    
    try{
    $q = "DELETE FROM phones WHERE id = $id_phone";
    
    $res = $conn->query($q);

   
     return true;
    
    }catch(PDOException $e){
        return false;
    }


}
function IsExistPhone($val){
    global $conn;
    $val = addslashes($val);
    try{
    $q = "SELECT COUNT(*) as  'num' FROM phones WHERE phone LIKE :val";

    $stm = $conn->prepare($q);
    $stm->bindParam(":val",$val);

    
    $stm->execute();
    $res = $stm->fetch()->num;
    
    if((int)$res > 0){
        return false;
    }
    else return true;
    }catch(PDOException $e){
        return false;
    }

}

?>