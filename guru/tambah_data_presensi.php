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
            <h1 class="m-0">Data Presensi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Presensi</li>
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
                Data Presensi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form method="POST" action="presensi/proses_tambah_data_presensi.php" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label>Nama Siswa</label>
                    <select name="id_siswa" class="form-control">
                    <?php
                    // menghubungkan dengan koneksi
                    include '../config/koneksi.php';
                    // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
                    $query = "SELECT * FROM `mata_pelajaran` 
								INNER JOIN data_siswa ON data_siswa.kelas = mata_pelajaran.kelas
								WHERE mata_pelajaran.id_guru='$_SESSION[id_user]'
								GROUP BY data_siswa.nama_siswa";
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
                    <label>Tanggal</label>
                    <input type="date" name="tgl" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Presensi</label>
                    <select name="presensi" class="form-control">
                      <option value="Hadir">Hadir</option>
                      <option value="Izin">Izin</option>
                      <option value="Alpha">Alpa</option>
                      <option value="Sakit">Sakit</option>
                    </select>
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