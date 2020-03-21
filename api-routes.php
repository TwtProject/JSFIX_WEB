<?php
    require_once 'conn/config.php';
    $login->login_redir();
    class API {
    var $db;
        function selectData() {
        global $db;
        $this->db = $db;
            $products = array();
            $data = $db->prepare('SELECT * FROM tb_produk ORDER BY id LIMIT 6');
            $data->execute();
            while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
                $products[] = [
                    'id' => $OutputData['id'],
                    'nama_produk' => $OutputData['nama_produk'],
                    'link' => $OutputData['link'],
                    'gambar' => $OutputData['gambar']
                ];
            }
            $data2 = $db->prepare('SELECT * FROM tb_setting ORDER BY id LIMIT 1');
            $data2->execute();
            $result2 = $data2->fetchAll();
            $status = array(
                'status' => "true",
                'message' => "Data fetch successfully",
                'nomor' => $result2[0][1],
                'isi' => $result2[0][2],
                'data' => $products
            );
            return json_encode($status);
        }
        
    }
    
    $API = new API;
    header('Content-Type: application/json');
    echo $API->selectData();

    
?>