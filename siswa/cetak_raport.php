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
    if(!$result){
    die ("Query Error: ".mysqli_errno($koneksi).
    " - ".mysqli_error($koneksi));
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
        <td><?php echo $_SESSION['username']?></td>
    </tr>
    <tr>
        <td>NISN</td>
        <td>:</td>
        <td><?php echo $data['nis']?></td>
    </tr>
    <tr>
        <td>Sekolah</td>
        <td>:</td>
        <td>SDN 2 KEMLAKAGEDE</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><?php echo $data['alamat']?></td>
    </tr>
    </table>
    </div>

    <div class="col-4 offset-4">
    <table class="table no-border table-sm">
    <tr>
        <td>Kelas</td>
        <td>:</td>
        <td><?php echo $data['kelas']?></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Semester</td>
        <td>:</td>
        <td><?php echo $data['semester']?></td>
    </tr>
    <tr>
        <td>Tahun Pelajaran</td>
        <td>:</td>
        <td><?php echo $data['tahun']?></td>
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
            <th class="text-center">Keterangan</th>
        </tr>
        
        <?php
                    function terbilang($angka)
                        {
                            $bilangan = array(
                                '',
                                'Satu',
                                'Dua',
                                'Tiga',
                                'Empat',
                                'Lima',
                                'Enam',
                                'Tujuh',
                                'Delapan',
                                'Sembilan',
                                'Sepuluh',
                                'Sebelas'
                            );

                            if ($angka < 12) {
                                return $bilangan[$angka];
                            } elseif ($angka < 20) {
                                return $bilangan[$angka - 10] . ' Belas';
                            } elseif ($angka < 100) {
                                $hasil_puluhan = intval($angka / 10);
                                $hasil_satuan = $angka % 10;
                                return $bilangan[$hasil_puluhan] . ' Puluh ' . $bilangan[$hasil_satuan];
                            } elseif ($angka < 200) {
                                $hasil_ratusan = 1;
                                $hasil_puluhan = $angka - 100;
                                if ($hasil_puluhan == 0) {
                                    return 'Seratus';
                                } else {
                                    return 'Seratus ' . terbilang($hasil_puluhan);
                                }
                            } else {
                                return 'Angka diluar jangkauan';
                            }
                        }
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
                        $nilai_akhir=round(($row['nilai_harian']+$row['nilai_uts']+$row['nilai_uas'])/3,0);
                    ?>
        <tr>
            <td class="text-center"><?php echo $no; ?></td>
            <td><?php echo $row['nama_mata_pelajaran']; ?></td>
            <td class="text-center"><?php echo $nilai_akhir; ?></td>
            <td><?php echo terbilang($nilai_akhir); ?></td>            
        </tr>
        <?php $no++; } ?>
        <tr>
            <?php
            $query_update="DROP VIEW nilai_siswa_ranked";
            $query2="CREATE VIEW nilai_siswa_ranked AS
            SELECT id_siswa,avg(nilai_harian+nilai_uts+nilai_uas) as nilai_akhir_avg,
            DENSE_RANK() OVER (ORDER BY avg(nilai_harian+nilai_uts+nilai_uas) DESC) as rank               
            FROM nilai_siswa
            GROUP BY id_siswa";
            $query_rank="SELECT rank FROM nilai_siswa_ranked WHERE id_siswa = '$_SESSION[id_user]'";
            $result_update = mysqli_query($koneksi, $query_update);
            $query2 = mysqli_query($koneksi, $query2);
            $result_rank = mysqli_query($koneksi, $query_rank);
            // jika data gagal diambil maka akan tampil error berikut
            if(!$result_rank){
            die ("Query Error: ".mysqli_errno($koneksi).
            " - ".mysqli_error($koneksi));
            }
            // mengambil data dari database
            $data_rank = mysqli_fetch_assoc($result_rank);                                  
            ?>
           <td colspan=3>PERINGKAT KELAS</td>
           <td><?php echo $data_rank['rank']; ?></td>            
        </tr>
    </table>
    </div> 
    </div>
    <div class="row"> 
        
    <div class="col-3">
    <table class="table table-bordered table-sm text-center">
        <?php
        $query_sakit="SELECT count(id_siswa) as sakit FROM `presensi_siswa` WHERE presensi='Sakit' AND id_siswa=$_SESSION[id_user]";
        $result_sakit = mysqli_query($koneksi, $query_sakit);
        // jika data gagal diambil maka akan tampil error berikut
        if(!$result){
        die ("Query Error: ".mysqli_errno($koneksi).
        " - ".mysqli_error($koneksi));
        }
        // mengambil data dari database
        $data_sakit = mysqli_fetch_assoc($result_sakit);
        $query_alpha="SELECT count(id_siswa) as alpha FROM `presensi_siswa` WHERE presensi='Alpha' AND id_siswa=$_SESSION[id_user]";
        $result_alpha = mysqli_query($koneksi, $query_alpha);
        // jika data gagal diambil maka akan tampil error berikut
        if(!$result){
        die ("Query Error: ".mysqli_errno($koneksi).
        " - ".mysqli_error($koneksi));
        }
        // mengambil data dari database
        $data_alpha = mysqli_fetch_assoc($result_alpha);
        $query_izin="SELECT count(id_siswa) as izin FROM `presensi_siswa` WHERE presensi='Izin' AND id_siswa=$_SESSION[id_user]";
        $result_izin = mysqli_query($koneksi, $query_izin);
        // jika data gagal diambil maka akan tampil error berikut
        if(!$result){
        die ("Query Error: ".mysqli_errno($koneksi).
        " - ".mysqli_error($koneksi));
        }
        // mengambil data dari database
        $data_izin = mysqli_fetch_assoc($result_izin);
        $query_kasus="SELECT count(id_siswa) as kasus FROM `kasus_siswa` WHERE id_siswa=$_SESSION[id_user]";
        $result_kasus = mysqli_query($koneksi, $query_kasus);
        // jika data gagal diambil maka akan tampil error berikut
        if(!$result){
        die ("Query Error: ".mysqli_errno($koneksi).
        " - ".mysqli_error($koneksi));
        }
        // mengambil data dari database
        $data_kasus = mysqli_fetch_assoc($result_kasus);
        ?>
        <tr>
            <td>Sakit</td>
            <td>:</td>
            <td><?php echo $data_sakit['sakit']?></td>
        </tr>
        <tr>
            <td>Izin</td>
            <td>:</td>
            <td><?php echo $data_izin['izin']?></td>
        </tr>
        <tr>
            <td>Apha</td>
            <td>:</td>
            <td><?php echo $data_alpha['alpha']?></td>
        </tr>
        <tr>
            <td>Sikap Siswa</td>
            <td>:</td>
            <td>
            <?php if($data_kasus['kasus']>0)
            {
                echo "D";
            }
            else
            {
                echo "A";
            }
            ?>
            </td>
        </tr>
        </table>
    </div>    
    </div>
    </div>
</body>
</html>