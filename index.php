<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi E-Raport</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  
</head>

<body class="hold-transition login-page">
<div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
    <b> <h2> Selamat datang di sistem penilaian siswa 
    <br> SDN 2 KEMLAKAGEDE 
    <br> KABUPATEN CIREBON
    </h2> </b>
    </div>
    <div class="card-body">
      <p class="login-box-msg">       
      <?php 
      if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "gagal"){
          echo "Login gagal! username dan password salah!";
        }else if($_GET['pesan'] == "logout"){
          echo "Anda telah berhasil logout";
        }else if($_GET['pesan'] == "belum_login"){
          echo "Anda harus login untuk mengakses halaman admin";
        }
      }else{
        echo "Silahkan login terlebih dahulu";        
      }
      ?>
      </p>

      <form action="cek_login.php" method="post">
      <div class="input-group mb-3">
      <select name="login_as" class="form-control">
        <option value="siswa">Siswa</option>
        <option value="guru">Guru</option>
        <option value="admin">Admin</option>
      </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>  
      <div class="input-group mb-3">
          <input type="text" name="username" autofocus class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
