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
                <?php if ($_SESSION['hak_akses'] == "admin") { ?>
                  <a href="tambah_data_siswa.php" class="btn btn-sm btn-primary">Tambah</a>
                <?php } ?>
                Data Siswa
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>Nama ORTU</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Kelas</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../config/koneksi.php';
                  $query = "SELECT * FROM siswa JOIN
                    guru ON siswa.kelas=guru.kelas
                    WHERE guru.id_guru='$_SESSION[id_user]'";
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
                        <?php echo $row['id_siswa']; ?>
                      </td>
                      <td>
                        <?php echo $row['nisn']; ?>
                      </td>
                      <td>
                        <?php echo $row['nama_siswa']; ?>
                      </td>
                      <td>
                        <?php echo $row['nama_ortu']; ?>
                      </td>
                      <td>
                        <?php if ($row['jk'] == "l") {
                          echo "Laki-laki";
                        } else {
                          echo "Perempuan";
                        } ?>
                      </td>
                      <td>
                        <?php echo $row['alamat']; ?>
                      </td>
                      <td>
                        <?php echo $row['kelas']; ?>
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