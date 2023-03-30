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
            <h1 class="m-0">Data Guru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Guru</li>
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
                Data Guru</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form method="POST" action="guru/proses_tambah_data_guru.php" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label>NIP</label>
                    <input type="text" id="nip" pattern="[0-9]+" name="nip" minlength="15" required oninvalid="this.setCustomValidity('NIP/NISN hanya bisa diisi dengan angka')" oninput="this.setCustomValidity('')" class="form-control">
                  </div>   
                <div class="form-group">
                    <label>Nama Guru</label>
                    <input type="text" pattern="[A-Za-z]+" id="nama_guru" name="nama_guru" required oninvalid="this.setCustomValidity('nama harus diisi dengan huruf')" oninput="this.setCustomValidity('')" class="form-control" />                    
                  </div> 
					<div class="form-group">
                    <label>Kelas</label>
                    <select name="kelas" class="form-control">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                    </select>
                   
                  </div> 
                  <div class="form-group">
                    <label>Jabatan</label>
                    <select name="jabatan" class="form-control">
                      <option value="walikelas">Wali Kelas</option>
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                  </div>   
                  <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="photo" class="form-control">
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