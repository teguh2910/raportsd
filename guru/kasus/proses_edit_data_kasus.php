<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $id= $_POST['id'];
  $id_siswa    = $_POST['id_siswa'];
  $ekskul= $_POST['ekskul'];
  $keterangan= $_POST['keterangan'];
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE extra_siswa SET 
      id_siswa = '$id_siswa', 
      ekskul = '$ekskul',
      keterangan = '$keterangan'";
      $query .= "WHERE id_ekskul = '$id'";
      $result = mysqli_query($koneksi, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='../data_kasus.php';</script>";
      }