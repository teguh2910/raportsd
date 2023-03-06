<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $id = $_POST['id'];
  $nama_guru  = $_POST['nama_guru'];
  $jabatan  = $_POST['jabatan'];
  $password = $_POST['password'];
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE data_guru SET 
      nama_guru = '$nama_guru', 
      jabatan = '$jabatan',
      password = '$password'";
      $query .= "WHERE id_guru = '$id'";
      $result = mysqli_query($koneksi, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='../data_guru.php';</script>";
      }