<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $id = $_POST['id'];
  $nama_mapel  = $_POST['nama_mapel'];
  $id_guru  = $_POST['id_guru'];
$kelas  = $_POST['kelas'];
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE mata_pelajaran SET 
      nama_mata_pelajaran = '$nama_mapel', 
      id_guru = '$id_guru',
	  kelas = '$kelas'";
      $query .= "WHERE id_pelajaran = '$id'";
      $result = mysqli_query($koneksi, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='../data_mapel.php';</script>";
      }