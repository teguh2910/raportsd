<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $nama_guru    = $_POST['nama_guru'];
  $jabatan         = $_POST['jabatan'];
  $password         = $_POST['password'];
    $query = "INSERT INTO data_guru (nama_guru, jabatan, password) 
    VALUES ('$nama_guru', '$jabatan', '$password')";
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='../data_guru.php';</script>";
                  }