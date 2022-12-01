<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../config/koneksi.php';

	// membuat variabel untuk menampung data dari form
  $kode_barang  = $_POST['kode_barang'];
  $supplier  = $_POST['supplier'];
  $jumlah_order = $_POST['jumlah_order'];


//cek dulu jika ada gambar produk jalankan coding ini
$query1 = "INSERT INTO orders (kode_barang, supplier,jumlah_order) 
VALUES ('$kode_barang', '$supplier', '$jumlah_order')";
$query2 ="UPDATE stok_gudang_barang SET stok_akhir = stok_akhir+'$jumlah_order' WHERE kode_barang = '$kode_barang'";
$result1 = mysqli_query($koneksi, $query1);
$result2 = mysqli_query($koneksi, $query2);
// periska query apakah ada error
if(!$result1&&!$result2){
    die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
         " - ".mysqli_error($koneksi));
} else {
  //tampil alert dan akan redirect ke halaman index.php
  //silahkan ganti index.php sesuai halaman yang akan dituju
  echo "<script>alert('Barang berhasil di order.');window.location='stok_gudang.php';</script>";
}