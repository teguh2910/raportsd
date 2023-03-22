<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PenilaianSiswaSD</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">            
     <li class="nav-item">
        <a class="text-danger" href="../logout.php" role="button">
          Log Out <i class="fas fa-power-off"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="E-Gudang" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PenilaianSiswaSD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php if($_SESSION['username']=='admin'){
          
          ?>
          <?php
          }
          else
          {
          ?>
          <img src="../img/<?php echo $_SESSION['foto'] ?>" class="img-circle elevation-2" alt="">
          <?php
          } 
          ?>
        </div>
        <div class="info">
          <a href="#"><?php echo $_SESSION['username'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">         
        <?php if($_SESSION['hak_akses']=="admin"){ ?>  
          <li class="nav-item">
            <a href="../admin/data_admin.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Admin
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="../admin/data_guru.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Guru
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="../admin/data_siswa.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Siswa
              </p>
            </a>
          </li>
			
			<li class="nav-item">
            <a href="../admin/data_mapel.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Mata Pelajaran
              </p>
            </a>
          </li>

          <?php } ?>
          <?php if($_SESSION['hak_akses']=="siswa"){ ?>
            <li class="nav-item">
            <a href="data_siswa.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Siswa
              </p>
            </a>
          </li>
            <?php } ?>
            <?php if($_SESSION['hak_akses']=="guru"|| $_SESSION['hak_akses']=="kepsek"){ ?>
            <li class="nav-item">
            <a href="data_guru.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Guru
              </p>
            </a>
          </li>
            <?php } ?>
            <?php if($_SESSION['hak_akses']=="kepsek" || $_SESSION['hak_akses']=="admin"){ ?>
            <li class="nav-item">
            <a href="data_kepsek.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Kepala Sekolah
              </p>
            </a>
          </li>
            <?php } ?>
        <?php if($_SESSION['hak_akses']=="guru" || $_SESSION['hak_akses']=="siswa" || $_SESSION['hak_akses']=="kepsek"){ ?>                    
          
          <li class="nav-item">
            <a href="data_mapel.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Mata Pelajaran
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="data_siswa.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Siswa
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="data_nilai.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Nilai
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="data_presensi.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Presensi Siswa
              </p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="data_kasus.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Kasus Siswa
              </p>
            </a>
          </li> 

          <!-- <li class="nav-item">
            <a href="data_raport_siswa.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Raport Siswa
              </p>
            </a>
          </li>  -->

          <li class="nav-item">
            <a href="data_grafik_perkembangan.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Grafik Perkembangan
              </p>
            </a>
          </li>
          <?php } ?> 

          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>