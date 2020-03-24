<?php
    include "conn/config.php";
    $username = $_SESSION['SES_USER'];
    $oldPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    $conPass = $_POST['conPass'];
    $passHash = password_hash($newPass, PASSWORD_DEFAULT);
    
    if (isset($_POST['simpan'])) {
        $cek = $db->query("SELECT * FROM tb_admin WHERE username = " . $db->quote($username));

        if ($cek->rowCount() > 0) {
            $row = $cek->fetch();
            $password_db = $row['password'];

            if (password_verify($oldPass, $password_db)) {
                if ($newPass != $conPass) {
                    echo "<script>alert('Confirm Password Salah ');document.location.href='dashboard.php?menu=change-pass'</script>";
                }else{
                    $sql = "UPDATE tb_admin SET password = :password WHERE username = " .$db->quote($username);
                    $pdo_statement = $db->prepare($sql);
                    $result = $pdo_statement->execute(array(
                        ':password' => $passHash
                    ));
                    if (!empty($result)) {
                        echo "<script>alert('Data Berhasil Diupdate');document.location.href='dashboard.php'</script>";
                    }
                }
            } else {
                echo "<script>alert('Password Lama Salah');document.location.href='dashboard.php?menu=change-pass'</script>";
            }
        } else {
            echo "<script>alert('User tidak terdaftar');document.location.href='logout.php'</script>";
        }
    }
?>