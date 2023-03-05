<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $id = $_POST['id'];
  $nama_siswa  = $_POST['nama_siswa'];
  $kelas  = $_POST['kelas'];
  $alamat    = $_POST['alamat'];
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE data_siswa SET 
      nama_siswa = '$nama_siswa', 
      kelas = '$kelas', 
      alamat = '$alamat'";
      $query .= "WHERE id_siswa = '$id'";
      $result = mysqli_query($koneksi, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='../data_siswa.php';</script>";
      }