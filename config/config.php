<?php

$arr = file($_SERVER['DOCUMENT_ROOT']."/config/.env");
$arr[0] = explode("=",$arr[0])[1];
$arr[1] = explode("=",$arr[1])[1];
$arr[2] = explode("=",$arr[2])[1];
$arr[3] = explode("=",$arr[3])[1];

define("SERVER_NAME",trim($arr[0]) );
define("DATABASE_NAME",trim($arr[1]) );
define("USERNAME",trim($arr[2] ));
define("PASSWORD",trim($arr[3]));


?>