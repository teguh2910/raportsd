<?php
include '../../config/koneksi.php';

$id = $_POST['id'];
$id_siswa = $_POST['id_siswa'];
$ekskul = $_POST['ekskul'];
$keterangan = $_POST['keterangan'];
$query = "UPDATE ekstrakurikuler SET 
      id_siswa = '$id_siswa', 
      ekskul = '$ekskul',
      keterangan = '$keterangan'";
$query .= "WHERE id_ekskul = '$id'";
$result = mysqli_query($koneksi, $query);
if (!$result) {
  die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>alert('Data berhasil diubah.');window.location='../data_ekskul.php';</script>";
}