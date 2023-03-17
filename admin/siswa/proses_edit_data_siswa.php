<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include '../../config/koneksi.php';
session_start();
	// membuat variabel untuk menampung data dari form
  $id = $_POST['id'];
  $nama_siswa  = $_POST['nama_siswa'];
  $kelas  = $_POST['kelas'];
  $alamat    = $_POST['alamat'];
  $password  = $_POST['password'];
  $nis  = $_POST['nis'];
  $jen_kel  = $_POST['jen_kel'];

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
    $target_file = $upload_path . basename($nama_siswa.".".$file_ext);
    if(move_uploaded_file($file_tmp, $target_file)){
      echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
  } else{
      echo "Sorry, there was an error uploading your file.";
  }
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE data_siswa SET 
      nama_siswa = '$nama_siswa', 
      kelas = '$kelas', 
      alamat = '$alamat',
      password = '$password',
      id_siswa = '$nis',
      jen_kel = '$jen_kel',
      foto = '$nama_siswa.$file_ext'";
      $query .= "WHERE id_siswa = '$id'";
      $result = mysqli_query($koneksi, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
        //tampil alert dan akan redirect ke halaman index.php
        //silahkan ganti index.php sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='../data_siswa.php';</script>";
      }