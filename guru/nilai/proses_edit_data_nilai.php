<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $id= $_POST['id'];
  $id_siswa    = $_POST['id_siswa'];
  $id_pelajaran= $_POST['id_pelajaran'];
  $nilai= $_POST['nilai'];
  $semester= $_POST['semester'];
  $tahun= $_POST['tahun'];
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE nilai_siswa SET 
      id_siswa = '$id_siswa', 
      id_pelajaran = '$id_pelajaran',
      nilai = '$nilai',
      semester = '$semester',
      tahun = '$tahun'";
      $query .= "WHERE id_nilai = '$id'";
      $result = mysqli_query($koneksi, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='../data_nilai.php';</script>";
      }