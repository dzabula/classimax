<?php
    session_start();
    
    header("Location: ../index.php?page=home");
    
    if(isset($_SESSION['user'])){
        unset($_SESSION['user']);
    }

?>