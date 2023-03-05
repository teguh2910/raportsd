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
// Generate some sample data
$nilai_matematika = [75, 80, 85, 90, 95, 100];
$nilai_bahasa_inggris = [80, 85, 90, 95, 100, 95];
$nilai_ipa = [90, 95, 100, 95, 90, 85];
$nilai_ips = [70, 75, 80, 85, 90, 95];

// Convert data into arrays for Chart.js
$labels = ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6'];
$nilai_matematika = $nilai_matematika;
$nilai_bahasa_inggris = $nilai_bahasa_inggris;
$nilai_ipa = $nilai_ipa;
$nilai_ips = $nilai_ips;

// Generate JSON data for Chart.js
$json_labels = json_encode($labels);
$json_nilai_matematika = json_encode($nilai_matematika);
$json_nilai_bahasa_inggris = json_encode($nilai_bahasa_inggris);
$json_nilai_ipa = json_encode($nilai_ipa);
$json_nilai_ips = json_encode($nilai_ips);
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
            label: 'Matematika',
            data: <?php echo $json_nilai_matematika; ?>,
            backgroundColor: 'rgb(75, 192, 192)',
          },
          {
            label: 'Bahasa Ingris',
            data: <?php echo $json_nilai_bahasa_inggris; ?>,
            backgroundColor: 'rgb(255, 99, 132)',
          },
          {
            label: 'IPA',
            data: <?php echo $json_nilai_ipa; ?>,
            backgroundColor: 'rgb(54, 162, 235)',
          },
          {
            label: 'IPS',
            data: <?php echo $json_nilai_ips; ?>,
            backgroundColor: 'rgb(255, 205, 86)',
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
