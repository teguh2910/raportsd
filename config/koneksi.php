<?php 
$koneksi = mysqli_connect("	localhost:3306","vufweeyc_testaja","@Qwerty24","vufweeyc_raportsd");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>