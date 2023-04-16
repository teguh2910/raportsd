<?php
include '../../config/koneksi.php';

$nama_siswa = $_POST['nama_siswa'];
$kelas = $_POST['kelas'];
$fase = $_POST['fase'];
$alamat = $_POST['alamat'];
$password = $_POST['password'];
$nis = $_POST['nis'];
$nisn = $_POST['nisn'];
$jen_kel = $_POST['jk'];
$nama_ortu = $_POST['nama_ortu'];

//upload image
$file_name = $_FILES['photo']['name'];
$file_tmp = $_FILES['photo']['tmp_name'];
$file_ext = strtolower(end(explode('.', $_FILES['photo']['name'])));
$upload_path = '../../img/';
$target_file = $upload_path . basename($nama_siswa . "." . $file_ext);
if (move_uploaded_file($file_tmp, $target_file)) {
  echo "The file " . basename($_FILES["photo"]["name"]) . " has been uploaded.";
} else {
  echo "Sorry, there was an error uploading your file.";
}
//end logic upload image

//logic validasi password
function validate_password($password)
{
  if (strlen($password) < 8 || strlen($password) > 20) {
    return false;
  }
  if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
    return false;
  }
  return true;
}
//end logic validasi password
if (validate_password($password)) {
  $query = "INSERT INTO siswa (nama_siswa, kelas,fase, alamat, password ,nama_ortu, id_siswa,nisn, jk,foto) 
    VALUES ('$nama_siswa', '$kelas','$fase', '$alamat', '$password', '$nama_ortu' ,'$nis','$nisn', '$jen_kel','$nama_siswa.$file_ext')";
  $result = mysqli_query($koneksi, $query);
  if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
      " - " . mysqli_error($koneksi));
  } else {
    echo "<script>alert('Data berhasil ditambah.');window.location='../data_siswa.php';</script>";
  }
} else {
  echo "<script>alert('Gagal Simpan,password harus menggunakan batasan minimal 8 karakter maximal 20 karakter dan kombinasikan antara huruf, angka dan tanda');window.location='../tambah_data_siswa.php';</script>";
}