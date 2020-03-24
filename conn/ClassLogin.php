<?php 
    class Login
    {
        var $db;

        public function __construct()
        {
            global $db;
            $this->db = $db;
        }

        public function cek_login()
        {
            if (isset($_COOKIE['adv_token'])) {
                $token = $_COOKIE['adv_token'];
                $now = date('Y-m-d H:i:s');
                $cek = $this->db->query("SELECT * FROM tb_admin_log WHERE token = ".$this->db->quote($token)." AND expired > ".$this->db->quote($now));
                if ($cek) {
                    $row = $cek->fetch();
                    if ($row['ip'] == $_SERVER['REMOTE_ADDR'] || $row['useragent'] == $_SERVER['HTTP_USER_AGENT']) {
                        $username = $row['username'];
                        $get_admin = $this->db->query("SELECT * FROM tb_admin WHERE username = ".$this->db->quote($username));
                        $rget = $get_admin->fetch();

                        return array(
                            "username" => $rget['username'],
                            "nama" => $rget['nama'],
                            "email" => $rget['email'],
                            "akses" => $rget['akses']
                        );
                    }else{
                        $this->logout();
                    }
                }
            }
            return false;
        }

        public function salah_login_action($username)
        {
            $tgl = date("Y-m-d H:i:s");
            $ip = $_SERVER['REMOTE_ADDR'];
            $useragent = $_SERVER['HTTP_USER_AGENT'];

            $save = $this->db->prepare("INSERT INTO tb_admin_log VALUES (NULL, ?, '', '', ?, ?, ?, 0)");
            $save->execute(array($tgl, $username, $ip, $useragent));
            return true;
        }

        public function cek_salah_login($limit = 3)
        {
            $ip = $_SERVER['REMOTE_ADDR'];
            $cek = $this->db->prepare("SELECT * FROM tb_admin_log WHERE stat = 0 AND ip = ?");
            $cek->execute(array($ip));
            if($cek->rowCount() >= $limit){
                return false;
            }
            return true;
        }

        public function true_login($username)
        {
            $tgl = date("Y-m-d H:i:s");
            $expiredDb = date("Y-m-d H:i:s",strtotime("+6 hours"));
            $ip = $_SERVER['REMOTE_ADDR'];
            $useragent = $_SERVER['HTTP_USER_AGENT'];
            $token = sha1($ip.$expiredDb."string_random".microtime());

            $upd = $this->db->query("UPDATE tb_admin_log SET stat = 9 WHERE token = '' AND ip = ".$this->db->quote($ip)." AND useragent = ".$this->db->quote($useragent));
            $save = $this->db->prepare("INSERT INTO tb_admin_log VALUES (NULL, ?, ?, ?, ?, ?, ?, 1)");
            $save->execute(array(
                $tgl, $expiredDb, $token, $username, $ip, $useragent
            ));

            $expr = 0;
	    setcookie("adv_token", $token, $expr, "/");
	    $_SESSION['SES_USER'] = $username;

            return true;
        }

        public function logout()
        {
            if (isset($_COOKIE['adv_token'])) {
                $token = $_COOKIE['adv_token'];
                $now = date('Y-m-d H:i:s');
                unset($_COOKIE['adv_token']);
                setcookie("adv_token",null,$now,"/");

                $this->db->query("UPDATE tb_admin_log SET expired = ".$this->db->quote($now)." WHERE token = ".$this->db->quote($token));
            }
            return true;
        }

        public function login_redir()
        {
            if (!$this->cek_login()) {
                header("location:index.php");
            }
        }

        public function create_admin($username, $password, $nama, $email, $akses)
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $save = $this->db->prepare("INSERT INTO tb_admin VALUES (?, ?, ?, ?, ?)");
            $save->execute(array(
                $username, $hash, $nama, $email, $akses
            ));
        }
    }
    
?>
