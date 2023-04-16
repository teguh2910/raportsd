<?php
include '../../config/koneksi.php';
$id_guru = $_POST['id'];
$tgl = $_POST['tanggal'];
$query = "SELECT * FROM presensi WHERE tgl='$tgl'";
$result = mysqli_query($koneksi, $query);
$cek = mysqli_num_rows($result);
if ($cek > 0) {
  echo "<script>alert('Data sudah ada.');window.location='../data_presensi.php';</script>";
} else {

  $query1 = "SELECT * FROM siswa INNER JOIN guru ON siswa.kelas = guru.kelas WHERE guru.id_guru='$id_guru'";
  $result1 = mysqli_query($koneksi, $query1);
  while ($data = mysqli_fetch_assoc($result1)) {
    $id_siswa = $data['id_siswa'];
    $query = "INSERT INTO presensi (id_siswa,tgl) 
    VALUES ('$id_siswa', '$tgl')";
    $result = mysqli_query($koneksi, $query);
  }
  echo "<script>alert('Data berhasil ditambah.');window.location='../data_presensi.php';</script>";
}