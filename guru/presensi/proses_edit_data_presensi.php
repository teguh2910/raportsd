<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $id= $_POST['id'];
  $id_siswa    = $_POST['id_siswa'];
  $id_pelajaran= $_POST['id_pelajaran'];
  $presensi= $_POST['presensi'];
  $tgl= $_POST['tgl'];
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE presensi_siswa SET 
      id_siswa = '$id_siswa', 
      id_pelajaran = '$id_pelajaran',
      presensi = '$presensi',
      tgl = '$tgl'";
      $query .= "WHERE id_presensi = '$id'";
      $result = mysqli_query($koneksi, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='../data_presensi.php';</script>";
      }