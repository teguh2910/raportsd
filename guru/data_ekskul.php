<?php
session_start();
if ($_SESSION['status'] != "login") {
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
                <a href="tambah_data_ekskul.php" class="btn btn-sm btn-primary">Tambah</a>
                Data Ekstrakulikuler
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Ekstrakulikuler</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../config/koneksi.php';
                  if (isset($_GET['id_siswa'])) {
                    $query = "SELECT * FROM ekstrakurikuler 
                      INNER JOIN siswa ON ekstrakurikuler.id_siswa  = siswa.id_siswa
                      WHERE ekstrakurikuler.id_siswa = '$_GET[id_siswa]'";
                  } else {
                    $query = "SELECT * FROM ekstrakurikuler 
                      INNER JOIN siswa ON ekstrakurikuler.id_siswa  = siswa.id_siswa
                      INNER JOIN guru ON guru.kelas=siswa.kelas
                      WHERE guru.id_guru='$_SESSION[id_user]'";
                  }
                  $result = mysqli_query($koneksi, $query);
                  if (!$result) {
                    die("Query Error: " . mysqli_errno($koneksi) .
                      " - " . mysqli_error($koneksi));
                  }
                  $no = 1; //variabel untuk membuat nomor urut
                  while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                      <td>
                        <?php echo $no; ?>
                      </td>
                      <td>
                        <?php echo $row['nama_siswa']; ?>
                      </td>
                      <td>
                        <?php echo $row['ekskul']; ?>
                      </td>
                      <td>
                        <?php echo $row['keterangan']; ?>
                      </td>
                      <td>
                        <a href="edit_data_ekskul.php?id_ekskul=<?php echo $row['id_ekskul']; ?>"
                          class="btn btn-xs btn-warning">Edit</a>
                        <a href="ekskul/hapus_data_ekskul.php?id_ekskul=<?php echo $row['id_ekskul']; ?>"
                          onclick="return confirm('Are you sure you want to delete this item?')"
                          class="btn btn-xs btn-danger">Delete</a>
                      </td>
                    </tr>
                    <?php
                    $no++; //untuk nomor urut terus bertambah 1
                  }
                  ?>
                </tbody>
              </table>
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