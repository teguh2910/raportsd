<?php 
session_start();
if($_SESSION['status']!="login"){
header("location:../index.php?pesan=belum_login");
}
include '../layouts/sidebar.php';
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #myChart {
            width: 500px;
            height: 300px;
        }
        </style>
<?php
include '../config/koneksi.php';
// jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
if (isset($_POST['tahun'])) {
$query = "SELECT *,AVG((nilai_harian+nilai_uts+nilai_uas)/3) as nilai_akhir FROM nilai_siswa WHERE id_siswa = '$_POST[id_siswa]' AND tahun = '$_POST[tahun]' GROUP BY semester,tahun ORDER BY tahun,semester";
}else{
  $query = "SELECT *,avg(nilai_harian+nilai_uts+nilai_uas) as nilai_akhir FROM nilai_siswa WHERE id_siswa = 'a'";
}
$result = mysqli_query($koneksi, $query);
//mengecek apakah ada error ketika menjalankan query
if(!$result){
die ("Query Error: ".mysqli_errno($koneksi).
" - ".mysqli_error($koneksi));
}
// Store the values in an array
$nilai = array();
while ($row = mysqli_fetch_assoc($result)) {
    $nilai[] = $row['nilai_akhir'];
    $labels[]= "Semester ".$row['semester']." ".$row['tahun'];
}

// Generate JSON data for Chart.js
$json_labels = json_encode($labels);
$json_nilai = json_encode($nilai);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Grafik Perkembangan Nilai Siswa</li>
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
                Grafik Perkembangan Siswa</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <canvas id="myChart"></canvas>
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
    
    <script>
      var ctx = document.getElementById('myChart').getContext('2d');
      var chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: <?php echo $json_labels; ?>,
          datasets: [{
            label: 'Nilai Akhir',
            data: <?php echo $json_nilai; ?>,
            backgroundColor: 'rgb(75, 192, 192)',
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
              suggestedMax: 100
            }
          },
          maintainAspectRatio: false,
          responsive: true,
          width: '500px',
          height: '300px'
        }
      });
    </script>
  </body>
</html>
