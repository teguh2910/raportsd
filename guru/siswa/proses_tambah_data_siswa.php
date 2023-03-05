<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $nama_siswa    = $_POST['nama_siswa'];
  $kelas         = $_POST['kelas'];
  $alamat        = $_POST['alamat'];
    $query = "INSERT INTO data_siswa (nama_siswa, kelas, alamat) 
    VALUES ('$nama_siswa', '$kelas', '$alamat')";
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='../data_siswa.php';</script>";
                  }