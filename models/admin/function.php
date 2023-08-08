<?php 

function  GetAllRequest($limit){
    $arr = file($_SERVER['DOCUMENT_ROOT']."/config/request_prepaid.txt");
    $res = [];
   for($i = $limit ; $i< 20 ; $i++){
        if(isset($arr[$i])){

            $arr[$i] = trim($arr[$i]);

            $row = explode("/",$arr[$i]);
            $id = explode("=",$row[0])[1];
            $send = explode("=",$row[2])[1];
    
            $prepaid = explode("=",$row[1])[1];
    
        
            $x = [
                    "id" => $id,
                    "prepaid" => $prepaid,
                    "send" => $send
                ];
            array_push($res,$x);
            
        }

   }
   return $res;


}

function DeletePrepaidRequest($id_user){
    
    $arr = file($_SERVER['DOCUMENT_ROOT']."/config/request_prepaid.txt");
    $str = "";
    for($i = 0 ; $i< count($arr) ; $i++){
            $row = explode("/",$arr[$i]);
            $id = explode("=",$row[0])[1];

        
            if($id != $id_user){
                $str .= $arr[$i];

            }


    }

    $f = fopen($_SERVER['DOCUMENT_ROOT']."/config/request_prepaid.txt", "w");

    fwrite($f,$str);

    fclose($f);
}

function AllowPrepaidRequest($id_user,$prepaid){
    global $conn;

    DeletePrepaidRequest($id_user);

    $q1 = "SELECT prepaid FROM prepaids WHERE id_user = $id_user ORDER BY date_created DESC LIMIT 0,1";
    $current_p = $conn->query($q1)->fetch();

    if(isset($current_p->prepaid)){
        $prepaid += $current_p->prepaid;
    }



    $q = "INSERT INTO prepaids (id_user,prepaid) VALUES(:id_user,:prepaid)";

    $stm = $conn->prepare($q);

    $stm->bindParam(":id_user",$id_user);
    $stm->bindParam(":prepaid",$prepaid);

    return $stm->execute();


}

function GetAllUsers(){

    global $conn;
    
    $arr['users']  = $conn->query("SELECT * FROM users JOIN roles ON id_role = role_id WHERE date_deleted IS NULL")->fetchAll();
    $arr['num'] = $conn->query("SELECT COUNT(*) as num FROM users WHERE date_deleted IS NULL")->fetch()->num;

    return $arr;

}

function BanReban($id_user,$active){

    global $conn ;
    if($active == 0){
        $q = "UPDATE users SET active = 1 WHERE id = $id_user";
        $message = "User are reban.";
    }else{
        $q = "UPDATE users SET active = 0 WHERE id = $id_user";
        $message = "User are ban.";
        
    }

    $conn->query($q);
    return $message;



}


function  UpdatePromotion($id,$duration,$price){
    global $conn;

    $q = "UPDATE promotions SET day_duration = :day_duration, price = :price WHERE id = :id";

    $stm = $conn->prepare($q);
    $stm->bindParam(":day_duration",$duration);
    $stm->bindParam(":price",$price);
    $stm->bindParam(":id",$id);

    return $stm->execute();




}
function GetLog24H(){
    $rows =  file($_SERVER['DOCUMENT_ROOT']."/log/log.txt");
    $res = [];

    $limit = time() - 60*60*24;
    foreach($rows as $el){
        $el = trim($el);
        $row = explode("/",$el)[2];

        $date = explode("=",$row)[1];

        if($date > $limit){
            array_push($res,$el);
        }
        
        


    }
    return $res;

}


function GetLogStatistic(){

    $rows =  file($_SERVER['DOCUMENT_ROOT']."/config/pages.txt");
    $statistic = [];
    $counting = [];
    foreach($rows as $i => $el){
        $el = trim($el);
        $page = explode("=",$el)[1];
        
        $statistic[$i] = [
            "page" => $page,
            "count" => 0,
            "percent" => 0
        ];
        $counting[$i] = [
            "page" => $page,
            "count" => 0
     
        ];


    }

    $logs = file($_SERVER['DOCUMENT_ROOT']."/log/log.txt");



    $sum_rows = floatval(count($logs));

    $logs24 = GetLog24H();
    

   

    foreach($logs as $i => $el){
        $el = trim($el);
        $p = explode("/",$el)[3];
        $p = explode("=",$p)[1];

        for($i = 0; $i < count($statistic) ; $i ++ ){
           
            if($p == $statistic[$i]['page']){
         
                $statistic[$i]['count'] += 1;

            }
        }

    }

    foreach($logs24 as $t => $el){
        $el = trim($el);
        $p = explode("/",$el)[3];
        $p = explode("=",$p)[1];

        for($i = 0; $i < count($counting) ; $i ++ ){
           
            if($p == $counting[$i]['page']){
         
                $counting[$i]['count'] += 1;

            }
        }

    }

   

    for($i = 0; $i < count($statistic) ; $i ++ ){
        $coun = floatval($statistic[$i]['count']);
        $percent  = $coun / $sum_rows * 100;


        $statistic[$i]['percent'] = $percent; 



    }


    return [
           "statistics" => $statistic,
           "counting" => $counting
    ];



}

function GetNumLogin24H(){
    $rows = file($_SERVER['DOCUMENT_ROOT']."/log/login.txt");
    $limit = time() - 60*60*24;
    $res= [];
    foreach($rows as $row){
        $row = trim($row);
        $date = explode("/",$row)[3];
        $date = explode("=",$date)[1];

        if($date > $limit){
            array_push($res,$row);
        }


    }
   
    return $res;

}