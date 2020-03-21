<?php 
    require "conn/config.php";
    $login->logout();
    create_alert("success", "Anda Berhasil Keluar","index.php");
?>