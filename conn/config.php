<?php
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    $user = "root";
    $pass = "";
    $selectDb = "jsfix";
    $host = "localhost";    
    $db = new PDO('mysql:host='.$host.';dbname='.$selectDb.';charset=utf8',$user,$pass);
    require_once("library.php");
    require_once("ClassLogin.php");

    $login = new Login();
?>