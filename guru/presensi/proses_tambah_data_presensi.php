<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

// membuat variabel untuk menampung data dari form
$id_guru       = $_POST['id'];
$tgl           = $_POST['tanggal'];

$query="SELECT * FROM presensi_siswa WHERE tgl='$tgl'";
$result = mysqli_query($koneksi, $query);
$cek = mysqli_num_rows($result);
if($cek > 0){
  echo "<script>alert('Data sudah ada.');window.location='../data_presensi.php';</script>";
}else{

$query1="SELECT * FROM data_siswa INNER JOIN data_guru ON data_siswa.kelas = data_guru.kelas WHERE data_guru.id_guru='$id_guru'";
$result1 = mysqli_query($koneksi, $query1);
while($data = mysqli_fetch_assoc($result1)){
  $id_siswa = $data['id_siswa'];
  $query = "INSERT INTO presensi_siswa (id_siswa,tgl) 
    VALUES ('$id_siswa', '$tgl')";
  $result = mysqli_query($koneksi, $query);
}
  echo "<script>alert('Data berhasil ditambah.');window.location='../data_presensi.php';</script>";
}