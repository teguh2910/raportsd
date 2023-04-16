<?php
include '../../config/koneksi.php';
$id_siswa = $_POST['id_siswa'];
$id_pelajaran = $_POST['id_pelajaran'];
$nilai_harian = $_POST['nilai_harian'];
$nilai_uts = $_POST['nilai_uts'];
$nilai_uas = $_POST['nilai_uas'];
$semester = $_POST['semester'];
$tahun = $_POST['tahun'];
$keterangan = $_POST['keterangan'];
$query = "INSERT INTO nilai (id_siswa,id_pelajaran,nilai_harian,semester,tahun, nilai_uts, nilai_uas,keterangan) 
    VALUES ('$id_siswa', '$id_pelajaran', '$nilai_harian', '$semester', '$tahun', '$nilai_uts', '$nilai_uas','$keterangan')";
$result = mysqli_query($koneksi, $query);
if (!$result) {
  die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>alert('Data berhasil ditambah.');window.location='../data_nilai.php';</script>";
}