<?php
    session_start();

    if(!isset($_SESSION['login_user'])){
        header("location:login.php");
        die();
    }

    include "database.php";
    $id = $_GET['id'];

    $sql = $conn->query("SELECT * FROM tb_mahasiswa JOIN tb_data_rumah ON tb_mahasiswa.id_data_rumah = tb_data_rumah.id_data_rumah JOIN tb_ekonomi ON tb_mahasiswa.id_ekonomi = tb_ekonomi.id_ekonomi
    JOIN tb_nilai ON tb_mahasiswa.id_nilai = tb_nilai.id_nilai
    JOIN tb_rencana_hidup ON tb_mahasiswa.id_rencana = tb_rencana_hidup.id_rencana WHERE tb_mahasiswa.id_mahasiswa = '$id'");

    $data = mysqli_fetch_array($sql);

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
                        <h1 class="mt-4">Edit Data</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Mahasiswa</li>
                        </ol>
                        <!-- <a href="klasifikasi.php" class="btn btn-primary">Lihat Hasil</a><br><br> -->
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
                        <form class="row g-3" action="predict_edit.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $id; ?>">
                            <input type="hidden" name="id_data_rumah" value="<?= $data['id_data_rumah'] ?>">
                            <input type="hidden" name="id_nilai" value="<?= $data['id_nilai'] ?>">
                            <input type="hidden" name="id_ekonomi" value="<?= $data['id_ekonomi'] ?>">
                            <input type="hidden" name="id_rencana" value="<?= $data['id_rencana'] ?>">
                            <h5>Data Diri</h5>
                            <div class="col-md-6">
                                <label for="" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="" name="nama" value="<?= $data['nama_mahasiswa'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">NIM</label>
                                <input type="number" class="form-control" name="nim" value="<?= $data['nim'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?= $data['email'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Nomor Handphone</label>
                                <input type="number" class="form-control" name="no_hp" value="<?= $data['no_hp'] ?>">
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="<?= $data['alamat'] ?>">
                            </div><hr>
                            <h5>Data Orang Tua</h5>
                            <div class="col-md-6">
                                <label for="" class="form-label">Pekerjaan Ayah</label>
                                <select id="" class="form-select" name="pekerjaan_ayah">
                                    <option value="<?= $data['pekerjaan_ayah'] ?>" selected><?php  if ($data['pekerjaan_ayah'] == '1') {
                                    echo "PNS";
                                } elseif ($data['pekerjaan_ayah'] == '2') {
                                    echo "Petani";
                                } elseif ($data['pekerjaan_ayah'] == '4') {
                                    echo "Swasta";
                                } elseif ($data['pekerjaan_ayah'] == '5') {
                                    echo "TNI / POLRI";
                                } elseif ($data['pekerjaan_ayah'] == '6') {
                                    echo "Tenaga Honorer";
                                } elseif ($data['pekerjaan_ayah'] == '7') {
                                    echo "Wiraswasta";
                                } elseif ($data['pekerjaan_ayah'] == '8') {
                                    echo "Pengusaha";
                                } elseif ($data['pekerjaan_ayah'] == '9') {
                                    echo "Lainnya";
                                } elseif ($data['pekerjaan_ayah'] == '0') {
                                    echo "Buruh";
                                }
                                 else {
                                    echo "not found";
                                } ?></option>
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
                                <select id="" class="form-select" name="pekerjaan_ibu">
                                    <option value="<?= $data['pekerjaan_ibu'] ?>" selected><?php 
                                if ($data['pekerjaan_ibu']  == '0') {
                                    echo "Buruh";
                                } elseif ($data['pekerjaan_ibu'] == '1') {
                                    echo "Ibu Rumah Tangga";
                                } elseif ($data['pekerjaan_ibu'] == '3') {
                                    echo "PNS";
                                } elseif ($data['pekerjaan_ibu'] == '4') {
                                    echo "Petani";
                                } elseif ($data['pekerjaan_ibu'] == '5') {
                                    echo "Swasta";
                                } elseif ($data['pekerjaan_ibu'] == '6') {
                                    echo "Tenaga Honorer";
                                }elseif ($data['pekerjaan_ibu'] == '7') {
                                    echo "TNI / POLRI";
                                }elseif ($data['pekerjaan_ibu'] == '8') {
                                    echo "Wiraswasta";
                                } elseif ($data['pekerjaan_ibu'] == '9') {
                                    echo "Pengusaha";
                                } elseif ($data['pekerjaan_ibu'] == '10') {
                                    echo "Lainnya";
                                }
                                ?></option>
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
                                <input type="number" class="form-control" name="penghasilan_ayah" value="<?= $data['penghasilan_ayah'] ?>">
                            </div>
                            <div class="col-md-6">
                            <label for="" class="form-label">Penghasilan Ibu</label>
                            <input type="number" class="form-control" name="penghasilan_ibu" value="<?= $data['penghasilan_ibu'] ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Total Tabungan</label>
                                <input type="number" class="form-control" name="total_tabungan" value="<?= $data['total_tabungan'] ?>">
                            </div><hr>
                            <h5>Data Rumah</h5>
                            <div class="col-md-4">
                                <label for="" class="form-label">Kepemilikan Rumah</label>
                                <select id="" class="form-select" name="kepemilikan_rumah">
                                    <option selected value="<?= $data['kepemilikan_rumah'] ?>"><?php 
                                if ($data['kepemilikan_rumah']  == '0') {
                                    echo "Menumpang";
                                } elseif ($data['kepemilikan_rumah'] == '1') {
                                    echo "Sendiri";
                                } elseif ($data['kepemilikan_rumah'] == '2') {
                                    echo "Sewa Bulanan";
                                } elseif ($data['kepemilikan_rumah'] == '3') {
                                    echo "Sewa Tahunan";
                                } elseif ($data['kepemilikan_rumah'] == '4') {
                                    echo "Tidak Memiliki";
                                }
                                ?></option>
                                    <option value="0">Menumpang</option>
                                    <option value="1">Sendiri</option>
                                    <option value="2">Sewa Bulanan</option>
                                    <option value="3">Sewa Tahunan</option>
                                    <option value="4">Tidak Memiliki</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Sumber Listrik</label>
                                <select id="" class="form-select" name="sumber_listrik">
                                    <option selected value="<?= $data['sumber_listrik'] ?>"><?php 
                                if ($data['sumber_listrik']  == '0') {
                                    echo "Genset";
                                } elseif ($data['sumber_listrik'] == '1') {
                                    echo "PLN";
                                } elseif ($data['sumber_listrik'] == '2') {
                                    echo "Tenaga Surya";
                                } elseif ($data['sumber_listrik'] == '3') {
                                    echo "PLN & GENSET";
                                } elseif ($data['sumber_listrik'] == '4') {
                                    echo "Menumpang Tetangga";
                                } else {
                                    echo "Tidak Memiliki";
                                }
                                ?></option>
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
                                <select id="" class="form-select" name="daya_listrik">
                                    <option value="<?= $data['daya_listrik'] ?>" selected><?php 
                                if ($data['daya_listrik']  == '0') {
                                    echo "1300 VA";
                                } elseif ($data['daya_listrik'] == '5') {
                                    echo "2200 VA";
                                } elseif ($data['daya_listrik'] == '6') {
                                    echo "450 VA";
                                } elseif ($data['daya_listrik'] == '7') {
                                    echo "900 VA";
                                } elseif ($data['daya_listrik'] == '8') {
                                    echo "3500 VA";
                                } elseif ($data['daya_listrik'] == '9') {
                                    echo "5500 VA"; 
                                }
                                 else {
                                    echo "> 5500 VA";
                                }
                                ?></option>
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
                                <select id="" class="form-select" name="luas_rumah">
                                    <option selected value="<?= $data['luas_rumah'] ?>"><?php 
                                if ($data['luas_rumah']  == '0') {
                                    echo "100 - 200 Meter Persegi";
                                } elseif ($data['luas_rumah'] == '1') {
                                    echo "25 - 50 Meter Persegi";
                                } elseif ($data['luas_rumah'] == '2') {
                                    echo "50 - 99 Meter Persegi";
                                } elseif ($data['luas_rumah'] == '6') {
                                    echo "< 25 Meter Persegi";
                                } elseif ($data['luas_rumah'] == '7') {
                                    echo "> 200 Meter Persegi";
                                }
                                ?></option>
                                    <option value="6"> < 25 Meter Persegi </option>
                                    <option value="1">25 - 50 Meter Persegi</option>
                                    <option value="2">50 - 99 Meter Persegi</option>
                                    <option value="0">100 - 200 Meter Persegi</option>
                                    <option value="7"> > 200 Meter Persegi</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Bahan Atap</label>
                                <select id="" class="form-select" name="atap">
                                <option selected value="<?= $data['atap'] ?>"><?php 
                                if ($data['atap']  == '0') {
                                    echo "Asbes / Seng";
                                } elseif ($data['atap'] == '1') {
                                    echo "Cor - Coran";
                                } elseif ($data['atap'] == '2') {
                                    echo "Genting";
                                } elseif ($data['atap'] == '3') {
                                    echo "Genting Glazur";
                                } elseif ($data['atap'] == '4') {
                                    echo "Kayu";
                                } elseif ($data['atap'] == '5') {
                                    echo "Rumbai / Tanaman"; 
                                }
                                 else {
                                    echo "Lainnya";
                                }
                                ?></option>
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
                                <select id="" class="form-select" name="tembok">
                                <option selected value="<?= $data['tembok'] ?>"><?php 
                                if ($data['tembok']  == '0') {
                                    echo "Kayu";
                                } elseif ($data['tembok'] == '1') {
                                    echo "Semen / Beton";
                                } elseif ($data['tembok'] == '2') {
                                    echo "Seng";
                                } elseif ($data['tembok'] == '3') {
                                    echo "Lainnya";
                                }
                                ?></option>
                                    <option value="0">Kayu</option>
                                    <option value="1">Semen / Beton</option>
                                    <option value="2">Seng</option>
                                    <option value="3">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Sumber Air</label>
                                <select id="" class="form-select" name="sumber_air">
                                <option selected value="<?= $data['sumber_air'] ?>"><?php 
                                if ($data['sumber_air']  == '0') {
                                    echo "PDAM";
                                } elseif ($data['sumber_air'] == '1') {
                                    echo "Sungai / Mata Air";
                                } elseif ($data['sumber_air'] == '2') {
                                    echo "Kemasan";
                                } elseif ($data['sumber_air'] == '3') {
                                    echo "Lainnya";
                                } 
                                ?></option>
                                    <option value="0">PDAM</option>
                                    <option value="1">Sungai / Mata Air</option>
                                    <option value="2">Kemasan</option>
                                    <option value="3">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Jumlah Orang Tinggal</label>
                                <input type="number" class="form-control" name="orang_tinggal" value="<?= $data['orang_tinggal'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Ubah Foto Rumah</label>
                                <img src="uploads/<?= $data['foto_rumah'] ?>" alt="" srcset="" width="200">
                                <input type="file" class="form-control" name="foto_rumah" id="">
                            </div><hr>
                            <h5>Data Rencana Hidup</h5>
                            <div class="col-md-4">
                            <label for="" class="form-label">Rencana Tinggal</label>
                                <select id="" class="form-select" name="rencana_tinggal">
                                <option selected value="<?= $data['rencana_tinggal'] ?>"><?php 
                                if ($data['rencana_tinggal']  == '0') {
                                    echo "Bersama Keluarga";
                                } elseif ($data['rencana_tinggal'] == '1') {
                                    echo "KOST / SEWA";
                                } elseif ($data['rencana_tinggal'] == '2') {
                                    echo "Milik Sendiri";
                                } elseif ($data['rencana_tinggal'] == '3') {
                                    echo "Lainnya";
                                } 
                                ?></option>
                                    <option value="0">Bersama Keluarga</option>
                                    <option value="1">KOST / SEWA</option>
                                    <option value="2">Milik Sendiri</option>
                                    <option value="3">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                            <label for="" class="form-label">Transportasi Harian</label>
                                <select id="" class="form-select" name="kendaraan">
                                <option selected value="<?= $data['kendaraan'] ?>"><?php 
                                if ($data['kendaraan']  == '0') {
                                    echo "Kendaraan Umum";
                                } elseif ($data['kendaraan'] == '1') {
                                    echo "Sepeda Motor";
                                } elseif ($data['kendaraan'] == '2') {
                                    echo "Sepeda";
                                } elseif ($data['kendaraan'] == '3') {
                                    echo "Becak";
                                } elseif ($data['kendaraan'] == '4') {
                                    echo "Mobil";
                                } elseif ($data['kendaraan'] == '5') {
                                    echo "Lainnya";
                                } 
                                ?></option>
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
                                <input type="number" class="form-control" name="biaya_transportasi" value="<?= $data['biaya_transportasi'] ?>">
                            </div>
                            <hr>
                            <h5>Data Nilai</h5>
                            <div class="col-md-4">
                                <label for="" class="form-label">Ranking</label>
                                <input type="number" class="form-control" name="ranking" value="<?= $data['ranking'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Rerata Nilai Rapor</label>
                                <input type="TEXT" class="form-control" name="rerata_nilai" value="<?= $data['rerata_nilai'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">IP Semester</label>
                                <input type="TEXT" class="form-control" name="ip_semester" value="<?= $data['ip_semester'] ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Ubah Foto Rapor</label>
                                <img src="uploads/<?= $data['foto_rapor'] ?>" alt="" srcset="" width="200">
                                <input type="file" class="form-control" name="foto_rapor" id="">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Edit</button>
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
