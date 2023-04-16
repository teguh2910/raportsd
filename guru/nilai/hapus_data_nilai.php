<?php
include '../../config/koneksi.php';
$id = $_GET["id_nilai"];
$query = "DELETE FROM nilai WHERE id_nilai='$id' ";
$hasil_query = mysqli_query($koneksi, $query);
if (!$hasil_query) {
  die("Gagal menghapus data: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>alert('Data berhasil dihapus.');window.location='../data_nilai.php';</script>";
}