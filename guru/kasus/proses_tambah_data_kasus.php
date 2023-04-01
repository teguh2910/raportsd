<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

// membuat variabel untuk menampung data dari form
$id_siswa    = $_POST['id_siswa'];
$ekskul = $_POST['ekskul'];
$keterangan = $_POST['keterangan'];
$query = "INSERT INTO extra_siswa (id_siswa,ekskul,keterangan) 
    VALUES ('$id_siswa', '$ekskul', '$keterangan')";
$result = mysqli_query($koneksi, $query);
// periska query apakah ada error
if (!$result) {
  die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>alert('Data berhasil ditambah.');window.location='../data_kasus.php';</script>";
}
