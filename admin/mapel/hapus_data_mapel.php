<?php
include '../../config/koneksi.php';
$id = $_GET["id_mapel"];
$query = "DELETE FROM mata_pelajaran WHERE id_pelajaran='$id' ";
$hasil_query = mysqli_query($koneksi, $query);
if (!$hasil_query) {
  die("Gagal menghapus data: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>alert('Data berhasil dihapus.');window.location='../data_mapel.php';</script>";
}