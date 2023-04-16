<?php
include '../../config/koneksi.php';
$id = $_POST['id'];
$nama_mapel = $_POST['nama_mapel'];
$id_guru = $_POST['id_guru'];
$kelas = $_POST['kelas'];
$query = "UPDATE mata_pelajaran SET 
      nama_mapel = '$nama_mapel', 
      id_guru = '$id_guru',
	  kelas = '$kelas'";
$query .= "WHERE id_pelajaran = '$id'";
$result = mysqli_query($koneksi, $query);
if (!$result) {
  die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>alert('Data berhasil diubah.');window.location='../data_mapel.php';</script>";
}