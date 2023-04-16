<?php
include '../../config/koneksi.php';

$id = $_POST['id'];
$nama_guru = $_POST['nama_guru'];
$jabatan = $_POST['jabatan'];
$password = $_POST['password'];
$nip = $_POST['nip'];
$kelas = $_POST['kelas'];

//upload image
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $file_name = $_FILES['photo']['name'];
    $file_tmp = $_FILES['photo']['tmp_name'];
    $file_ext = strtolower(end(explode('.', $_FILES['photo']['name'])));
    $upload_path = '../../img/';
    $target_file = $upload_path . basename($nama_guru . "." . $file_ext);
    if (move_uploaded_file($file_tmp, $target_file)) {
        echo "The file " . basename($_FILES["photo"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    //end logic upload image
    $query = 
      "UPDATE guru SET 
      nama_guru = '$nama_guru', 
      jabatan = '$jabatan',
	  kelas = '$kelas',
      password = '$password',
      id_guru = '$nip',
      foto = '$nama_guru.$file_ext'";
} else {
    $query = 
      "UPDATE guru SET 
      nama_guru = '$nama_guru', 
      jabatan = '$jabatan',
	  kelas = '$kelas',
      password = '$password',
      id_guru = '$nip'";
}
$query .= "WHERE id_guru = '$id'";
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
  echo "<script>alert('Data berhasil diubah.');window.location='../data_guru.php';</script>";
}
}
else {
  echo "<script>alert('Gagal Simpan,password harus menggunakan batasan minimal 8 karakter maximal 20 karakter dan kombinasikan antara huruf, angka dan tanda');window.location='../data_guru.php';</script>";
}