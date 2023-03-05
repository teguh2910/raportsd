<?php
include '../../config/koneksi.php';
$id = $_GET["id_nilai"];
//mengambil id yang ingin dihapus

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM nilai_siswa WHERE id_nilai='$id' ";
    $hasil_query = mysqli_query($koneksi, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($koneksi).
       " - ".mysqli_error($koneksi));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='../data_nilai.php';</script>";
    }