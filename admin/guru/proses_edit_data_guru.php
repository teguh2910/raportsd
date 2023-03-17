<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';
session_start();
	// membuat variabel untuk menampung data dari form
  $id = $_POST['id'];
  $nama_guru  = $_POST['nama_guru'];
  $jabatan  = $_POST['jabatan'];
  $password = $_POST['password'];
  $nip = $_POST['nip'];
$kelas = $_POST['kelas'];

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
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE data_guru SET 
      nama_guru = '$nama_guru', 
      jabatan = '$jabatan',
	  kelas = '$kelas',
      password = '$password',
      id_guru = '$nip',
      foto = '$nama_guru.$file_ext'";
      $query .= "WHERE id_guru = '$id'";
      $result = mysqli_query($koneksi, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='../data_guru.php';</script>";
      }