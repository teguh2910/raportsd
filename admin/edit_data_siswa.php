<?php 
session_start();
if($_SESSION['status']!="login"){
header("location:../index.php?pesan=belum_login");
}
include '../layouts/sidebar.php';
?>
 <?php
  // memanggil file koneksi.php untuk membuat koneksi
    include '../config/koneksi.php';

  // mengecek apakah di url ada nilai GET id
  if (isset($_GET['id_siswa'])) {
    // ambil nilai id dari url dan disimpan dalam variabel $id
    $id = ($_GET["id_siswa"]);

    // menampilkan data dari database yang mempunyai id=$id
    $query = "SELECT * FROM data_siswa WHERE id_siswa='$id'";
    $result = mysqli_query($koneksi, $query);
    // jika data gagal diambil maka akan tampil error berikut
    if(!$result){
      die ("Query Error: ".mysqli_errno($koneksi).
         " - ".mysqli_error($koneksi));
    }
    // mengambil data dari database
    $data = mysqli_fetch_assoc($result);
      // apabila data tidak ada pada database maka akan dijalankan perintah ini
       if (!count($data)) {
          echo "<script>alert('Data tidak ditemukan pada database');window.location='data_siswa.php';</script>";
       }
  } else {
    // apabila tidak ada data GET id pada akan di redirect ke index.php
    echo "<script>alert('Masukkan data id.');window.location='data_siswa.php';</script>";
  }         
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Siswa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                Edit Data Siswa <b> <?php echo $data['nama_siswa']; ?> </b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form method="POST" action="siswa/proses_edit_data_siswa.php" enctype="multipart/form-data">
                 <!-- menampung nilai id produk yang akan di edit -->
                <input name="id" value="<?php echo $data['id_siswa']; ?>"  hidden />
                <div class="card-body">
                <div class="form-group">
                    <label>NIS</label>
                    <input type="text" id="nis" pattern="[0-9]+" name="nis" minlength="15" value="<?php echo $data['id_siswa']; ?> required oninvalid="this.setCustomValidity('NIP/NISN hanya bisa diisi dengan angka')" oninput="this.setCustomValidity('')" class="form-control">
                  </div>  
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <input type="text" name="jen_kel" value="<?php echo $data['jen_kel']; ?>" class="form-control">
                  </div>
                <div class="form-group">
                    <label>Nama Siswa</label>                    
                    <input type="text" pattern="[A-Za-z]+" id="nama" value="<?php echo $data['nama_siswa']; ?>" name="nama_siswa" required oninvalid="this.setCustomValidity('nama harus diisi dengan huruf')" oninput="this.setCustomValidity('')" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="kelas" value="<?php echo $data['kelas']; ?>" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" rows="3" class="form-control"><?php echo $data['alamat']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $data['password'] ?>">
                  </div>
                  <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="photo" class="form-control">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Rubah</button>
                </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div> <!-- /.col-md-4 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    include '../layouts/footer.php';
  ?>