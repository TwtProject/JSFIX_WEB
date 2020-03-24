<?php 
    include "conn/config.php";

    if ($login->cek_salah_login() == false) {
        create_alert("error", "Mohon Maaf, Login di Block. <br> Silahkan hubungi administrator", "index.php");
    }

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $cek = $db->query("SELECT * FROM tb_admin WHERE username = ".$db->quote($username));

        if ($cek->rowCount() > 0) {
            $row = $cek->fetch();
            $password_db = $row['password'];

            if (password_verify($password, $password_db)) {
                $login->true_login($username);
                create_alert("success", "Login Berhasil", "index.php");
            }else{
                $login->salah_login_action($username);
                create_alert("error", "Username atau Password Salah", "index.php");
            }
        }else{
            $login->salah_login_action($username);
            create_alert("error", "Username tidak terdaftar", "index.php");
        }
    }
?>
