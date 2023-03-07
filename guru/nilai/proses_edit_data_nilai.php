<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $id= $_POST['id'];
  $id_siswa    = $_POST['id_siswa'];
  $id_pelajaran= $_POST['id_pelajaran'];
  $nilai_harian= $_POST['nilai_harian'];
  $semester= $_POST['semester'];
  $tahun= $_POST['tahun'];
  $nilai_uts= $_POST['nilai_uts'];
  $nilai_uas= $_POST['nilai_uas'];
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE nilai_siswa SET 
      id_siswa = '$id_siswa', 
      id_pelajaran = '$id_pelajaran',
      nilai_harian = '$nilai_harian',
      semester = '$semester',
      tahun = '$tahun',
      nilai_uts = '$nilai_uts',
      nilai_uas = '$nilai_uas'";
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