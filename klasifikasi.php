<?php
    session_start();

    if(!isset($_SESSION['login_user'])){
        header("location:login.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Halaman - Klasifikasi</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php"><img src="assets/img/logo_wcd.png" alt="" srcset="" class="thumbnail" width="30"> Klasifikasi Beasiswa</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
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
                                    <a class="nav-link " href="input_mhs.php">Input Mahasiswa</a>
                                    <a class="nav-link active" href="klasifikasi.php">Hasil Klasifikasi</a>
                                </nav>
                            </div>
                            
                    </div>
                    <br><br><br><br><br><br>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Hasil Klasifikasi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Mahasiswa</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <a href="laporan.php" class="btn btn-primary">Laporan</a><br><br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                            </div>
                            <div class="col-xl-6">
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" >
                                    <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Nama Lengkap</th>
                                            <th>NIM</th>
                                            <th>Alamat</th>
                                            <th>Nomor Handphone</th>
                                            <th>Jenis Beasiswa</th>
                                            <th>Aksi</th>
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
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <?php 
                                        include "database.php";

                                        $sql = $conn->query("SELECT * FROM tb_mahasiswa JOIN tb_data_rumah ON tb_mahasiswa.id_data_rumah = tb_data_rumah.id_data_rumah 
                                        JOIN tb_ekonomi ON tb_mahasiswa.id_ekonomi = tb_ekonomi.id_ekonomi
                                        JOIN tb_nilai ON tb_mahasiswa.id_nilai = tb_nilai.id_nilai
                                        JOIN tb_rencana_hidup ON tb_mahasiswa.id_rencana = tb_rencana_hidup.id_rencana ORDER BY tb_mahasiswa.nama_mahasiswa ASC");
                                    ?>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                            while ($data = mysqli_fetch_array($sql)) {
                                                
                                            
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
                                            <td><a href="edit.php?id=<?php echo $data['id_mahasiswa']; ?>" class="btn btn-warning">Edit</a> | 
                                            <a href="hapus.php?id=<?php echo $data['id_mahasiswa']; ?>" class="btn btn-danger">Hapus</a> | 
                                            <a href="detail.php?id=<?php echo $data['id_mahasiswa']; ?>" class="btn btn-info">Detail</a></td>
                                        </tr>
                                        <?php     
                                        $no++;
                                        }  ?>
                                    </tbody>
                                </table>
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
