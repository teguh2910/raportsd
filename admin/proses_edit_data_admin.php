<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../config/koneksi.php';
session_start();
	// membuat variabel untuk menampung data dari form
  $id = $_POST['id'];
  $username  = $_POST['username'];
  $hak_akses  = $_POST['hak_akses'];
  $password  = $_POST['password'];
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE user SET 
      username = '$username', 
      hak_akses = '$hak_akses',
      password = '$password'";
      $query .= "WHERE id_user = '$id'";
      $result = mysqli_query($koneksi, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='data_admin.php';</script>";
      }