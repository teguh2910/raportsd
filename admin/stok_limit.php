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
            <h1 class="m-0">Stok Limit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Stok Limit</li>
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
                Stok Limit kurang dari 10 Hari</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Gambar</th>
                    <th>Stok Awal Barang</th>
                    <th>Stok Akhir Barang</th>
                    <th>Jumlah Order</th>
                    <th>Jumlah Return Barang</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    // menghubungkan dengan koneksi
                    include '../config/koneksi.php';
                    // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
                    $query = "SELECT
                    stok_gudang_barang.id_stok, 
                    stok_gudang_barang.kode_barang,
                    stok_gudang_barang.nama_barang,
                    stok_gudang_barang.gambar,
                    stok_gudang_barang.stok_awal,
                    stok_gudang_barang.stok_akhir,
                    sum(orders.jumlah_order) as jumlah_order,
                    stok_gudang_barang.jumlah_return_barang 
                    FROM stok_gudang_barang LEFT JOIN orders
                    ON stok_gudang_barang.kode_barang = orders.kode_barang
                    WHERE stok_gudang_barang.stok_akhir < 10 
                    GROUP BY stok_gudang_barang.kode_barang";
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
                    <td><?php echo $row['kode_barang']; ?></td>
                    <td><?php echo $row['nama_barang']; ?></td>
                    <td><img src="../img/<?php echo $row['gambar']; ?>" width="100" height="100"></td>
                    <td><?php echo $row['stok_awal']; ?></td>
                    <td><?php echo $row['stok_akhir']; ?></td>
                    <td>
                      <?php if($row['jumlah_order']==null)
                      {
                        echo "0";
                      }else{
                        echo $row['jumlah_order'];
                      }; 
                      ?></td>
                    <td><?php echo $row['jumlah_return_barang']; ?></td>                    
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
