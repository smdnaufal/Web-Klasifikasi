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
        <title>Halaman - Mahasiswa</title>
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
                                    <a class="nav-link active" href="input_mhs.php">Input Mahasiswa</a>
                                    <a class="nav-link" href="klasifikasi.php">Hasil Klasifikasi</a>
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
                        <h1 class="mt-4">Input Data</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Mahasiswa</li>
                        </ol>
                        <a href="klasifikasi.php" class="btn btn-primary">Lihat Hasil</a><br><br>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                            </div>
                            <div class="col-xl-6">
                            </div>
                        </div>
                        <div class="card mb-4">
                        <div class="container">
                        <form class="row g-3" action="predict.php" method="post" enctype="multipart/form-data">
                            <h5>Data Diri</h5>
                            <div class="col-md-6">
                                <label for="" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="" required name="nama" autofocus="on" placeholder="Nama Lengkap">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">NIM</label>
                                <input type="number" class="form-control" required name="nim" placeholder="NIM" id="">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Email</label>
                                <input type="email" class="form-control" required name="email" placeholder="E-mail" id="">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Nomor Handphone</label>
                                <input type="number" class="form-control" required name="no_hp" placeholder="Nomor Hp" id="">
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Alamat</label>
                                <input type="text" class="form-control" required name="alamat" placeholder="alamat lengkap" id="">
                            </div><hr>
                            <h5>Data Orang Tua</h5>
                            <div class="col-md-6">
                                <label for="" class="form-label">Pekerjaan Ayah</label>
                                <select id="" class="form-select" required name="pekerjaan_ayah">
                                    <option value="0">Buruh</option>
                                    <option value="1">PNS</option>
                                    <option value="2">Petani</option>
                                    <option value="8">Pengusaha</option>
                                    <option value="4">Swasta</option>
                                    <option value="5">TNI / POLRI</option>
                                    <option value="6">Tenaga Honorer</option>
                                    <option value="7">Wiraswasta</option>
                                    <option value="9">Lainnya..</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Pekerjaan Ibu</label>
                                <select id="" class="form-select" required name="pekerjaan_ibu">
                                    <option value="0">Buruh</option>
                                    <option value="1">Ibu Rumah Tangga</option>
                                    <option value="3">PNS</option>
                                    <option value="4">Petani</option>
                                    <option value="9">Pengusaha</option>
                                    <option value="5">Swasta</option>
                                    <option value="7">TNI / POLRI</option>
                                    <option value="6">Tenaga Honorer</option>
                                    <option value="8">Wiraswasta</option>
                                    <option value="10">Lainnya..</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Penghasilan Ayah</label>
                                <input type="number" class="form-control" required name="penghasilan_ayah" placeholder="Penghasilan Ayah" id="">
                            </div>
                            <div class="col-md-6">
                            <label for="" class="form-label">Penghasilan Ibu</label>
                            <input type="number" class="form-control" required name="penghasilan_ibu" placeholder="Penghasilan Ibu" id="">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Total Tabungan</label>
                                <input type="number" class="form-control" required name="total_tabungan" placeholder="Total Tabungan" id="">
                            </div><hr>
                            <h5>Data Rumah</h5>
                            <div class="col-md-4">
                                <label for="" class="form-label">Kepemilikan Rumah</label>
                                <select id="" class="form-select" required name="kepemilikan_rumah">
                                    <option value="0">Menumpang</option>
                                    <option value="1">Sendiri</option>
                                    <option value="2">Sewa Bulanan</option>
                                    <option value="3">Sewa Tahunan</option>
                                    <option value="4">Tidak Memiliki</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Sumber Listrik</label>
                                <select id="" class="form-select" required name="sumber_listrik">
                                    <option value="0">Genset</option>
                                    <option value="1">PLN</option>
                                    <option value="2">Tenaga Surya</option>
                                    <option value="3">PLN & GENSET</option>
                                    <option value="4">Menumpang Tetangga</option>
                                    <option value="5">Tidak Memiliki</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Daya Listrik</label>
                                <select id="" class="form-select" required name="daya_listrik">
                                    <option value="6">450 VA</option>
                                    <option value="7">900 VA</option>
                                    <option value="0">1300 VA</option>
                                    <option value="5">2200 VA</option>
                                    <option value="8">3500 VA</option>
                                    <option value="9">5500 VA</option>
                                    <option value="10"> > 5500 VA</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Luas Rumah</label>
                                <select id="" class="form-select" required name="luas_rumah">
                                    <option value="6"> < 25 Meter Persegi </option>
                                    <option value="1">25 - 50 Meter Persegi</option>
                                    <option value="2">50 - 99 Meter Persegi</option>
                                    <option value="0">100 - 200 Meter Persegi</option>
                                    <option value="7"> > 200 Meter Persegi</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Bahan Atap</label>
                                <select id="" class="form-select" required name="atap">
                                    <option value="0">Asbes / Seng</option>
                                    <option value="1">COR - CORAN</option>
                                    <option value="2">Genting</option>
                                    <option value="3">Genting Glazur</option>
                                    <option value="4">Kayu</option>
                                    <option value="5">Rumbai / Tanaman</option>
                                    <option value="7">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Bahan Tembok</label>
                                <select id="" class="form-select" required name="tembok">
                                    <option value="0">Kayu</option>
                                    <option value="1">Semen / Beton</option>
                                    <option value="2">Seng</option>
                                    <option value="3">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Sumber Air</label>
                                <select id="" class="form-select" required name="sumber_air">
                                    <option value="0">PDAM</option>
                                    <option value="1">Sungai / Mata Air</option>
                                    <option value="2">Kemasan</option>
                                    <option value="3">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Jumlah Orang Tinggal</label>
                                <input type="number" class="form-control" required name="orang_tinggal" placeholder="Jumlah Orang Tinggal" id="">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Upload Foto Rumah</label>
                                <input type="file" class="form-control" required name="foto_rumah" id="">
                            </div>
                            <hr>
                            <h5>Data Rencana Hidup</h5>
                            <div class="col-md-4">
                            <label for="" class="form-label">Rencana Tinggal</label>
                                <select id="" class="form-select" required name="rencana_tinggal">
                                    <option value="0">Bersama Keluarga</option>
                                    <option value="1">KOST / SEWA</option>
                                    <option value="2">Milik Sendiri</option>
                                    <option value="3">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                            <label for="" class="form-label">Transportasi Harian</label>
                                <select id="" class="form-select" required name="kendaraan">
                                    <option value="0">Kendaraan Umum</option>
                                    <option value="1">Sepeda Motor</option>
                                    <option value="2">Sepeda</option>
                                    <option value="3">Becak</option>
                                    <option value="4">Mobil</option>
                                    <option value="5">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Biaya Transportasi</label>
                                <input type="number" class="form-control" required name="biaya_transportasi" placeholder=" Biaya Transportasi" id="">
                            </div>
                            <hr>
                            <h5>Data Nilai</h5>
                            <div class="col-md-4">
                                <label for="" class="form-label">Ranking</label>
                                <input type="number" class="form-control" required name="ranking" placeholder=" Ranking Saat Sekolah" id="">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Rerata Nilai Rapor</label>
                                <input type="TEXT" class="form-control" required name="rerata_nilai" placeholder="Rerata Nilai Rapor" id="">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Upload Foto Rapor</label>
                                <input type="file" class="form-control" required name="foto_rapor" id="">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">IP Semester</label>
                                <input type="TEXT" class="form-control" required name="ip_semester" placeholder="IP Semester" id="">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form><br>
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
