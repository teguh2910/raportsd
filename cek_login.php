<?php 
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'config/koneksi.php';
	
// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];
$login_as = $_POST['login_as'];
// menyeleksi data admin dengan username dan password yang sesuai
if($login_as == 'siswa'){
	$data = mysqli_query($koneksi,"select * from data_siswa where nama_siswa='$username' and password='$password'");
	$row = mysqli_fetch_assoc($data); 
	$cek = mysqli_num_rows($data);
	if($cek > 0){
	$_SESSION['username'] = $username;
	$_SESSION['hak_akses'] = 'siswa';
	$_SESSION['status'] = "login";
	$_SESSION['id_user'] = $row['id_siswa'];
	$_SESSION['kelas'] = $row['kelas'];
	$_SESSION['jk'] = $row['jen_kel'];
		header("location:siswa/index.php");
	}else
	{
		header("location:index.php?pesan=gagal");
	}	
}elseif($login_as == 'guru'){
	$data = mysqli_query($koneksi,"select * from data_guru where nama_guru='$username' and password='$password'");
	$row = mysqli_fetch_assoc($data);
	$cek = mysqli_num_rows($data);
	if($cek>0){
	$_SESSION['username'] = $username;
	$_SESSION['hak_akses'] = 'guru';
	$_SESSION['status'] = "login";
	$_SESSION['id_user'] = $row['id_guru'];
		header("location:guru/index.php");
	}else
	{
		header("location:index.php?pesan=gagal");
	}
}elseif($login_as == 'admin'){
	$data = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
	$row = mysqli_fetch_assoc($data);
	$cek = mysqli_num_rows($data);
	if($cek>0){
	$_SESSION['username'] = $username;
	$_SESSION['hak_akses'] = 'admin';
	$_SESSION['status'] = "login";
	$_SESSION['id_user'] = $row['id_user'];
		header("location:admin/index.php");
	}else
	{
		header("location:index.php?pesan=gagal");
	}
}
?>