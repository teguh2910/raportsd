<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $nama_siswa    = $_POST['nama_siswa'];
  $kelas         = $_POST['kelas'];
  $alamat        = $_POST['alamat'];
  $password      = $_POST['password'];
  $nis          = $_POST['nis'];
  $jen_kel       = $_POST['jen_kel'];
    $query = "INSERT INTO data_siswa (nama_siswa, kelas, alamat, password, nis, jen_kel) 
    VALUES ('$nama_siswa', '$kelas', '$alamat', '$password', '$nis', '$jen_kel')";
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='../data_siswa.php';</script>";
                  }