<?php
require_once 'conn/config.php';
$login_status = $login->cek_login();
if ($login_status) {
    header("location:dashboard.php");
}else{
    include "login.php";
}
?>