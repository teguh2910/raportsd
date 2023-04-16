<?php
session_start();
if ($_SESSION['status'] != "login") {
  header("location:../index.php?pesan=belum_login");
}
include '../layouts/sidebar.php';
?>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cetak Raport</h4>
      </div>
      <div class="modal-body">
        <form action="cetak_raport.php" method="POST">          
          <label for="">Nama</label>
          <select name="id_user" class="form-control">
            <?php
            include '../config/koneksi.php';
            $query_siswa = "SELECT * FROM nilai 
                    INNER JOIN siswa ON nilai.id_siswa  = siswa.id_siswa
                    INNER JOIN mata_pelajaran ON nilai.id_pelajaran  = mata_pelajaran.id_pelajaran
                    INNER JOIN guru ON guru.kelas = siswa.kelas
                    WHERE guru.id_guru='$_SESSION[id_user]'
                    GROUP BY siswa.nama_siswa";
            $result_nama_siswa = mysqli_query($koneksi, $query_siswa);
            if (!$result_nama_siswa) {
              die("Query Error: " . mysqli_errno($koneksi) .
                " - " . mysqli_error($koneksi));
            }
            while ($row_nama_siswa = mysqli_fetch_assoc($result_nama_siswa)) {
              ?>            
            <option value="<?php echo $row_nama_siswa['id_siswa']; ?>"><?php echo $row_nama_siswa['nama_siswa']; ?></option>            
            <?php } ?>
          </select>
          <label for="">Semester</label>
          <select name="semester" class="form-control">
            <option value="1">1</option>
            <option value="2">2</option>
          </select>
          <label for="">Tahun</label>
          <select name="tahun" class="form-control">
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
            <option value="2028">2028</option>
            <option value="2029">2029</option>
            <option value="2030">2030</option>
          </select>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Cetak</button>
        </form>
      </div>
    </div>

  </div>
</div>
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
                <a href="tambah_data_nilai.php" class="btn btn-sm btn-primary">Tambah</a>
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">Cetak
                  Raport</button>

              </h3>
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
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT * FROM nilai 
                    INNER JOIN siswa ON nilai.id_siswa  = siswa.id_siswa
                    INNER JOIN mata_pelajaran ON nilai.id_pelajaran  = mata_pelajaran.id_pelajaran
                    INNER JOIN guru ON guru.kelas = siswa.kelas
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
                      <td>
                        <a href="edit_data_nilai.php?id_nilai=<?php echo $row['id_nilai']; ?>"
                          class="btn btn-xs btn-warning">Edit</a>
                        <a href="nilai/hapus_data_nilai.php?id_nilai=<?php echo $row['id_nilai']; ?>"
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