<?php
require_once 'conn/config.php';
if (!empty($_POST["add_data"])) {
    $sql = "INSERT INTO tb_produk (nama_produk, link, gambar) VALUES (:nama_produk, :link, :gambar)";
    $pdo_statement = $db->prepare($sql);
    $result = $pdo_statement->execute(array(
        ':nama_produk' => $_POST['nama_produk'],
        ':link' => $_POST['link'],
        ':gambar' => $_POST['gambar']
    ));
    if (!empty($result)) {
        echo "<script>alert('Data Berhasil Disimpan');document.location.href='dashboard.php?menu=product'</script>";
    }
    
}
if (!empty($_POST["update_data"])) {
    $sql = "UPDATE tb_produk SET nama_produk = :nama_produk, link = :link, gambar = :gambar WHERE id = '$_GET[id]'";
    $pdo_statement = $db->prepare($sql);
    $result = $pdo_statement->execute(array(
        ':nama_produk' => $_POST['nama_produk'],
        ':link' => $_POST['link'],
        ':gambar' => $_POST['gambar']
    ));
    if (!empty($result)) {
        echo "<script>alert('Data Berhasil Diupdate');document.location.href='dashboard.php?menu=product'</script>";
    }
}
if (isset($_GET["edit"])) {
    $sql = "SELECT * FROM tb_produk WHERE id = '$_GET[id]'";
    $pdo_statement = $db->prepare($sql);
    $pdo_statement->execute();
    $result = $pdo_statement->fetchAll();
}
if (isset($_GET["hapus"])) {
    $sql = "DELETE FROM tb_produk WHERE id = '$_GET[id]'";
    $pdo_statement = $db->prepare($sql);
    $result = $pdo_statement->execute();
    if (!empty($result)) {
        echo "<script>alert('Data Berhasil Dihapus');document.location.href='dashboard.php?menu=product'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="plugin/bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <br><br>
            <div class="col-sm-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Input Product
                    </div>
                    <div class="panel-body">
                        <form method="post">
                            <fieldset>
                                <div class="form-group">
                                    <label>Nama Product</label>
                                    <input type="text" class="form-control" name="nama_produk" value="<?php echo @$result[0][1] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Link Product</label>
                                    <input type="text" class="form-control" name="link" value="<?php echo @$result[0][2] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Gambar Product</label>
                                    <input type="text" class="form-control" name="gambar" value="<?php echo @$result[0][3] ?>">
                                </div>
                                <?php if (isset($_GET['edit'])) {  ?>
                                    <input type="submit" class="btn btn-block btn-primary" name="update_data" value="Update">
                                <?php } else {  ?>
                                    <input type="submit" class="btn btn-block btn-primary" name="add_data" value="Simpan">
                                <?php   } ?>

                            </fieldset>
                        </form>
                    </div>
                    <div class="panel-footer">

                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="table-responsive">
                    <table class="table table-basic">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Link</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM tb_produk";
                            $pdo_statement = $db->prepare($sql);
                            $pdo_statement->execute();
                            $result = $pdo_statement->fetchAll(PDO::FETCH_OBJ);
                            $count = 1;
                            if (!empty($result)) {
                                foreach ($result as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo htmlentities($row->nama_produk) ?></td>
                                        <td><?php echo htmlentities($row->link) ?></td>
                                        <td><?php echo htmlentities($row->gambar) ?></td>
                                        <td><a href="dashboard.php?menu=product&edit&id=<?php echo htmlentities($row->id) ?>">
                                                <div class="text-center">
                                                    <span class="glyphicon glyphicon-edit"></span>
                                                </div>
                                            </a>
                                        </td>
                                        <td><a href="dashboard.php?menu=product&hapus&id=<?php echo htmlentities($row->id) ?>" onclick="return confirm('Are you sure to delete ?');">
                                                <div class="text-center">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                            $count++;
                            }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>