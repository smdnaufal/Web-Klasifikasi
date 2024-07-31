<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['login_user'])) {
    header("location:login.php");
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $id_data_rumah = $_POST['id_data_rumah'];
    $id_rencana = $_POST['id_rencana'];
    $id_ekonomi = $_POST['id_ekonomi'];
    $id_nilai = $_POST['id_nilai'];
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

        // Update tb_mahasiswa
        $sql = $conn->query("UPDATE tb_mahasiswa SET nama_mahasiswa='$nama', nim='$nim', email='$email', alamat='$alamat', no_hp='$no_hp', jenis_beasiswa='$prediction' WHERE id_mahasiswa='$id'");

        if ($sql === FALSE) {
            die("Error updating tb_mahasiswa: " . $conn->error);
        }

        // Update tb_data_rumah
        if (isset($_FILES['foto_rumah']) && $_FILES['foto_rumah']['error'] == 0) {
            $foto_rumah = $_FILES['foto_rumah']['name'];
            $foto_rumah_tmp = $_FILES['foto_rumah']['tmp_name'];
            $foto_rumah_ext = pathinfo($foto_rumah, PATHINFO_EXTENSION);
            $foto_rumah_new_name = uniqid() . '.' . $foto_rumah_ext;
            $target_dir = "uploads/";
            $target_file_rumah = $target_dir . $foto_rumah_new_name;

            if (move_uploaded_file($foto_rumah_tmp, $target_file_rumah)) {
                $data_rumah = $conn->query("UPDATE tb_data_rumah SET kepemilikan_rumah='$kepemilikan_rumah', sumber_listrik='$sumber_listrik', daya_listrik='$daya_listrik', luas_rumah='$luas_rumah', atap='$atap', tembok='$tembok', sumber_air='$sumber_air', orang_tinggal='$orang_tinggal', foto_rumah='$foto_rumah_new_name' WHERE id_data_rumah='$id_data_rumah'");
                if ($data_rumah === FALSE) {
                    die("Error updating tb_data_rumah: " . $conn->error);
                }
            } else {
                echo "Error uploading foto rumah.";
            }
        }

        // Update tb_ekonomi
        $ekonomi = $conn->query("UPDATE tb_ekonomi SET pekerjaan_ayah='$pekerjaan_ayah', pekerjaan_ibu='$pekerjaan_ibu', penghasilan_ayah='$penghasilan_ayah', penghasilan_ibu='$penghasilan_ibu', total_tabungan='$total_tabungan' WHERE id_ekonomi='$id_ekonomi'");
        if ($ekonomi === FALSE) {
            die("Error updating tb_ekonomi: " . $conn->error);
        }

        // Update tb_rencana_hidup
        $rencana = $conn->query("UPDATE tb_rencana_hidup SET rencana_tinggal='$rencana_tinggal', biaya_transportasi='$biaya_transportasi', kendaraan='$kendaraan' WHERE id_rencana='$id_rencana'");
        if ($rencana === FALSE) {
            die("Error updating tb_rencana_hidup: " . $conn->error);
        }

        // Update tb_nilai
        if (isset($_FILES['foto_rapor']) && $_FILES['foto_rapor']['error'] == 0) {
            $foto_rapor = $_FILES['foto_rapor']['name'];
            $foto_rapor_tmp = $_FILES['foto_rapor']['tmp_name'];
            $foto_rapor_ext = pathinfo($foto_rapor, PATHINFO_EXTENSION);
            $foto_rapor_new_name = uniqid() . '.' . $foto_rapor_ext;
            $target_dir = "uploads/";
            $target_file_rapor = $target_dir . $foto_rapor_new_name;

            if (move_uploaded_file($foto_rapor_tmp, $target_file_rapor)) {
                $nilai = $conn->query("UPDATE tb_nilai SET ranking='$ranking', rerata_nilai='$rerata_nilai', ip_semester='$ip_semester', foto_rapor='$foto_rapor_new_name' WHERE id_nilai='$id_nilai'");
                if ($nilai === FALSE) {
                    die("Error updating tb_nilai: " . $conn->error);
                }
            } else {
                echo "Error uploading foto rapor.";
            }
        }

        echo ("<script LANGUAGE='JavaScript'>
            window.alert('Data Berhasil diubah');
            window.location.href='klasifikasi.php';
            </script>");

        // Menutup koneksi
        $conn->close();
    }
}
?>
