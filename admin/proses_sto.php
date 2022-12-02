<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $kode_barang  = $_POST['kode_barang'];
  $jumlah_sto = $_POST['jumlah_sto'];

//cek dulu jika ada gambar produk jalankan coding ini
$query = "INSERT INTO stock_opname (kode_barang, jumlah_stok_opname) 
VALUES ('$kode_barang', '$jumlah_sto')";
$result = mysqli_query($koneksi, $query);
// periska query apakah ada error
if(!$result){
    die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
         " - ".mysqli_error($koneksi));
} else {
  //tampil alert dan akan redirect ke halaman index.php
  //silahkan ganti index.php sesuai halaman yang akan dituju
  echo "<script>alert('Berhasil Tambah.');window.location='stok_opname.php';</script>";
}