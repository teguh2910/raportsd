<?php
include '../config/koneksi.php';
$id = $_POST['id'];
$username = $_POST['username'];
$hak_akses = $_POST['hak_akses'];
$password = $_POST['password'];
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
  $query = "UPDATE user SET 
      username = '$username', 
      hak_akses = '$hak_akses',
      password = '$password'";
  $query .= "WHERE id_user = '$id'";
  $result = mysqli_query($koneksi, $query);
  if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
      " - " . mysqli_error($koneksi));
  } else {
    echo "<script>alert('Data berhasil diubah.');window.location='data_admin.php';</script>";
  }
} else {
  echo "<script>alert('Gagal Simpan,password harus menggunakan batasan minimal 8 karakter maximal 20 karakter dan kombinasikan antara huruf, angka dan tanda');window.location='data_admin.php';</script>";
}