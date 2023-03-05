<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $nama_mapel    = $_POST['nama_mapel'];
  $id_guru         = $_POST['id_guru'];
    $query = "INSERT INTO mata_pelajaran (nama_mata_pelajaran,id_guru) 
    VALUES ('$nama_mapel', '$id_guru')";
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='../data_mapel.php';</script>";
                  }