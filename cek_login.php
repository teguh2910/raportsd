<?php 
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'config/koneksi.php';
	
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
$row = mysqli_fetch_assoc($data); 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if($cek > 0){
	$_SESSION['username'] = $username;
	$_SESSION['hak_akses'] = $row['hak_akses'];
	$_SESSION['status'] = "login";
	$_SESSION['id_user'] = $row['id_user'];
	if($row['hak_akses'] == "siswa"){
		header("location:siswa/index.php");
	}elseif($row['hak_akses']=="guru"){
		header("location:guru/index.php");
	}elseif($row['hak_akses']=="admin"){
		header("location:admin/index.php");
	}
}else{
	header("location:index.php?pesan=gagal");
}
?>