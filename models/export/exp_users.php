<?php

require_once("../../config/config.php");
require_once("../connection.php");
require_once("../admin/function.php");
require_once("../function.php");



session_start();
if(!isset($_SESSION['user'])){
    http_response_code(401);

    exit;
}else{
    if($_SESSION['user']->role != 'admin'){
        http_response_code(401);
        exit;
    }
}


$res = GetAllUsers();
$users = $res['users'];

    header("Content-Disposition: attachment; filename=users.xls");
    header("Content-Type: application/x-msexcel");
    header('Content-Type: application/vnd.ms-excel');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header("Pragma: no-cache");
    $export_string = "Id\tName\tNumber-post\tDate-created\n";
    foreach($users as $el) {
        $export_string .= $el->id . "\t" . $el->full_name . "\t" . GetNumPost($el->id) . "\t" . $el->date_created
        ."\n";
    }
    echo $export_string;