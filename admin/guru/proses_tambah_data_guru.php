<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';
function validate_password($password)
{
  // Periksa panjang password
  if (strlen($password) < 8 || strlen($password) > 20) {
    return false;
  }
  // Periksa apakah password mengandung huruf, angka, dan tanda
  if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
    return false;
  }
  return true;
}
	// membuat variabel untuk menampung data dari form
  $nama_guru    = $_POST['nama_guru'];
  $jabatan         = $_POST['jabatan'];
  $password         = $_POST['password'];
$kelas         = $_POST['kelas'];
$file_name = $_FILES['photo']['name'];
    $file_size = $_FILES['photo']['size'];
    $file_tmp = $_FILES['photo']['tmp_name'];
    $file_type = $_FILES['photo']['type'];
    $file_ext = strtolower(end(explode('.',$_FILES['photo']['name'])));

    $extensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$extensions)=== false){
        echo "Extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152){
        echo 'File size must be less than 2 MB';
    }
    
    $upload_path = '../../img/';
    $target_file = $upload_path . basename($_FILES['photo']['name']);

    $extensions= array("jpeg","jpg","png");
    
    if(in_array($file_ext,$extensions)=== false){
        echo "Extension not allowed, please choose a JPEG or PNG file.";
    }
    
    if($file_size > 2097152){
        echo 'File size must be less than 2 MB';
    }
    
    $upload_path = '../../img/';
    $target_file = $upload_path . basename($nama_guru.".".$file_ext);
    if(move_uploaded_file($file_tmp, $target_file)){
      echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
  } else{
      echo "Sorry, there was an error uploading your file.";
  }
  $nip = $_POST['nip'];
  if (validate_password($password)) { 
    $query = "INSERT INTO data_guru (nama_guru, jabatan, password , id_guru,kelas,foto) 
    VALUES ('$nama_guru', '$jabatan', '$password', '$nip','$kelas','$nama_guru.$file_ext')";
  } else {
    echo "<script>alert('Gagal Simpan,password harus menggunakan batasan minimal 8 karakter maximal 20 karakter dan kombinasikan antara huruf, angka dan tanda');window.location='../tambah_data_guru.php';</script>";
  }
                  $result = mysqli_query($koneksi, $query);
                  // periska query apakah ada error
                  if(!$result){
                      die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                           " - ".mysqli_error($koneksi));
                  } else {
                    echo "<script>alert('Data berhasil ditambah.');window.location='../data_guru.php';</script>";
                  }