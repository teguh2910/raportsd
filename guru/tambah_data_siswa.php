<?php 
session_start();
if($_SESSION['status']!="login"){
header("location:../index.php?pesan=belum_login");
}
include '../layouts/sidebar.php';
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
                Data Siswa</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form method="POST" action="siswa/proses_tambah_data_siswa.php" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama Siswa</label>
                    <input type="text" name="nama_siswa" class="form-control" />
                  </div>                  
                  <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="kelas" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" rows="3" class="form-control"></textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
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