<?php
require 'functions.php';
if (isset($_POST["submit"])) {
    // var_dump($_FILES); ini


    // cek apakah data berhasil di input atau tidak
    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambah!');
                document.location.href='index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambah!');
                document.location.href='index.php';
            </script>";
        var_dump(mysqli_affected_rows($conn));
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>input data gudang</title>
</head>

<body>
    <h1>Input Data</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <ul>
                <li>
                    <label for="namabarang">Nama barang :</label>
                    <input type="text" name="namabarang" id="namabarang" required>
                </li>
                <li>
                    <label for="jumlah">Jumlah :</label>
                    <input type="text" name="jumlah" id="jumlah">
                </li>
                <li>
                    <label for="besaran">Besaran :</label>
                    <input type="text" name="besaran" id="besaran">
                </li>
                <li>
                    <label for="wadah">Wadah :</label>
                    <input type="text" name="wadah" id="wadah">
                </li>
                <li>
                    <label for="posisi">Posisi :</label>
                    <input type="text" name="posisi" id="posisi">
                </li>
                <li>
                    <!-- <label for="gambar">Gambar :</label>
                    <input type="text" name="gambar" id="gambar"> -->
                    <label for="gambar">Gambar :</label>
                    <input type="file" name="gambar" id="gambar">
                </li>
                <li>
                    <button type="submit" name="submit" class="btn btn-success">Tambah Data</button>
                </li>
            </ul>
            <a href="index.php">Batal</a>
        </div>

    </form>
</body>

</html>