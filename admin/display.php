<?php
// menghubungkan dengan koneksi
include '../config/koneksi.php';
// jalankan query untuk menampilkan semua data
if($_POST['nama_barang']===""){
    echo "";
}else{
$query = "SELECT * FROM stok_gudang_barang WHERE nama_barang = '$_POST[nama_barang]'";
$result = mysqli_query($koneksi, $query);
//mengecek apakah ada error ketika menjalankan query
if(!$result){
    die ("Query Error: ".mysqli_errno($koneksi).
    " - ".mysqli_error($koneksi));
}
// mengambil data dari database
$data = mysqli_fetch_assoc($result);
echo $data['kode_barang'];
}
?>