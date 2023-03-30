<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $id_siswa    = $_POST['id_siswa'];
  $presensi= $_POST['presensi'];
  $tgl= $_POST['tgl'];
  $Q_cek_tgl="SELECT * FROM presensi_siswa WHERE tgl='$tgl' AND id_siswa='$id_siswa'";
  $resulrt_check=mysqli_query($koneksi,$Q_cek_tgl);
  if(mysqli_num_rows($resulrt_check)>0){
    echo "<script>alert('Sudah ada presensi pada hari tersebut, gagal simpan.');window.location='../data_presensi.php';</script>";
  }else{
    $query = "INSERT INTO presensi_siswa (id_siswa,presensi,tgl) 
    VALUES ('$id_siswa', '$presensi', '$tgl')";
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='../data_presensi.php';</script>";
                  }
                }