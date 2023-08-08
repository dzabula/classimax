<?php
    

    try {
     
        $conn = new PDO("mysql:host=".SERVER_NAME.";dbname=".DATABASE_NAME.";charset=utf8", USERNAME, PASSWORD);
    
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $ex){
       // echo $ex->getMessage();
    echo "Database doesn't work! Sorry.";
    
    }



?>