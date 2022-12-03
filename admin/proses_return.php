<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $kode_barang  = $_POST['kode_barang'];
  $jumlah_return = $_POST['jumlah_return'];


//cek dulu jika ada gambar produk jalankan coding ini
$query ="UPDATE stok_gudang_barang 
SET stok_akhir = stok_akhir-'$jumlah_return',jumlah_return_barang=jumlah_return_barang+'$jumlah_return' 
WHERE kode_barang = '$kode_barang'";
$result = mysqli_query($koneksi, $query);
// periska query apakah ada error
if(!$result){
    die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
         " - ".mysqli_error($koneksi));
} else {
  //tampil alert dan akan redirect ke halaman index.php
  //silahkan ganti index.php sesuai halaman yang akan dituju
  echo "<script>alert('Barang berhasil di Return.');window.location='stok_gudang.php';</script>";
}