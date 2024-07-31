<?php
require('fpdf.php');
include 'database.php';

$sql = $_POST['sql'];
$report_type = $_POST['report_type'];
$month = isset($_POST['month']) ? $_POST['month'] : '';
$year = isset($_POST['year']) ? $_POST['year'] : '';
$jenis_beasiswa = isset($_POST['jenis_beasiswa']) ? $_POST['jenis_beasiswa'] : '';

$result = $conn->query($sql);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(0, 10, 'Laporan Data Penerima Beasiswa', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 10);
if ($report_type == 'period') {
    $pdf->Cell(0, 10, 'Periode: ' . $month . '-' . $year, 0, 1, 'C');
} elseif ($report_type == 'beasiswa') {
    $beasiswa_name = ($jenis_beasiswa == '1') ? 'PMDK' : 'KIP Kuliah';
    $pdf->Cell(0, 10, 'Jenis Beasiswa: ' . $beasiswa_name, 0, 1, 'C');
} else {
    $pdf->Cell(0, 10, 'Keseluruhan Data Mahasiswa', 0, 1, 'C');
}
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 10, 'No', 1);
$pdf->Cell(50, 10, 'Nama Lengkap', 1);
$pdf->Cell(30, 10, 'NIM', 1);
$pdf->Cell(50, 10, 'Alamat', 1);
$pdf->Cell(30, 10, 'No Handphone', 1);
$pdf->Cell(20, 10, 'Jenis Beasiswa', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
$no = 1;
while ($data = mysqli_fetch_array($result)) {
    $pdf->Cell(10, 10, $no, 1);
    $pdf->Cell(50, 10, $data['nama_mahasiswa'], 1);
    $pdf->Cell(30, 10, $data['nim'], 1);
    $pdf->Cell(50, 10, $data['alamat'], 1);
    $pdf->Cell(30, 10, $data['no_hp'], 1);
    $pdf->Cell(20, 10, ($data['jenis_beasiswa'] == '1') ? 'PMDK' : 'KIP Kuliah', 1);
    $pdf->Ln();
    $no++;
}

$pdf->Output();
?>
