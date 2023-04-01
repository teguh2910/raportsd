<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $id_presensi= $_POST['pk'];
  $presensi= $_POST['value'];  
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE presensi_siswa SET 
      presensi = '$presensi'";
      $query .= "WHERE id_presensi = '$id_presensi'";
      $result = mysqli_query($koneksi, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      }