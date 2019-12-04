<?php
require 'functions.php'; // memanggil function
$gudang = query("SELECT * FROM gudang");
// tombol cari ditekan
if (isset($_POST["cari"])) {
    $gudang = cari($_POST["keyword"]); // ambil apapun yang diketi user masukkan kedalam function cari
}

// cek apakah tabel db ada, kalau tidak tampilkan alert
if (!$gudang) {
    echo mysqli_error($conn);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Admin</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <div class="container">
        <h2>Data Barang</h2>
    </div>
    <a href="tambah.php">Tambah data</a>
    <br>

    <!-- Search -->
    <form action="" method="post">
        <div class="form-group">
            <input type="text" name="keyword" size="30" autofocus placeholder="Masukkan pencarian.." autocomplete="off">
            <button type="submit" name="cari" class="btn btn-success">Cari!</button>
        </div>
    </form>
    <!-- end of search -->


    <br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Id</th>
            <th>Actions</th>
            <th>Gambar</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Besaran</th>
            <th>Wadah</th>
            <th>Posisi</th>
        </tr>

        <?php $i = 1; // pengganti 'id' agar auto increment
        ?>
        <?php foreach ($gudang as $row) : ?>
            <tr>
                <td>
                    <?= $i; ?>
                </td>
                <td>
                    <a href="ubah.php?id=<?= $row["id"]; ?>">Change</a> |
                    <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Delete</a>
                </td>
                <td><img src="img/<?= $row["gambar"] ?>" alt="" srcset="" width="80"></td>
                <td><?= $row["namabarang"] ?></td>
                <td><?= $row["jumlah"] ?></td>
                <td><?= $row["besaran"] ?></td>
                <td><?= $row["wadah"] ?></td>
                <td><?= $row["posisi"] ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

    </table>
</body>

</html>