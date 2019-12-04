<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query)
{
    global $conn; // agar var conn menjadi global
    $result = mysqli_query($conn, $query);
    $rows = []; // membuat wadah untuk isi dari db
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows; // mengembalikan wadah
}



function tambah($data)
{
    global $conn;
    // ambil data
    // htmlspecialchars untuk mengolah sistem agar tidak membaca baris kode inputan pengguna
    // $gambar = htmlspecialchars($data["gambar"]); cara lama
    $namabarang = htmlspecialchars($data["namabarang"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $besaran = htmlspecialchars($data["besaran"]);
    $wadah = htmlspecialchars($data["wadah"]);
    $posisi = htmlspecialchars($data["posisi"]);

    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false; // kalau ketemu ini selesai sampai sini, insert dibawah tidak akan dieksekusi
    }

    // query insert data
    $query = "INSERT INTO gudang 
                VALUES 
                (NULL,'$gambar','$namabarang',$jumlah,'$besaran','$wadah','$posisi')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function upload()
{
    $namaFile = $_FILES['gambar'] /* gambar diambil dari name di file index */['name']; // diambil dari nama file gambar yang dihasilkan dari vardump folder tambah
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name']; // tempat penyimpanan sementaranya

    // cek apakah gambar tidak diupload
    if ($error === 4) {
        echo "<script>
        alert('Upload gambar terlebih dahulu!');
        </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $gambarvalid = ['jpg', 'jpeg', 'png'];
    $eksgambar = explode('.', $namaFile); // explode sebuah fungsi yang memecah sebuah string menjadi Array, memecahnya menggunakan delimiter. contoh kalwabed.jpeg=['kalwabed','jpeg']
    // $eksgambar = $eksgambar[1]; mengambil bagian yang terarah seperti kalwabed.[jpg]
    $eksgambar = strtolower(end($eksgambar)); // setelah mengambil bagian terakhir dari file, diubah menjadi huruf kecil semua
    if (!in_array($eksgambar, $gambarvalid)) {
        echo "<script>
        alert('Sistem tidak membaca adanya gambar!');
        </script>";
        return false;
    }

    // cek apakah ukuran gambar terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
        alert('Ukuran gambar terlalu besar!');
        </script>";
        return false;
    }

    // lolos pengecekan gambar siap diupload
    // generate nama gambar baru
    $namaFilebaru = uniqid(); // membangkitkan string random yang nantinya jadi nama gambar, tapi belum ada ekstensinya
    $namaFilebaru .= '.';
    $namaFilebaru .= $eksgambar;

    move_uploaded_file($tmpName, 'img/' . $namaFilebaru);
    return $namaFilebaru;
}




function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM gudang WHERE id = $id");
    return mysqli_affected_rows($conn);
}



function ubah($data)
{
    global $conn;
    // ambil data
    // htmlspecialchars untuk mengolah sistem agar tidak membaca baris kode inputan pengguna
    $id = $data["id"]; // id tidak perlu htmlspecial karena data tidak diinputkan oleh user
    $namabarang = htmlspecialchars($data["namabarang"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $besaran = htmlspecialchars($data["besaran"]);
    $wadah = htmlspecialchars($data["wadah"]);
    $posisi = htmlspecialchars($data["posisi"]);
    $gambarlama = ($data["gambarlama"]);

    // cek apakah user mengubah / pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) { // user tidak upload gambar apa-apa
        $gambar = $gambarlama;
    } else { // biasanya kalau ada gambarnya itu errornya 0
        $gambar = upload(); // jalankan fungsi upload
    }


    // query update data
    $query = "UPDATE gudang SET
                gambar='$gambar',
                namabarang='$namabarang',
                jumlah='$jumlah',
                besaran='$besaran',
                wadah='$wadah',
                posisi='$posisi'
                WHERE id=$id
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM gudang
                WHERE
                -- namabarang='$keyword' harus spesifik
                -- namabarang LIKE '%$keyword%' hanya namabarang yang akan tampil
                namabarang LIKE '%$keyword%'OR
                jumlah LIKE '%$keyword%' OR
                besaran LIKE '%$keyword%' OR
                wadah LIKE '%$keyword%' OR
                Posisi LIKE '%$keyword%'
    ";
    return query($query);
}
