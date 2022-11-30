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
  if (isset($_GET['id_stok'])) {
    // ambil nilai id dari url dan disimpan dalam variabel $id
    $id = ($_GET["id_stok"]);

    // menampilkan data dari database yang mempunyai id=$id
    $query = "SELECT * FROM stok_gudang_barang WHERE id_stok='$id'";
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
          echo "<script>alert('Data tidak ditemukan pada database');window.location='stok_gudang.php';</script>";
       }
  } else {
    // apabila tidak ada data GET id pada akan di redirect ke index.php
    echo "<script>alert('Masukkan data id.');window.location='stok_gudang.php';</script>";
  }         
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Stok Barang Gudang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Stok Barang Gudang</li>
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
                Edit Stok Barang <b> <?php echo $data['nama_barang']; ?> </b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form method="POST" action="proses_edit.php" enctype="multipart/form-data">
                 <!-- menampung nilai id produk yang akan di edit -->
                    <input name="id" value="<?php echo $data['id_stok']; ?>"  hidden />
                <div class="card-body">
                  <div class="form-group">
                    <label>Kode Barang</label>
                    <input type="text" name="kode_barang" value="<?php echo $data['kode_barang']; ?>" class="form-control" placeholder="Kode Barang">
                  </div>
                  <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" value="<?php echo $data['nama_barang']; ?>" class="form-control" placeholder="Nama Barang">
                  </div>
                  <div class="form-group">
                    <label>Gambar</label>
                    <br><img src="../img/<?php echo $data['gambar']; ?>" width="100" height="100">
                    <br>                    
                    <i style="float: left;font-size: 11px;color: red">Abaikan jika tidak merubah gambar produk</i>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="gambar" class="custom-file-input">
                        <label class="custom-file-label">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>                      
                    </div>                    
                  </div>
                  <div class="form-group">
                    <label>Jumlah Barang</label>
                    <input type="number" value="<?php echo $data['stok_awal']; ?>" name="stok_awal" class="form-control" placeholder="Jumlah Barang">
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
