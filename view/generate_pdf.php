<?php
ob_start();
require_once('../library/tcpdf.php');
include "../koneksi.php";

if (!@$_COOKIE['nis']){
    echo "<script>
    let intervalId = setInterval(function() {
    Swal.fire({
        title: 'Anda Belum Login, silahkan kembali!',
        type: 'info',
        timer: 2000,
        showConfirmButton: false,
        backdrop: false
    }).then(() => {
        setTimeout(() => {
            window.location.href = '../login.php';
        }, 1000);
    });
        clearInterval(intervalId);
    }, 2000);
    </script>";
}

// Ambil filter dari parameter GET
$angkatan = isset($_GET['angkatan']) ? $_GET['angkatan'] : '';
$siswa = isset($_GET['siswa']) ? $_GET['siswa'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Query dengan filter
$query = "SELECT * FROM sertifikat 
          JOIN siswa USING(NIS) 
          JOIN kegiatan USING(Id_Kegiatan) 
          WHERE 1=1";
if ($angkatan !== 'Semua') {
    $query .= " AND Angkatan = '" . $koneksi->real_escape_string($angkatan) . "'";
}
if ($siswa !== 'all') {
    $query .= " AND NIS = '" . $koneksi->real_escape_string($siswa) . "'";
}
if ($status !== 'Semua') {
    $query .= " AND Status = '" . $koneksi->real_escape_string($status) . "'";
}
$result = $koneksi->query($query);

// Query untuk rekapitulasi jenis sertifikat
$query_rekap = "SELECT Jenis_Kegiatan, COUNT(*) as total FROM sertifikat 
                JOIN kegiatan USING(Id_Kegiatan) 
                GROUP BY Jenis_Kegiatan";
$result_rekap = $koneksi->query($query_rekap);

// Buat instance PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Admin Sekolah');
$pdf->SetTitle('Laporan Sertifikat');
$pdf->SetMargins(10, 10, 10);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();

// Tambahkan gambar sekolah
$pdf->Image('../images/logoti.jpeg', 10, 6, 20);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(190, 7, 'SMK TI Bali Global Denpasar', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(190, 7, 'Jl. Tukad Citarum No. 44 Denpasar. Bali', 0, 1, 'C');
$pdf->Cell(190, 7, 'website: https://smkti-baliglobal.sch.id | email: info@smkti-baliglobal.sch.id', 0, 1, 'C');
$pdf->Cell(190, 0, '', 'T', 1, 'C');

// Ambil semua angkatan yang ada di query
$angkatanList = [];
$resultAngkatan = $koneksi->query("SELECT DISTINCT Angkatan FROM siswa");
while ($rowAngkatan = $resultAngkatan->fetch_assoc()) {
    $angkatanList[] = $rowAngkatan['Angkatan'];
}

// Loop untuk setiap angkatan
foreach ($angkatanList as $angkatan) {
    // Tambahkan judul angkatan
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Angkatan ' . $angkatan, 0, 1, 'L');

    // Header tabel
    $pdf->SetFillColor(173, 216, 230);
    $pdf->SetFont('helvetica', 'B', 7);
    $pdf->Cell(10, 7, 'No', 1, 0, 'C', true);
    $pdf->Cell(30, 7, 'NIS', 1, 0, 'C', true);
    $pdf->Cell(40, 7, 'Nama Siswa', 1, 0, 'C', true);
    $pdf->Cell(40, 7, 'Tanggal Upload', 1, 0, 'C', true);
    $pdf->Cell(20, 7, 'Status', 1, 0, 'C', true);
    $pdf->Cell(50, 7, 'Jenis Kegiatan', 1, 0, 'C', true);
    $pdf->Ln();

    // Ambil data siswa per angkatan
    $querySiswa = "SELECT * FROM sertifikat 
                   JOIN siswa USING(NIS) 
                   JOIN kegiatan USING(Id_Kegiatan) 
                   WHERE Angkatan = '" . $angkatan . "'";
    $resultSiswa = $koneksi->query($querySiswa);
    $data = [];
    while ($row = $resultSiswa->fetch_assoc()) {
        $data[$row['Nama_Siswa']][] = $row;
    }

    $no = 1;
    foreach ($data as $nama_siswa => $rows) {
        $rowspan = count($rows);
        $firstRow = true;
        foreach ($rows as $row) {
            if ($firstRow) {
                $pdf->Cell(10, 7 * $rowspan, $no++, 1, 0, 'C');
                $pdf->Cell(30, 7 * $rowspan, $row['NIS'], 1, 0, 'C');
                $pdf->Cell(40, 7 * $rowspan, $row['Nama_Siswa'], 1, 0, 'C');
                $firstRow = false;
            } else {
                $pdf->Cell(40, 7, '', 0, 0, 'C');
                $pdf->Cell(40, 7, '', 0, 0, 'C');
            }
            $pdf->Cell(40, 7, $row['Tanggal_Upload'], 1, 0, 'C');
            $pdf->Cell(20, 7, $row['Status'], 1, 0, 'C');
            $pdf->Cell(50, 7, $row['Jenis_Kegiatan'], 1, 0, 'C');
            $pdf->Ln();
        }
    }
    $pdf->Ln(5);
}

// **Rekapitulasi**
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'Rekapitulasi Jenis Sertifikat', 0, 1, 'L');
$pdf->SetFillColor(173, 216, 230);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(100, 7, 'Jenis Kegiatan', 1, 0, 'C', true);
$pdf->Cell(90, 7, 'Total Sertifikat', 1, 0, 'C', true);
$pdf->Ln();

$query_rekap = "SELECT Jenis_Kegiatan, COUNT(*) as total FROM sertifikat 
                JOIN kegiatan USING(Id_Kegiatan) 
                GROUP BY Jenis_Kegiatan";
$result_rekap = $koneksi->query($query_rekap);
$pdf->SetFont('helvetica', '', 10);
while ($rekap = $result_rekap->fetch_assoc()) {
    $pdf->Cell(100, 7, $rekap['Jenis_Kegiatan'], 1);
    $pdf->Cell(90, 7, $rekap['total'], 1);
    $pdf->Ln();
}


// Output PDF
$koneksi->close();
ob_end_clean();
$pdf->Output('laporan_sertifikat.pdf', 'I');