<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    session_start();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport</title>
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <?php
    // menghubungkan dengan koneksi
    include '../config/koneksi.php';

    $query = "SELECT * FROM nilai_siswa 
    INNER JOIN data_siswa ON nilai_siswa.id_siswa  = data_siswa.id_siswa
    INNER JOIN mata_pelajaran ON nilai_siswa.id_pelajaran  = mata_pelajaran.id_pelajaran
    WHERE nilai_siswa.id_siswa = '$_SESSION[id_user]' 
    AND nilai_siswa.semester = '$_POST[semester]' 
    AND nilai_siswa.tahun = '$_POST[tahun]'";
    $result = mysqli_query($koneksi, $query);
    // jika data gagal diambil maka akan tampil error berikut
    if (!$result) {
        die("Query Error: " . mysqli_errno($koneksi) .
            " - " . mysqli_error($koneksi));
    }
    // mengambil data dari database
    $data = mysqli_fetch_assoc($result);

    ?>
</head>

<body>
    <div class="container border mt-5">
        <div class="row">
            <div class="col-4">
                <table class="table no-border table-sm">
                    <tr>
                        <td>Nama Perserta Didik</td>
                        <td>:</td>
                        <td><?php echo $_SESSION['username'] ?></td>
                    </tr>
                    <tr>
                        <td>NIS/NISN</td>
                        <td>:</td>
                        <td><?php echo $data['id_siswa'] ?>/<?php echo $data['nisn'] ?></td>
                    </tr>
                    <tr>
                        <td>Sekolah</td>
                        <td>:</td>
                        <td>SDN 2 KEMLAKAGEDE</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo $data['alamat'] ?></td>
                    </tr>
                </table>
            </div>

            <div class="col-4 offset-4">
                <table class="table no-border table-sm">
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><?php echo $data['kelas'] ?></td>
                    </tr>
                    <tr>
                        <td>Fase</td>
                        <td>:</td>
                        <td><?php echo $data['fase'] ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Semester</td>
                        <td>:</td>
                        <td><?php echo $data['semester'] ?></td>
                    </tr>
                    <tr>
                        <td>Tahun Pelajaran</td>
                        <td>:</td>
                        <td><?php echo $data['tahun'] ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-hover table-sm">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Mata Pelajaran</th>
                        <th class="text-center">Nilai Akhir</th>
                        <th class="text-center">Capaian Kompetensi</th>
                    </tr>

                    <?php
                    // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
                    $query = "SELECT * FROM nilai_siswa 
                    INNER JOIN data_siswa ON nilai_siswa.id_siswa  = data_siswa.id_siswa
                    INNER JOIN mata_pelajaran ON nilai_siswa.id_pelajaran  = mata_pelajaran.id_pelajaran
                    WHERE nilai_siswa.id_siswa = '$_SESSION[id_user]' 
                    AND nilai_siswa.semester = '$_POST[semester]' 
                    AND nilai_siswa.tahun = '$_POST[tahun]'
                    GROUP BY mata_pelajaran.nama_mata_pelajaran";
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
                        $nilai_akhir = round(($row['nilai_harian'] + $row['nilai_uts'] + $row['nilai_uas']) / 3, 0);
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $no; ?></td>
                            <td><?php echo $row['nama_mata_pelajaran']; ?></td>
                            <td class="text-center"><?php echo $nilai_akhir; ?></td>
                            <td><?php echo $row['keterangan']; ?></td>
                        </tr>
                    <?php $no++;
                    } ?>
                    <tr align="center">
                        <th>No</th>
                        <th class="text-center">Ekstrakulikuler</th>
                        <th colspan="2">Keterangan</th>
                    </tr>
                    <?php
                    // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
                    $query5 = "SELECT * FROM `extra_siswa` WHERE id_siswa=$_SESSION[id_user]";
                    $result5 = mysqli_query($koneksi, $query5);
                    //mengecek apakah ada error ketika menjalankan query
                    if (!$result) {
                        die("Query Error: " . mysqli_errno($koneksi) .
                            " - " . mysqli_error($koneksi));
                    }

                    //buat perulangan untuk element tabel dari data mahasiswa
                    $no = 1; //variabel untuk membuat nomor urut
                    // hasil query akan disimpan dalam variabel $data dalam bentuk array
                    // kemudian dicetak dengan perulangan while
                    while ($row5 = mysqli_fetch_assoc($result5)) {                        
                    ?>                                            
                    <tr>
                        <td align="center"><?php echo $no; ?></td>
                        <td align="center"><?php echo $row5['ekskul']; ?></td>
                        <td align="center" colspan="2"><?php echo $row5['keterangan']; ?></td>
                    </tr>
                    <?php $no++;
                    } ?>
                </table>
            </div>
        </div>
        <div class="row">

            <div class="col-3">
                <table class="table table-bordered table-sm text-center">
                    <?php
                    $query_sakit = "SELECT count(id_siswa) as sakit FROM `presensi_siswa` WHERE presensi='Sakit' AND id_siswa=$_SESSION[id_user]";
                    $result_sakit = mysqli_query($koneksi, $query_sakit);                    
                    $query_ortu = "SELECT nama_ortu FROM `data_siswa` WHERE id_siswa=$_SESSION[id_user]";
                    $result_nama_ortu = mysqli_query($koneksi, $query_ortu);                    
                    $data_ortu = mysqli_fetch_assoc($result_nama_ortu);
                    
                    $query_kepsek = "SELECT * FROM `data_guru` WHERE jabatan='kepsek'";
                    $result_kepsek = mysqli_query($koneksi, $query_kepsek);                    
                    $data_kepsek = mysqli_fetch_assoc($result_kepsek);

                    $query_wali_kelas = "SELECT * FROM `data_guru` 
                    INNER JOIN data_siswa ON data_guru.kelas = data_siswa.kelas 
                    WHERE data_siswa.id_siswa=$_SESSION[id_user]";
                    $result_wali_kelas = mysqli_query($koneksi, $query_wali_kelas);                    
                    $data_wali_kelas = mysqli_fetch_assoc($result_wali_kelas);
                    // mengambil data dari database
                    $data_sakit = mysqli_fetch_assoc($result_sakit);
                    $query_alpha = "SELECT count(id_siswa) as alpha FROM `presensi_siswa` WHERE presensi='Alpha' AND id_siswa=$_SESSION[id_user]";
                    $result_alpha = mysqli_query($koneksi, $query_alpha);
                    // jika data gagal diambil maka akan tampil error berikut
                    if (!$result) {
                        die("Query Error: " . mysqli_errno($koneksi) .
                            " - " . mysqli_error($koneksi));
                    }
                    // mengambil data dari database
                    $data_alpha = mysqli_fetch_assoc($result_alpha);
                    $query_izin = "SELECT count(id_siswa) as izin FROM `presensi_siswa` WHERE presensi='Izin' AND id_siswa=$_SESSION[id_user]";
                    $result_izin = mysqli_query($koneksi, $query_izin);
                    // jika data gagal diambil maka akan tampil error berikut
                    if (!$result) {
                        die("Query Error: " . mysqli_errno($koneksi) .
                            " - " . mysqli_error($koneksi));
                    }
                    // mengambil data dari database
                    $data_izin = mysqli_fetch_assoc($result_izin);
                    $query_kasus = "SELECT * FROM `extra_siswa` WHERE id_siswa=$_SESSION[id_user]";
                    $result_kasus = mysqli_query($koneksi, $query_kasus);
                    // jika data gagal diambil maka akan tampil error berikut
                    if (!$result) {
                        die("Query Error: " . mysqli_errno($koneksi) .
                            " - " . mysqli_error($koneksi));
                    }
                    // mengambil data dari database
                    $data_kasus = mysqli_fetch_assoc($result_kasus);
                    ?>
                    <tr>
                        <td colspan="3"><b>Kehadiran</b></td>
                    </tr>
                    <tr>
                        <td>Sakit</td>
                        <td>:</td>
                        <td><?php echo $data_sakit['sakit'] ?> Hari</td>
                    </tr>
                    <tr>
                        <td>Ijin</td>
                        <td>:</td>
                        <td><?php echo $data_izin['izin'] ?> Hari</td>
                    </tr>
                    <tr>
                        <td>Tanpa Keterangan</td>
                        <td>:</td>
                        <td><?php echo $data_alpha['alpha'] ?> Hari</td>
                    </tr>

                </table>


            </div>
            <div class="col-12">
            <table border=0 width=100%>
                <tr>
                <th>TTD Orang Tua Peserta Didik</th>
                <th>TTD Kepala Sekolah</th>
                <th>TTD Wali Kelas</th>
                </tr>
                <tr>
                    <td><br><br><br><br><br><br> <?php echo $data_ortu['nama_ortu'] ?></td>
                    <td><br><br><br><br><br><br><?php echo $data_kepsek['nama_guru'] ?></td>
                    <td><br><br><br><br><br><br><?php echo $data_wali_kelas['nama_guru'] ?></td>
                </tr>
            </table>
            </div>
        </div>
    </div>
</body>

</html>