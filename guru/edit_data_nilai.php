<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location:../index.php?pesan=belum_login");
}
include '../layouts/sidebar.php';
?>
<?php
include '../config/koneksi.php';
if (isset($_GET['id_nilai'])) {
  $id = ($_GET["id_nilai"]);
  $query = "SELECT * FROM nilai 
                    INNER JOIN siswa ON nilai.id_siswa  = siswa.id_siswa
                    INNER JOIN mata_pelajaran ON nilai.id_pelajaran  = mata_pelajaran.id_pelajaran
                    WHERE nilai.id_nilai = '$id'";
  $result = mysqli_query($koneksi, $query);
  if (!$result) {
    die("Query Error: " . mysqli_errno($koneksi) .
      " - " . mysqli_error($koneksi));
  }
  $data = mysqli_fetch_assoc($result);
 }
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
                Edit Data Nilai</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="POST" action="nilai/proses_edit_data_nilai.php" enctype="multipart/form-data">
                <!-- menampung nilai id produk yang akan di edit -->
                <input name="id" value="<?php echo $_GET["id_nilai"]; ?>" hidden />
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama Siswa</label>
                    <select name="id_siswa" class="form-control">
                      <?php
                      $id_siswa_edit = $data['id_siswa'];
                      $query = "SELECT *, IF(id_siswa = $id_siswa_edit, 1, 0) AS is_selected FROM siswa
                      INNER JOIN guru ON guru.kelas=siswa.kelas
                      WHERE id_guru='$_SESSION[id_user]'";

                      $result = mysqli_query($koneksi, $query);

                      if (!$result) {
                        die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                      }

                      while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <?php
                        $selected = $row['is_selected'] ? 'selected' : ''; ?>
                        <option value="<?php echo $row['id_siswa']; ?>" <?php echo $selected ?>>
                          <?php echo $row['nama_siswa']; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Nama Mapel</label>
                    <select name="id_pelajaran" class="form-control">
                      <?php
                      $id_pelajaran_edit = $data['id_pelajaran'];
                      $query = "SELECT *, IF(id_pelajaran = $id_pelajaran_edit, 1, 0) AS is_selected FROM mata_pelajaran 
                      WHERE id_guru='$_SESSION[id_user]'
                      GROUP BY nama_mapel";
                      $result = mysqli_query($koneksi, $query);
                      if (!$result) {
                        die("Query Error: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                      }
                      while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <?php
                        $selected = $row['is_selected'] ? 'selected' : ''; ?>
                        <option value="<?php echo $row['id_pelajaran']; ?>" <?php echo $selected ?>>
                          <?php echo $row['nama_mapel']; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Nilai Harian</label>
                    <input type="number" name="nilai_harian" value="<?php echo $data['nilai_harian']; ?>"
                      class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Nilai UTS</label>
                    <input type="number" name="nilai_uts" value="<?php echo $data['nilai_uts']; ?>"
                      class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Nilai UAS</label>
                    <input type="number" name="nilai_uas" value="<?php echo $data['nilai_uas']; ?>"
                      class="form-control" />
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
                    <input type="number" name="tahun" value="<?php echo $data['tahun']; ?>" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" value="<?php echo $data['keterangan']; ?>"
                      class="form-control" />
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