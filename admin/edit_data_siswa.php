<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location:../index.php?pesan=belum_login");
}
include '../layouts/sidebar.php';
?>
<?php
include '../config/koneksi.php';
if (isset($_GET['id_siswa'])) {
  $id = ($_GET["id_siswa"]);
  $query = "SELECT * FROM siswa WHERE id_siswa='$id'";
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
          <h1 class="m-0">Data Siswa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Siswa</li>
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
                Edit Data Siswa <b>
                  <?php echo $data['nama_siswa']; ?>
                </b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="POST" action="siswa/proses_edit_data_siswa.php" enctype="multipart/form-data">
                <!-- menampung nilai id produk yang akan di edit -->
                <input name="id" value="<?php echo $data['id_siswa']; ?>" hidden />
                <div class="card-body">
                  <div class="form-group">
                    <label>NIS</label>
                    <input type="text" id="nis" pattern="[0-9]+" name="nis" minlength="9"
                      value="<?php echo $data['id_siswa']; ?>" required
                      oninvalid="this.setCustomValidity('NIP/NISN hanya bisa diisi dengan angka')"
                      oninput="this.setCustomValidity('')" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>NISN</label>
                    <input type="text" id="nisn" pattern="[0-9]+" name="nisn" minlength="10"
                      value="<?php echo $data['nisn']; ?>" required
                      oninvalid="this.setCustomValidity('NIP/NISN hanya bisa diisi dengan angka')"
                      oninput="this.setCustomValidity('')" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <br> <input value="l" <?php if($data['jk']=="l"){ ?> checked <?php } ?> name="jk" type="radio"> Laki-Laki 
                    <input value="p" <?php if($data['jk']=="p"){ ?> checked <?php } ?> name="jk" type="radio"> Perempuan                    
                  </div>
                  <div class="form-group">
                    <label>Nama Siswa</label>
                    <input type="text" pattern="[A-Za-z., ]+" id="nama" value="<?php echo $data['nama_siswa']; ?>"
                      name="nama_siswa" required oninvalid="this.setCustomValidity('nama harus diisi dengan huruf')"
                      oninput="this.setCustomValidity('')" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label>Nama Ortu</label>
                    <input type="text" name="nama_ortu" value="<?php echo $data['nama_ortu']; ?>" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="kelas" value="<?php echo $data['kelas']; ?>" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Fase</label>
                    <input type="text" name="fase" value="<?php echo $data['fase']; ?>" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" rows="3" class="form-control"><?php echo $data['alamat']; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $data['password'] ?>">
                  </div>
                  <div class="form-group">
                    <label>Foto</label>
                    <input type="file" name="photo" value="<?php echo $data['foto'] ?>" class="form-control">
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