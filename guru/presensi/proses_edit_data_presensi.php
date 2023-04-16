<?php
include '../../config/koneksi.php';
$id_presensi = $_POST['pk'];
$presensi = $_POST['value'];
$query = "UPDATE presensi SET 
      presensi = '$presensi'";
$query .= "WHERE id_presensi = '$id_presensi'";
$result = mysqli_query($koneksi, $query);
if (!$result) {
  die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
}