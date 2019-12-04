<?php
require 'functions.php';

// ambil data di URL

$id = $_GET["id"];

//query data barang berdasarkan id nya
$gdg = query("SELECT * FROM gudang WHERE id = $id")[0];





// cek apakah tombol submit sudah ditekan?
if (isset($_POST["submit"])) {

    // cek apakah data berhasil di ubah atau tidak
    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href='index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal diubah!');
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
    <title>Ubah data gudang</title>
</head>

<body>
    <h1>Ubah Data</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $gdg["id"]; ?>">
        <input type="hidden" name="gambarlama" value="<?= $gdg["gambar"]; ?>">
        <ul>
            <li>
                <label for="namabarang">Nama barang :</label>
                <input type="text" name="namabarang" id="namabarang" required value="<?= $gdg["namabarang"]; ?>">
            </li>
            <li>
                <label for="jumlah">Jumlah :</label>
                <input type="text" name="jumlah" id="jumlah" value="<?= $gdg["jumlah"]; ?>">
            </li>
            <li>
                <label for=" besaran">Besaran :</label>
                <input type="text" name="besaran" id="besaran" value="<?= $gdg["besaran"]; ?>">
            </li>
            <li>
                <label for=" wadah">Wadah :</label>
                <input type="text" name="wadah" id="wadah" value="<?= $gdg["wadah"]; ?>">
            </li>
            <li>
                <label for=" posisi">Posisi :</label>
                <input type="text" name="posisi" id="posisi" value="<?= $gdg["posisi"]; ?>">
            </li>
            <li>
                <label for=" gambar">Gambar :</label> <br>
                <img src="img/<?= $gdg["gambar"]; ?>" alt="" width="100"> <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type=" submit" name="submit" class="btn btn-success">Ubah Data</button>
            </li>
        </ul>
        <a href="index.php">Batal</a>
    </form>
</body>

</html>