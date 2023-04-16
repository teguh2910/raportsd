<?php
include '../../config/koneksi.php';
$id = $_POST['id'];
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
if (isset($_FILES['foto'])) {
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
  $query =
    "UPDATE siswa SET 
      nama_siswa = '$nama_siswa', 
      kelas = '$kelas', 
      fase = '$fase', 
      alamat = '$alamat',
      nama_ortu = '$nama_ortu',
      password = '$password',
      id_siswa = '$nis',
      nisn = '$nisn',
      jk = '$jen_kel',
      foto = '$nama_siswa.$file_ext'";
} else {
  $query =
    "UPDATE siswa SET 
      nama_siswa = '$nama_siswa', 
      kelas = '$kelas', 
      fase = '$fase', 
      alamat = '$alamat',
      nama_ortu = '$nama_ortu',
      password = '$password',
      id_siswa = '$nis',
      nisn = '$nisn',
      jk = '$jen_kel'";
}
$query .= "WHERE id_siswa = '$id'";
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
if (validate_password($password)) {
$result = mysqli_query($koneksi, $query);
if (!$result) {
  die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>alert('Data berhasil diubah.');window.location='../data_siswa.php';</script>";
}
}
else {
  echo "<script>alert('Gagal Simpan,password harus menggunakan batasan minimal 8 karakter maximal 20 karakter dan kombinasikan antara huruf, angka dan tanda');window.location='../data_siswa.php';</script>";
}