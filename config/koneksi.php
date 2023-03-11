<?php 
$koneksi = mysqli_connect("localhost:3306","vufweeyc_raportsd","@Qwerty24","vufweeyc_testaja");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 
?>
