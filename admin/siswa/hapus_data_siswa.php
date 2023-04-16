<?php
include '../../config/koneksi.php';
$id = $_GET["id_siswa"];
$query = "DELETE FROM siswa WHERE id_siswa='$id' ";
$hasil_query = mysqli_query($koneksi, $query);
if (!$hasil_query) {
  die("Gagal menghapus data: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>alert('Data berhasil dihapus.');window.location='../data_siswa.php';</script>";
}