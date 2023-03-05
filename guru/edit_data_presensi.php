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
  if (isset($_GET['id_presensi'])) {
    // ambil nilai id dari url dan disimpan dalam variabel $id
    $id = ($_GET["id_presensi"]);

    // menampilkan data dari database yang mempunyai id=$id
    $query = "SELECT * FROM presensi_siswa 
                    INNER JOIN data_siswa ON presensi_siswa.id_siswa  = data_siswa.id_siswa
                    INNER JOIN mata_pelajaran ON presensi_siswa.id_pelajaran  = mata_pelajaran.id_pelajaran";                    
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
          echo "<script>alert('Data tidak ditemukan pada database');window.location='data_presensi.php';</script>";
       }
  } else {
    // apabila tidak ada data GET id pada akan di redirect ke index.php
    echo "<script>alert('Masukkan data id.');window.location='data_presensi.php';</script>";
  }         
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
                Edit Data Presensi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form method="POST" action="presensi/proses_edit_data_presensi.php" enctype="multipart/form-data">
                 <!-- menampung nilai id produk yang akan di edit -->
                <input name="id" value="<?php echo $data['id_presensi']; ?>"  hidden />
                <div class="card-body">
                <div class="form-group">
                    <label>Nama Siswa</label>
                    <select name="id_siswa" class="form-control">
                    <?php
                    // get the id_siswa of the data being edited
                    $id_siswa_edit = $data['id_siswa'];

                    // query to retrieve the list of teachers, with an additional column to indicate if the teacher is selected or not
                    $query = "SELECT *, IF(id_siswa = $id_siswa_edit, 1, 0) AS is_selected FROM data_siswa";

                    $result = mysqli_query($koneksi, $query);

                    if (!$result) {
                        die ("Query Error: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
                    }

                    while($row = mysqli_fetch_assoc($result))
                    {
                    ?>
                    <?php 
                    // check if the current teacher is selected or not
                    $selected = $row['is_selected'] ? 'selected' : '';?>
                      <option value="<?php echo $row['id_siswa']; ?>" <?php echo $selected ?> >
                      <?php echo $row['nama_siswa']; ?>
                      </option>
                      <?php } ?>
                    </select>
                  </div> 
                  <div class="form-group">
                    <label>Nama Mapel</label>
                    <select name="id_pelajaran" class="form-control">
                    <?php
                    // get the id_guru of the data being edited
                    $id_pelajaran_edit = $data['id_pelajaran'];

                    // query to retrieve the list of teachers, with an additional column to indicate if the teacher is selected or not
                    $query = "SELECT *, IF(id_pelajaran = $id_pelajaran_edit, 1, 0) AS is_selected FROM mata_pelajaran";

                    $result = mysqli_query($koneksi, $query);

                    if (!$result) {
                        die ("Query Error: ".mysqli_errno($koneksi)." - ".mysqli_error($koneksi));
                    }

                    while($row = mysqli_fetch_assoc($result))
                    {
                    ?>
                    <?php 
                    // check if the current teacher is selected or not
                    $selected = $row['is_selected'] ? 'selected' : '';?>
                      <option value="<?php echo $row['id_pelajaran']; ?>" <?php echo $selected ?> >
                      <?php echo $row['nama_mata_pelajaran']; ?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>     
                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tgl" value="<?php echo $data['tgl']; ?>" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Semester</label>
                    <select name="presensi" class="form-control">
                      <option value="Hadir">Hadir</option>
                      <option value="Izin">Izin</option>
                      <option value="Alpa">Alpa</option>
                    </select>
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