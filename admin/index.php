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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
          <div class="col-lg-4">
          <div class="card card-outline card-info">
            <div class="card-body">
               <h3>Stok Barang Gudang</h3> 
            </div>
            <div class="card-footer">
               <a href="stok_gudang.php" class="btn btn-md btn-info">More Info --></a> 
            </div>
            </div>
            <!-- /.card -->
          </div> <!-- /.col-md-4 -->
          <div class="col-lg-4">
          <div class="card card-outline card-info">
            <div class="card-body">
               <h3>Laporan</h3> 
            </div>
            <div class="card-footer">
               <a href="laporan.php" class="btn btn-md btn-info">More Info --></a> 
            </div>
            </div>
            <!-- /.card -->
          </div> <!-- /.col-md-4 -->
          <div class="col-lg-4">
          <div class="card card-outline card-info">
            <div class="card-body">
               <h3>Return</h3> 
            </div>
            <div class="card-footer">
               <a href="return_barang.php" class="btn btn-md btn-info">More Info --></a> 
            </div>
            </div>
            <!-- /.card -->
          </div> <!-- /.col-md-4 -->
          <div class="col-lg-4">
          <div class="card card-outline card-info">
            <div class="card-body">
               <h3>Order</h3> 
            </div>
            <div class="card-footer">
               <a href="order_tambah.php" class="btn btn-md btn-info">More Info --></a> 
            </div>
            </div>
            <!-- /.card -->
          </div> <!-- /.col-md-4 -->
          <div class="col-lg-4">
          <div class="card card-outline card-info">
            <div class="card-body">
               <h3>Stok Limit</h3> 
            </div>
            <div class="card-footer">
               <a href="stok_limit.php" class="btn btn-md btn-info">More Info --></a> 
            </div>
            </div>
            <!-- /.card -->
          </div> <!-- /.col-md-4 -->
          <div class="col-lg-4">
          <div class="card card-outline card-info">
            <div class="card-body">
               <h3>Stok Opname</h3> 
            </div>
            <div class="card-footer">
               <a href="stok_limit.php" class="btn btn-md btn-info">More Info --></a> 
            </div>
            </div>
            <!-- /.card -->
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
