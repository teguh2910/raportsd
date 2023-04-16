<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location:../index.php?pesan=belum_login");
}
include '../layouts/sidebar.php';
?>
<?php
include '../config/koneksi.php';
if (isset($_GET['id_ekskul'])) {
  $id = ($_GET["id_ekskul"]);
  $query = "SELECT * FROM ekstrakurikuler 
                    INNER JOIN siswa ON ekstrakurikuler.id_siswa  = siswa.id_siswa";
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
          <h1 class="m-0">Data Ekstrakulikuler</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Ekstrakulikuler</li>
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
                Edit Data Kasus</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="POST" action="ekskul/proses_edit_data_ekskul.php" enctype="multipart/form-data">
                <!-- menampung nilai id produk yang akan di edit -->
                <input name="id" value="<?php echo $data['id_ekskul']; ?>" hidden />
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama Siswa</label>
                    <select name="id_siswa" class="form-control">
                      <?php
                      // get the id_siswa of the data being edited
                      $id_siswa_edit = $data['id_siswa'];

                      // query to retrieve the list of teachers, with an additional column to indicate if the teacher is selected or not
                      $query = "SELECT *, IF(id_siswa = $id_siswa_edit, 1, 0) AS is_selected FROM siswa                    
                    INNER JOIN guru ON siswa.kelas=guru.kelas
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
                    <label>Ekstrakulikuler</label>
                    <input type="text" name="ekskul" value="<?php echo $data['ekskul']; ?>" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" rows="3"
                      class="form-control"><?php echo $data['keterangan']; ?></textarea>
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