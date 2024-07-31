<?php
session_start();

if(!isset($_SESSION['login_user'])){
    header("location:login.php");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $pekerjaan_ayah = $_POST['pekerjaan_ayah'];
    $pekerjaan_ibu = $_POST['pekerjaan_ibu'];
    $penghasilan_ayah = $_POST['penghasilan_ayah'];
    $penghasilan_ibu = $_POST['penghasilan_ibu'];
    $total_tabungan = $_POST['total_tabungan'];
    $kepemilikan_rumah = $_POST['kepemilikan_rumah'];
    $sumber_listrik = $_POST['sumber_listrik'];
    $daya_listrik = $_POST['daya_listrik'];
    $luas_rumah = $_POST['luas_rumah'];
    $atap = $_POST['atap'];
    $tembok = $_POST['tembok'];
    $sumber_air = $_POST['sumber_air'];
    $orang_tinggal = $_POST['orang_tinggal'];
    $rencana_tinggal = $_POST['rencana_tinggal'];
    $biaya_transportasi = $_POST['biaya_transportasi'];
    $kendaraan = $_POST['kendaraan'];
    $ranking = $_POST['ranking'];
    $rerata_nilai = $_POST['rerata_nilai'];
    $ip_semester = $_POST['ip_semester'];

    $foto_rumah = $_FILES['foto_rumah']['name'];
    $foto_rumah_tmp = $_FILES['foto_rumah']['tmp_name'];
    $foto_rumah_ext = pathinfo($foto_rumah, PATHINFO_EXTENSION);
    $foto_rumah_new_name = uniqid() . '.' . $foto_rumah_ext;
    $target_dir = "uploads/";
    $target_file_rumah = $target_dir . $foto_rumah_new_name;
    move_uploaded_file($foto_rumah_tmp, $target_file_rumah);

    $foto_rapor = $_FILES['foto_rapor']['name'];
    $foto_rapor_tmp = $_FILES['foto_rapor']['tmp_name'];
    $foto_rapor_ext = pathinfo($foto_rapor, PATHINFO_EXTENSION);
    $foto_rapor_new_name = uniqid() . '.' . $foto_rapor_ext;
    $target_file_rapor = $target_dir . $foto_rapor_new_name;
    move_uploaded_file($foto_rapor_tmp, $target_file_rapor);

    $data = array(
        "Pekerjaan Ayah" => $pekerjaan_ayah,
        "Pekerjaan Ibu" => $pekerjaan_ibu,
        "Penghasilan Ayah" => $penghasilan_ayah,
        "Penghasilan Ibu" => $penghasilan_ibu,
        "Total Tabungan" => $total_tabungan,
        "Kepemilikan Rumah" => $kepemilikan_rumah,
        "Sumber Listrik" => $sumber_listrik,
        "DAYA LISTRIK" => $daya_listrik,
        "Luas Rumah" => $luas_rumah,
        "Bahan Atap" => $atap,
        "Bahan Tembok" => $tembok,
        "Sumber Air Utama" => $sumber_air,
        "Jumlah Orang Tinggal" => $orang_tinggal,
        "Rencana Tinggal" => $rencana_tinggal,
        "Biaya Transportasi" => $biaya_transportasi,
        "Transportasi Harian" => $kendaraan,
        "Ranking Saat Sekolah" => $ranking,
        "Total Rerata Nilai Rapor" => $rerata_nilai,
        "IP Semester" => $ip_semester
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
        ),
    );

    $context  = stream_context_create($options);
    $result = file_get_contents('http://localhost:5000/predict', false, $context);

    if ($result === FALSE) {
        die("Failed to access API.");
    } else {
        $response = json_decode($result, true);

        if (isset($response['error'])) {
            die("API Error: " . $response['error']);
        }

        $prediction = $response['prediction'];

        // Koneksi ke database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "db_klasifikasi";

        // Membuat koneksi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Memeriksa koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO tb_ekonomi (pekerjaan_ayah, pekerjaan_ibu, penghasilan_ayah, penghasilan_ibu, total_tabungan) VALUES ('$pekerjaan_ayah', '$pekerjaan_ibu', '$penghasilan_ayah', '$penghasilan_ibu', '$total_tabungan')";

        if ($conn->query($sql) === TRUE) {
            $id_ekonomi = $conn->insert_id;

            $sql = "INSERT INTO tb_data_rumah (kepemilikan_rumah, sumber_listrik, daya_listrik, luas_rumah, atap, tembok, sumber_air, orang_tinggal, foto_rumah) VALUES ('$kepemilikan_rumah', '$sumber_listrik', '$daya_listrik', '$luas_rumah', '$atap', '$tembok', '$sumber_air', '$orang_tinggal', '$foto_rumah_new_name')";

            if ($conn->query($sql) === TRUE) {
                $id_data_rumah = $conn->insert_id;

                $sql = "INSERT INTO tb_rencana_hidup (rencana_tinggal, biaya_transportasi, kendaraan) VALUES ('$rencana_tinggal', '$biaya_transportasi', '$kendaraan')";

                if ($conn->query($sql) === TRUE) {
                    $id_rencana = $conn->insert_id;

                    $sql = "INSERT INTO tb_nilai (ranking, rerata_nilai, ip_semester, foto_rapor) VALUES ('$ranking', '$rerata_nilai', '$ip_semester', '$foto_rapor_new_name')";

                    if ($conn->query($sql) === TRUE) {
                        $id_nilai = $conn->insert_id;

                        $sql = "INSERT INTO tb_mahasiswa (nama_mahasiswa, nim, email, alamat, no_hp, id_data_rumah, id_ekonomi, id_nilai, id_rencana, jenis_beasiswa) VALUES ('$nama', '$nim', '$email', '$alamat', '$no_hp', '$id_data_rumah', '$id_ekonomi', '$id_nilai', '$id_rencana', '$prediction')";

                        if ($conn->query($sql) === TRUE) {
                            echo ("<script LANGUAGE='JavaScript'>
                            window.alert('Data Berhasil di tambahkan');
                            window.location.href='input_mhs.php';
                            </script>");
                        } else {
                            echo "Error: " . $conn->error;
                        }
                    } else {
                        echo "Error: " . $conn->error;
                    }
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Error: " . $conn->error;
        }

        // Menutup koneksi
        $conn->close();
    }
}
?>
