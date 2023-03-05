<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $id_siswa    = $_POST['id_siswa'];
  $id_pelajaran= $_POST['id_pelajaran'];
  $presensi= $_POST['presensi'];
  $tgl= $_POST['tgl'];
    $query = "INSERT INTO presensi_siswa (id_siswa,id_pelajaran,presensi,tgl) 
    VALUES ('$id_siswa', '$id_pelajaran', '$presensi', '$tgl')";
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='../data_presensi.php';</script>";
                  }