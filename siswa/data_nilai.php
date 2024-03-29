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
              <h1 class="card-title">
                <form action="cetak_raport.php" method="POST">
                  <div class="row">
                    <div class="form-group">
                      <select name="semester" class="form-control">
                        <option value="1">Semester Ganjil</option>
                        <option value="2">Semester Genap</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <select name="tahun" class="form-control">
                        <?php
                        include '../config/koneksi.php';
                        $query = "SELECT * FROM nilai GROUP BY tahun";
                        $result = mysqli_query($koneksi, $query);
                        if (!$result) {
                          die("Query Error: " . mysqli_errno($koneksi) .
                            " - " . mysqli_error($koneksi));
                        }
                        $no = 1; //variabel untuk membuat nomor urut
                        while ($row = mysqli_fetch_assoc($result)) {
                          ?>
                          <option value="<?php echo $row['tahun'] ?>"><?php echo $row['tahun'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      &nbsp;<input type="submit" value="Cetak Raport" class="btn btn-md btn-primary">
                    </div>
                  </div>
                </form>

              </h1>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Jenis Kelamin</th>
                    <th>Mata Pelajaran</th>
                    <th>Nilai Harian</th>
                    <th>Nilai UTS</th>
                    <th>Nilai UAS</th>
                    <th>Nilai Akhir</th>
                    <th>Semester</th>
                    <th>Tahun</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../config/koneksi.php';
                  $query = "SELECT * FROM nilai 
                    INNER JOIN siswa ON nilai.id_siswa  = siswa.id_siswa
                    INNER JOIN mata_pelajaran ON nilai.id_pelajaran  = mata_pelajaran.id_pelajaran
                    WHERE nilai.id_siswa = '$_SESSION[id_user]'";
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
                        <?php if ($row['jk'] == "l") {
                          echo "Laki-laki";
                        } else {
                          echo "Perempuan";
                        } ?>
                      </td>
                      <td>
                        <?php echo $row['nama_mapel']; ?>
                      </td>
                      <td>
                        <?php echo $row['nilai_harian']; ?>
                      </td>
                      <td>
                        <?php echo $row['nilai_uts']; ?>
                      </td>
                      <td>
                        <?php echo $row['nilai_uas']; ?>
                      </td>
                      <td>
                        <?php echo round(($row['nilai_harian'] + $row['nilai_uts'] + $row['nilai_uas']) / 3, 0); ?>
                      </td>
                      <td>
                        <?php echo $row['semester']; ?>
                      </td>
                      <td>
                        <?php echo $row['tahun']; ?>
                      </td>
                      <td>
                        <?php echo $row['keterangan']; ?>
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