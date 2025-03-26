<?php
require_once('../library/tcpdf.php');
include "../koneksi.php";
if(@$_COOKIE['nis'] == NULL){
    echo "<script>
    let intervalId = setInterval(function() {
    Swal.fire({
        title: 'Anda adalah Operator, silahkan kembali!',
        type: 'info',
        timer: 2000,
        showConfirmButton: false,
        backdrop: false
    }).then(() => {
        setTimeout(() => {
            window.location.href = 'dashboard.php?page=sertifikat';
        }, 1000);
    });
        clearInterval(intervalId);
    }, 2000);
    </script>";
}elseif (!@$_COOKIE['nis']){
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

$nis = $_COOKIE['nis'];
$nama = $_COOKIE['nama'];

$total_point = mysqli_fetch_all(mysqli_query($koneksi, "SELECT SUM(Angka_Kredit) FROM sertifikat INNER JOIN kegiatan USING(Id_Kegiatan) WHERE Status = 'Approved' AND NIS ='$nis'"))[0];

if ($total_point < 30){
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
            window.location.href = 'dashboard.php?page=sertifikat';
        }, 1000);
    });
        clearInterval(intervalId);
    }, 2000);
    </script>";
}

class MYPDF extends TCPDF {
    //Page header
    public function Header() {
        // get the current page break margin
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);
        // set bacground image
        $img_file = K_PATH_IMAGES.'../images/background-sertif.jpeg';
        $this->Image($img_file, 0, 0, 298, 211, '', '', '', false, 300, '', false, false, 0);
        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->AddPage('L');


$pdf->Ln(85);
$pdf->SetFont('helvetica', 'B', 30);
$pdf->Cell(0, 10, $nama, 0, 1, 'C');
$pdf->Ln(10);


$pdf->Output();
?>