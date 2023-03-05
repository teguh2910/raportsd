<?php 
$koneksi = mysqli_connect("localhost","teguh","@Qwerty24","db_raport");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>