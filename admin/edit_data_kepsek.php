<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location:../index.php?pesan=belum_login");
}
include '../layouts/sidebar.php';
?>
<?php
include '../config/koneksi.php';
if (isset($_GET['id_guru'])) {
  $id = ($_GET["id_guru"]);
  $query = "SELECT * FROM guru WHERE id_guru='$id'";
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
          <h1 class="m-0">Data Kepsek</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Kepsek</li>
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
                Edit Data Kepsek <b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="POST" action="kepsek/proses_edit_data_kepsek.php" enctype="multipart/form-data">
                <!-- menampung nilai id produk yang akan di edit -->
                <input name="id" value="<?php echo $data['id_guru']; ?>" hidden />
                <div class="card-body">
                  <div class="form-group">
                    <label>NIP</label>
                    <input type="text" id="nip" pattern="[0-9]+" name="nip" value="<?php echo $data['id_guru']; ?>"
                      minlength="18" required
                      oninvalid="this.setCustomValidity('NIP/NISN hanya bisa diisi dengan angka')"
                      oninput="this.setCustomValidity('')" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Nama Kepsek</label>
                    <input type="text" pattern="[A-Za-z., ]+" id="nama_kepsek" value="<?php echo $data['nama_guru']; ?>"
                      name="nama_kepsek" required oninvalid="this.setCustomValidity('nama harus diisi dengan huruf')"
                      oninput="this.setCustomValidity('')" class="form-control" />
                  </div>

                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" value="<?php echo $data['password']; ?>"
                      class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="photo" value="<?php echo $data['foto']; ?>" class="form-control">
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