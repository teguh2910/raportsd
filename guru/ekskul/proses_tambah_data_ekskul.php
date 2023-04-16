<?php
include '../../config/koneksi.php';
$id_siswa = $_POST['id_siswa'];
$ekskul = $_POST['ekskul'];
$keterangan = $_POST['keterangan'];
$query = "INSERT INTO ekstrakurikuler (id_siswa,ekskul,keterangan) 
    VALUES ('$id_siswa', '$ekskul', '$keterangan')";
$result = mysqli_query($koneksi, $query);
// periska query apakah ada error
if (!$result) {
  die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>alert('Data berhasil ditambah.');window.location='../data_ekskul.php';</script>";
}