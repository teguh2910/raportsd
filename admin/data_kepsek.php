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
          <h1 class="m-0">Data Guru</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Guru</li>
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
              <h3 class="card-title"><a href="tambah_data_kepsek.php" class="btn btn-sm btn-primary">Tambah</a>
                Data Kepala Sekolah</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Guru</th>
                    <th>Jabatan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../config/koneksi.php';
                  $query = "SELECT * FROM guru WHERE jabatan='kepsek' ORDER BY id_guru ASC";
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
                        <?php echo $row['id_guru']; ?>
                      </td>
                      <td>
                        <?php echo $row['nama_guru']; ?>
                      </td>
                      <td>
                        <?php echo $row['jabatan']; ?>
                      </td>
                      <td>
                        <a href="edit_data_kepsek.php?id_guru=<?php echo $row['id_guru']; ?>"
                          class="btn btn-xs btn-warning">Edit</a>
                        <a href="kepsek/hapus_data_kepsek.php?id_guru=<?php echo $row['id_guru']; ?>"
                          onclick="return confirm('Are you sure you want to delete this item?')"
                          class="btn btn-xs btn-danger">Hapus</a>
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