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
$query = "SELECT * FROM stok_gudang_barang ORDER BY id_stok ASC";
$result = mysqli_query($koneksi, $query);
//mengecek apakah ada error ketika menjalankan query
if(!$result){
    die ("Query Error: ".mysqli_errno($koneksi).
    " - ".mysqli_error($koneksi));
}

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
                Stock Opname</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form method="POST" action="proses_sto.php" enctype="multipart/form-data">
                <div class="card-body">
                  <!-- select -->
                  <div class="form-group">
                        <label>Nama Barang</label>
                        <select name="nama_barang" id="nama_barang" class="form-control">
                        <option value="">Pilih Nama Barang</option>
                        <?php
                        // hasil query akan disimpan dalam variabel $data dalam bentuk array
                        // kemudian dicetak dengan perulangan while
                        while($row = mysqli_fetch_assoc($result))
                        {
                        ?>                          
                          <option value="<?php echo $row['nama_barang']; ?>"><?php echo $row['nama_barang']; ?></option>
                        <?php
                        }
                        ?>                          
                        </select>
                  </div>
                  <div class="form-group">
                    <label>Kode Barang</label>
                    <input type="text" id="kode_barang" name="kode_barang" class="form-control" placeholder="Kode Barang" value="" readonly />
                  </div>                  
                  <div class="form-group">
                    <label>Jumlah Stock Opname Barang</label>
                    <input type="number" name="jumlah_sto" class="form-control" placeholder="Jumlah Stock Opname">
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
