<?php
    include "conn/config.php";
    $username = "admin";
    $password = "admin123";
    $nama = "Admin 123";
    $email = "admin@gmail.com";
    $akses = "1";
    $hash = password_hash($password, PASSWORD_DEFAULT);
            $save = $db->prepare("INSERT INTO tb_admin VALUES (?, ?, ?, ?, ?)");
            $save->execute(array(
                $username, $hash, $nama, $email, $akses
            ));
?>