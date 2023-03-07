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
            <h1 class="m-0">Data Nilai</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Nilai</li>
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
                Data Nilai</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form method="POST" action="nilai/proses_tambah_data_nilai.php" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label>Nama Siswa</label>
                    <select name="id_siswa" class="form-control">
                    <?php
                    // menghubungkan dengan koneksi
                    include '../config/koneksi.php';
                    // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
                    $query = "SELECT * FROM data_siswa";
                    $result = mysqli_query($koneksi, $query);
                    //mengecek apakah ada error ketika menjalankan query
                    if(!$result){
                        die ("Query Error: ".mysqli_errno($koneksi).
                        " - ".mysqli_error($koneksi));
                    }

                    while($row = mysqli_fetch_assoc($result))
                    {
                    ?>
                      <option value="<?php echo $row['id_siswa']; ?>"><?php echo $row['nama_siswa']; ?></option>
                      <?php } ?>
                    </select>
                  </div>                  
                  <div class="form-group">
                    <label>Nama Mapel</label>
                    <select name="id_pelajaran" class="form-control">
                    <?php
                    // menghubungkan dengan koneksi
                    include '../config/koneksi.php';
                    // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
                    $query = "SELECT * FROM mata_pelajaran";
                    $result = mysqli_query($koneksi, $query);
                    //mengecek apakah ada error ketika menjalankan query
                    if(!$result){
                        die ("Query Error: ".mysqli_errno($koneksi).
                        " - ".mysqli_error($koneksi));
                    }

                    while($row = mysqli_fetch_assoc($result))
                    {
                    ?>
                      <option value="<?php echo $row['id_pelajaran']; ?>"><?php echo $row['nama_mata_pelajaran']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Nilai Harian</label>
                    <input type="number" name="nilai_harian" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Nilai UTS</label>
                    <input type="number" name="nilai_uts" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Nilai UAS</label>
                    <input type="number" name="nilai_uas" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Semester</label>
                    <select name="semester" class="form-control">
                      <option value="1">Ganjil</option>
                      <option value="2">Genap</option>
                    </select>
                  </div>                    
                  <div class="form-group">
                    <label>Tahun</label>
                    <input type="number" name="tahun" class="form-control" />
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