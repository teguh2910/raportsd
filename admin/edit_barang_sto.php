<?php 
session_start();
if($_SESSION['status']!="login"){
header("location:../index.php?pesan=belum_login");
}
include '../layouts/sidebar.php';
?>
 <?php
// menghubungkan dengan koneksi
include '../config/koneksi.php';
// jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
$query = "SELECT stok_gudang_barang.kode_barang,stok_gudang_barang.nama_barang,stock_opname.jumlah_stok_opname FROM stok_gudang_barang LEFT JOIN stock_opname
ON stok_gudang_barang.kode_barang = stock_opname.kode_barang
WHERE id_stok='$_GET[id_stok]'";
$result = mysqli_query($koneksi, $query);
//mengecek apakah ada error ketika menjalankan query
if(!$result){
    die ("Query Error: ".mysqli_errno($koneksi).
    " - ".mysqli_error($koneksi));
}
// mengambil data dari database
$data = mysqli_fetch_assoc($result);
//buat perulangan untuk element tabel dari data mahasiswa
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Stock Opname</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Stock Opname</li>
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
               Edit Stock Opname</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form method="POST" action="proses_edit_sto.php" enctype="multipart/form-data">
                <div class="card-body">                  
                  <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" class="form-control" value="<?php echo $data['nama_barang']; ?>" readonly />
                  </div>
                  <div class="form-group">
                    <label>Kode Barang</label>
                    <input type="text" id="kode_barang" name="kode_barang" class="form-control" value="<?php echo $data['kode_barang']; ?>" readonly />
                  </div>                  
                  <div class="form-group">
                    <label>Jumlah Stock Opname Barang</label>
                    <input type="number" autofocus name="jumlah_sto" class="form-control" value="<?php echo $data['jumlah_stok_opname']; ?>">
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
