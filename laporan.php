<?php
session_start();

if(!isset($_SESSION['login_user'])){
    header("location:login.php");
    die();
}

include "database.php";

$report_type = isset($_POST['report_type']) ? $_POST['report_type'] : '';

if($report_type == 'period'){
    $month = $_POST['month'];
    $year = $_POST['year'];

    $sql = "SELECT * FROM tb_mahasiswa 
            JOIN tb_data_rumah ON tb_mahasiswa.id_data_rumah = tb_data_rumah.id_data_rumah 
            JOIN tb_ekonomi ON tb_mahasiswa.id_ekonomi = tb_ekonomi.id_ekonomi
            JOIN tb_nilai ON tb_mahasiswa.id_nilai = tb_nilai.id_nilai
            JOIN tb_rencana_hidup ON tb_mahasiswa.id_rencana = tb_rencana_hidup.id_rencana
            WHERE YEAR(tb_mahasiswa.created_at) = '$year' AND MONTH(tb_mahasiswa.created_at) = '$month'
            ORDER BY tb_mahasiswa.nama_mahasiswa ASC";
} elseif($report_type == 'beasiswa') {
    $jenis_beasiswa = $_POST['jenis_beasiswa'];

    $sql = "SELECT * FROM tb_mahasiswa 
            JOIN tb_data_rumah ON tb_mahasiswa.id_data_rumah = tb_data_rumah.id_data_rumah 
            JOIN tb_ekonomi ON tb_mahasiswa.id_ekonomi = tb_ekonomi.id_ekonomi
            JOIN tb_nilai ON tb_mahasiswa.id_nilai = tb_nilai.id_nilai
            JOIN tb_rencana_hidup ON tb_mahasiswa.id_rencana = tb_rencana_hidup.id_rencana
            WHERE tb_mahasiswa.jenis_beasiswa = '$jenis_beasiswa'
            ORDER BY tb_mahasiswa.nama_mahasiswa ASC";
} else {
    $sql = "SELECT * FROM tb_mahasiswa 
            JOIN tb_data_rumah ON tb_mahasiswa.id_data_rumah = tb_data_rumah.id_data_rumah 
            JOIN tb_ekonomi ON tb_mahasiswa.id_ekonomi = tb_ekonomi.id_ekonomi
            JOIN tb_nilai ON tb_mahasiswa.id_nilai = tb_nilai.id_nilai
            JOIN tb_rencana_hidup ON tb_mahasiswa.id_rencana = tb_rencana_hidup.id_rencana
            ORDER BY tb_mahasiswa.nama_mahasiswa ASC";
}

$result = $conn->query($sql);
$num_rows = mysqli_num_rows($result); // Menghitung jumlah baris hasil query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Halaman - Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.php"><img src="assets/img/logo_wcd.png" alt="" class="thumbnail" width="30"> Klasifikasi Beasiswa</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed active" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Mahasiswa
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="input_mhs.php">Input Mahasiswa</a>
                                <a class="nav-link" href="klasifikasi.php">Hasil Klasifikasi</a>
                            </nav>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Laporan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                    <form method="POST" action="laporan.php">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="report_type">Jenis Laporan</label>
                                    <select name="report_type" class="form-control" required>
                                        <option value="period">Periode</option>
                                        <option value="beasiswa">Jenis Beasiswa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="month">Bulan</label>
                                    <select name="month" class="form-control">
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="year">Tahun</label>
                                    <select name="year" class="form-control">
                                        <?php
                                            $currentYear = date("Y");
                                            for($i = 2020; $i <= $currentYear; $i++){
                                                echo "<option value='$i'>$i</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jenis_beasiswa">Jenis Beasiswa</label>
                                    <select name="jenis_beasiswa" class="form-control">
                                        <option value="1">PMDK</option>
                                        <option value="0">KIP Kuliah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary form-control">Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Lengkap</th>
                                        <th>NIM</th>
                                        <th>Alamat</th>
                                        <th>Nomor Handphone</th>
                                        <th>Jenis Beasiswa</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Lengkap</th>
                                        <th>NIM</th>
                                        <th>Alamat</th>
                                        <th>Nomor Handphone</th>
                                        <th>Jenis Beasiswa</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                    $no = 1;
                                    while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $data['nama_mahasiswa'] ?></td>
                                        <td><?= $data['nim'] ?></td>
                                        <td><?= $data['alamat'] ?></td>
                                        <td><?= $data['no_hp'] ?></td>
                                        <td><?php if ($data['jenis_beasiswa'] == '1') {
                                            echo "PMDK";
                                        } else {
                                            echo "KIP Kuliah";
                                        } ?></td>
                                    </tr>
                                    <?php     
                                    $no++;
                                    }  ?>
                                </tbody>
                            </table>
                            <?php if ($num_rows > 0) { // Menampilkan tombol hanya jika ada data ?>
                            <!-- Tambahkan bagian form untuk submit ke generate_pdf.php -->
                            <form method="POST" action="generate_pdf.php">
                                <input type="hidden" name="sql" value="<?= $sql; ?>">
                                <input type="hidden" name="report_type" value="<?= $report_type; ?>">
                                <input type="hidden" name="month" value="<?= $month; ?>">
                                <input type="hidden" name="year" value="<?= $year; ?>">
                                <input type="hidden" name="jenis_beasiswa" value="<?= $jenis_beasiswa; ?>">
                                <button type="submit" class="btn btn-primary mt-3">Generate PDF</button>
                            </form>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Website 2024</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
