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
              <form action="presensi/proses_tambah_data_presensi.php" method="POST">
                  <div class="row">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id_user']; ?>">
                    <div class="form-group">
                      <input type="date" required name="tanggal" class="form-control">
                    </div>
                    <div class="form-group">
                      &nbsp;<input type="submit" name="input" value="Input Presensi" class="btn btn-md btn-primary">
                    </div>
                  </div>
                </form>

                <form action="data_presensi.php" method="POST">
                  <div class="row">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id_user']; ?>">
                    <div class="form-group">
                      <input type="date" required name="tanggal" class="form-control">
                    </div>
                    <div class="form-group">
                      &nbsp;<input type="submit" name="lihat" value="Lihat Presensi" class="btn btn-md btn-success">
                    </div>
                  </div>
                </form>
               
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Tanggal</th>
                    <th>Presensi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // menghubungkan dengan koneksi
                  include '../config/koneksi.php';
                  // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
                    if(isset($_POST['lihat'])){
                    $query = "SELECT * FROM presensi_siswa                                       
                    INNER JOIN data_siswa ON data_siswa.id_siswa = presensi_siswa.id_siswa
                    INNER JOIN data_guru ON data_guru.kelas = data_siswa.kelas
                    WHERE data_guru.id_guru='$_SESSION[id_user]' AND
                    presensi_siswa.tgl='$_POST[tanggal]'";
                    }elseif(isset($_POST['input'])){
                      $query = "SELECT * FROM presensi_siswa                                       
                    INNER JOIN data_siswa ON data_siswa.id_siswa = presensi_siswa.id_siswa
                    INNER JOIN data_guru ON data_guru.kelas = data_siswa.kelas
                    WHERE data_guru.id_guru='$_SESSION[id_user]'
                      and presensi_siswa.presensi=''";
                    }else{
                      $query = "SELECT * FROM presensi_siswa                                       
                    INNER JOIN data_siswa ON data_siswa.id_siswa = presensi_siswa.id_siswa
                    INNER JOIN data_guru ON data_guru.kelas = data_siswa.kelas
                    WHERE data_guru.id_guru='$_SESSION[id_user]'
                      and presensi_siswa.presensi=''";
                    }
                  $result = mysqli_query($koneksi, $query);
                  //mengecek apakah ada error ketika menjalankan query
                  if (!$result) {
                    die("Query Error: " . mysqli_errno($koneksi) .
                      " - " . mysqli_error($koneksi));
                  }

                  //buat perulangan untuk element tabel dari data mahasiswa
                  $no = 1; //variabel untuk membuat nomor urut
                  // hasil query akan disimpan dalam variabel $data dalam bentuk array
                  // kemudian dicetak dengan perulangan while
                  while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $row['id_siswa']; ?></td>
                      <td><?php echo $row['nama_siswa']; ?></td>
                      <td><?php echo $row['tgl']; ?></td>
                      <td><a href="#" class="status" data-type="select" data-pk="<?php echo $row['id_presensi']; ?>" data-url="presensi/proses_edit_data_presensi.php" data-title="Select status"><?php echo $row['presensi']; ?></a></td>                     
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
