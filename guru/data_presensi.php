<?php 
session_start();
if($_SESSION['status']!="login"){
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
                <a href="tambah_data_presensi.php" class="btn btn-sm btn-primary">Tambah</a>    
                Data Presensi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Mata Pelajaran</th>
                    <th>Presensi</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    // menghubungkan dengan koneksi
                    include '../config/koneksi.php';
                    // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
                    if (isset($_GET['id_siswa'])) {
                      $query = "SELECT * FROM presensi_siswa 
                      INNER JOIN data_siswa ON presensi_siswa.id_siswa  = data_siswa.id_siswa
                      INNER JOIN mata_pelajaran ON presensi_siswa.id_pelajaran  = mata_pelajaran.id_pelajaran
                      WHERE presensi_siswa.id_siswa = '$_GET[id_siswa]'";                      
                    }else{
                    $query = "SELECT * FROM presensi_siswa 
                    INNER JOIN data_siswa ON presensi_siswa.id_siswa  = data_siswa.id_siswa
                    INNER JOIN mata_pelajaran ON presensi_siswa.id_pelajaran  = mata_pelajaran.id_pelajaran
					INNER JOIN data_guru ON data_guru.kelas = data_siswa.kelas
					WHERE data_guru.id_guru='$_SESSION[id_user]'";
                    }
                    $result = mysqli_query($koneksi, $query);
                    //mengecek apakah ada error ketika menjalankan query
                    if(!$result){
                        die ("Query Error: ".mysqli_errno($koneksi).
                        " - ".mysqli_error($koneksi));
                    }

                    //buat perulangan untuk element tabel dari data mahasiswa
                    $no = 1; //variabel untuk membuat nomor urut
                    // hasil query akan disimpan dalam variabel $data dalam bentuk array
                    // kemudian dicetak dengan perulangan while
                    while($row = mysqli_fetch_assoc($result))
                    {
                    ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $row['nama_siswa']; ?></td>
                    <td><?php echo $row['nama_mata_pelajaran']; ?></td>
                    <td><?php echo $row['presensi']; ?></td>
                    <td><?php echo $row['tgl']; ?></td>
                    <td>
                        <a href="edit_data_presensi.php?id_presensi=<?php echo $row['id_presensi']; ?>" class="btn btn-xs btn-warning">Edit</a>
                        <a href="presensi/hapus_data_presensi.php?id_presensi=<?php echo $row['id_presensi']; ?>" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-xs btn-danger">Delete</a>                        
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