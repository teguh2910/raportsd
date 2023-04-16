<?php
include '../../config/koneksi.php';
$id = $_POST['id'];
$id_siswa = $_POST['id_siswa'];
$id_pelajaran = $_POST['id_pelajaran'];
$nilai_harian = $_POST['nilai_harian'];
$semester = $_POST['semester'];
$tahun = $_POST['tahun'];
$nilai_uts = $_POST['nilai_uts'];
$nilai_uas = $_POST['nilai_uas'];
$keterangan = $_POST['keterangan'];
$query = 
      "UPDATE nilai SET 
      id_siswa = '$id_siswa', 
      id_pelajaran = '$id_pelajaran',
      nilai_harian = '$nilai_harian',
      semester = '$semester',
      tahun = '$tahun',
      nilai_uts = '$nilai_uts',
      nilai_uas = '$nilai_uas',
      keterangan = '$keterangan'";
$query .= "WHERE id_nilai = '$id'";
$result = mysqli_query($koneksi, $query);
if (!$result) {
  die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>alert('Data berhasil diubah.');window.location='../data_nilai.php';</script>";
}