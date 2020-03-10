<?php
    require_once __DIR__ . '/config.php';
    class API {
        function selectData() {
            $db = new Connect;
            $products = array();
            $data = $db->prepare('SELECT * FROM tb_produk');
            $data->execute();
            while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
                $products[$OutputData['id']] = array(
                    'id' => $OutputData['id'],
                    'nama_produk' => $OutputData['nama_produk'],
                    'link' => $OutputData['link'],
                    'gambar' => $OutputData['gambar']
                );
            }
            return json_encode($products);
        }
    }

    $API = new API;
    header('Content-Type: application/json');
    echo $API->selectData();
?>