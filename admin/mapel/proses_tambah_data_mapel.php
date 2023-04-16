<?php
include '../../config/koneksi.php';
$nama_mapel = $_POST['nama_mapel'];
$id_guru = $_POST['id_guru'];
$kelas = $_POST['kelas'];
$query = "INSERT INTO mata_pelajaran (nama_mapel,id_guru,kelas) 
    VALUES ('$nama_mapel', '$id_guru', '$kelas')";
$result = mysqli_query($koneksi, $query);
if (!$result) {
  die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>alert('Data berhasil ditambah.');window.location='../data_mapel.php';</script>";
}