<?php

if (isset($_GET['id_sertifikat']) && isset($_GET['confirm_delete']) && $_GET['confirm_delete'] == 'true') {
    $id = mysqli_real_escape_string($koneksi, $_GET['id_sertifikat']);
    $hasil_1 = mysqli_query($koneksi, "DELETE FROM notifikasi WHERE Id_Sertifikat = '$id'");
    $hasil_2 = mysqli_query($koneksi, "DELETE FROM sertifikat WHERE Id_Sertifikat = '$id'");

    if ($hasil_1 && $hasil_2) {
        echo "<script>
        let intervalId = setInterval(function() {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data sertifikat telah dihapus.',
                type: 'success',
                timer: 1000,
                showConfirmButton: false
            }).then(() => {
                setTimeout(() => {
                    window.location.href = 'dashboard.php?page=sertifikat';
                }, 1000);
            });
            clearInterval(intervalId);
        }, 2000);
        </script>";
    } else {
        echo "<script>
        let intervalId = setInterval(function() {
            Swal.fire({
                title: 'Gagal!',
                text: 'Data sertifikat gagal dihapus.',
                type: 'error',
                timer: 1000,
                showConfirmButton: false
            }).then(() => {
                setTimeout(() => {
                    window.location.href = 'dashboard.php?page=sertifikat';
                }, 1000);
            });
            clearInterval(intervalId);
        }, 2000);
        </script>";
    }
}

$cek_nis = $_COOKIE['nis'] ?? NULL;
$where_clause = "";

// Logic untuk pencarian
if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_GET['keyword']);
    $filter_by = isset($_GET['filter_by']) ? $_GET['filter_by'] : 'Jenis_Kegiatan';
    
    // Membuat WHERE clause berdasarkan filter
    switch($filter_by) {
        case 'Jenis_Kegiatan':
            $where_clause = " AND k.Jenis_Kegiatan LIKE '%$keyword%'";
            break;
        case 'Kategori':
            $where_clause = " AND kat.Kategori LIKE '%$keyword%'";
            break;
        case 'Sub_Kategori':
            $where_clause = " AND kat.Sub_Kategori LIKE '%$keyword%'";
            break;
        case 'Nama_Siswa':
            $where_clause = " AND sis.Nama_Siswa LIKE '%$keyword%'";
            break;
        case 'NIS':
            $where_clause = " AND s.NIS LIKE '%$keyword%'";
            break;
        case 'Angkatan':
            $where_clause = " AND sis.Angkatan LIKE '%$keyword%'";
            break;
        default:
            $where_clause = " AND k.Jenis_Kegiatan LIKE '%$keyword%'";
    }
}

// Query berdasarkan peran pengguna dan filter
if($cek_nis == NULL){
    $sql = "SELECT s.*, kat.Kategori, k.Jenis_Kegiatan, kat.Sub_Kategori, sis.Nama_Siswa, sis.Angkatan,
            (SELECT IFNULL(SUM(Angka_Kredit), 0) FROM sertifikat JOIN kegiatan USING(Id_Kegiatan) 
             WHERE Id_Sertifikat = s.Id_Sertifikat) AS Total_Skor
           FROM sertifikat s 
           JOIN kegiatan k USING (Id_Kegiatan) 
           JOIN kategori kat USING(Id_Kategori)
           JOIN siswa sis USING(NIS)
           WHERE 1=1 $where_clause";
}else{
    $sql = "SELECT s.*, kat.Kategori, k.Jenis_Kegiatan, kat.Sub_Kategori, sis.Nama_Siswa, sis.Angkatan,
            (SELECT IFNULL(SUM(Angka_Kredit), 0) FROM sertifikat JOIN kegiatan USING(Id_Kegiatan) 
             WHERE Id_Sertifikat = s.Id_Sertifikat) AS Total_Skor
           FROM sertifikat s 
           JOIN kegiatan k USING (Id_Kegiatan) 
           JOIN kategori kat USING(Id_Kategori)
           JOIN siswa sis USING(NIS)
           WHERE s.NIS = '$cek_nis' $where_clause";
}

$result = mysqli_query($koneksi, $sql);

?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Analisa Siswa</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Sertifikat</a></li>
            </ol>
        </div>
        <?php
        $cek_nis = $_COOKIE['nis'] ?? NULL;
        if ($cek_nis == NULL) {
        ?>
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="dashboard_box d-flex flex-wrap justify-content-between px-0">
                        <div class="dashboard_card col-lg-3 col-md-6">
                            <?php
                                $querySertifikat = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM sertifikat");
                                $jumlahSertifikat = mysqli_fetch_assoc($querySertifikat)['total'];
                                ?>
                            <div>
                                <div class="card_number"><?=$jumlahSertifikat?></div>
                                <div class="card_name">Total Sertifikat</div>
                            </div>

                            <div class="icon_card">
                                <i class="fa fa-certificate"></i>
                            </div>
                        </div>

                        <div class="dashboard_card col-lg-3 col-md-6">
                            <?php
                    $queryApproved = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM sertifikat WHERE Status = 'Approved'");
                    $jumlahApproved = mysqli_fetch_assoc($queryApproved)['total'];
                    ?>
                            <div>
                                <div class="card_number"><?=$jumlahApproved?></div>
                                <div class="card_name">Total Valid</div>
                            </div>

                            <div class="icon_card">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>

                        <div class="dashboard_card col-lg-3 col-md-6">
                            <?php
                    $queryPending = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM sertifikat WHERE Status = 'Pending'");
                    $jumlahPending = mysqli_fetch_assoc($queryPending)['total'];
                    ?>
                            <div>
                                <div class="card_number"><?=$jumlahPending?></div>
                                <div class="card_name">Total Menunggu Validasi</div>
                            </div>

                            <div class="icon_card">
                                <i class="fa fa-clock"></i>
                            </div>
                        </div>

                        <div class="dashboard_card col-lg-3 col-md-6">
                            <?php
                    // Query jumlah kategori unik dalam kegiatan
                    $queryCanceled = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM sertifikat WHERE Status = 'Canceled'");
                    $jumlahCanceled = mysqli_fetch_assoc($queryCanceled)['total'];
                    ?>
                            <div>
                                <div class="card_number"><?=$jumlahCanceled?></div>
                                <div class="card_name">Total Tidak Valid</div>
                            </div>

                            <div class="icon_card">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Your existing analytics code -->
        <?php
        }else{
        ?>
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="dashboard_box d-flex flex-wrap justify-content-between px-0">
                        <div class="dashboard_card col-lg-3 col-md-6">
                            <?php
                                $query = "SELECT *, SUM(Angka_Kredit) as 'Total_Kredit'
                                FROM sertifikat 
                                JOIN kegiatan USING (Id_Kegiatan)
                                WHERE NIS = '$cek_nis' AND Status = 'Approved'";
                                $result = mysqli_query($koneksi, $query);
                                $data = mysqli_fetch_assoc($result);
                                $skor = $data['Total_Kredit'] ?? 0;
                                ?>
                            <div>

                                <div class="card_number"><?=$skor?> / 30</div>
                                <div class="card_name">Poin Terkumpul</div>
                                <?php
                                if($skor >= 30){
                                ?>
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="button" class="btn light btn-warning" id="cetak_sertifikat">Cetak
                                        Sertifikat</button>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="icon_card">
                                <i class="fa fa-certificate"></i>
                            </div>
                        </div>

                        <div class="dashboard_card col-lg-3 col-md-6">
                            <?php
                    $queryApproved = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM sertifikat WHERE Status = 'Approved' AND NIS = '$cek_nis'");
                    $jumlahApproved = mysqli_fetch_assoc($queryApproved)['total'];
                    ?>
                            <div>
                                <div class="card_number"><?=$jumlahApproved?></div>
                                <div class="card_name">Total Valid</div>
                            </div>

                            <div class="icon_card">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>

                        <div class="dashboard_card col-lg-3 col-md-6">
                            <?php
                    $queryPending = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM sertifikat WHERE Status = 'Pending' AND NIS = '$cek_nis'");
                    $jumlahPending = mysqli_fetch_assoc($queryPending)['total'];
                    ?>
                            <div>
                                <div class="card_number"><?=$jumlahPending?></div>
                                <div class="card_name">Total Menunggu Validasi</div>
                            </div>

                            <div class="icon_card">
                                <i class="fa fa-clock"></i>
                            </div>
                        </div>

                        <div class="dashboard_card col-lg-3 col-md-6">
                            <?php
                    // Query jumlah kategori unik dalam kegiatan
                    $queryCanceled = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM sertifikat WHERE Status = 'Canceled' AND NIS = '$cek_nis'");
                    $jumlahCanceled = mysqli_fetch_assoc($queryCanceled)['total'];
                    ?>
                            <div>
                                <div class="card_number"><?=$jumlahCanceled?></div>
                                <div class="card_name">Total Tidak Valid</div>
                            </div>

                            <div class="icon_card">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>

        <!-- Certificate Section - Modified to match your image -->
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Semua Data</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Sertifikat</a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <?php 
                            $cek_nis = $_COOKIE['nis'] ?? NULL;
                            if($cek_nis !== NULL){
                        ?>
                        <a href="dashboard.php?page=tambah_sertifikat" class="btn btn-rounded btn-info"><span
                                class="btn-icon-start text-info"><i class="fa fa-plus color-secondary"></i>
                            </span>Tambah Data</a>
                        <?php
                        }
                        ?>
                        <div class="d-flex align-items-center ms-auto">
                            <div class="input-group me-2 position-relative" style="width: 250px;">
                                <input type="text" class="form-control" id="live-search" placeholder="Cari apapun..."
                                    autocomplete="off">
                                <div class="spinner-border spinner-border-sm text-primary position-absolute end-0 top-50 translate-middle-y me-2"
                                    id="search-spinner" style="display: none;"></div>
                            </div>
                            <div id="search-info" class="me-2" style="display: none;">
                                <small class="text-muted">Ditemukan <span id="result-count">0</span> hasil</small>
                            </div>
                            <button id="reset-search" class="btn btn-sm btn-outline-secondary text-white me-2"
                                style="display: none;">Reset</button>
                            <?php 
                            $cek_nis = $_COOKIE['nis'] ?? NULL;
                            if($cek_nis == NULL){
                            ?>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn light btn-warning" data-bs-toggle="modal"
                                data-bs-target="#exampleModalCenter" id="filter">Cetak Laporan</button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Laporan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom07">Angkatan
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="wide form-control" name="angkatan" id="angkatan">
                                                        <option data-display="Pilihan Angkatan">Pilih
                                                            Angkatan</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a one.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" id="nextModal">Lanjut</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="modalFilter" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Laporan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom07">Angkatan
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="wide form-control" id="angkatan_selected">
                                                        <option data-display="Pilihan Angkatan">Pilih
                                                            Angkatan</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a one.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom07">Nama/NIS
                                                    Siswa
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select id="siswa" class="form-control">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom07">Status
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="wide form-control" name="status" id="status">
                                                        <option data-display="Pilihan Status">Pilih
                                                            Status
                                                        </option>
                                                        <!-- <option value="Approved">
                                                                        Approved</option>
                                                                    <option value="Pending">
                                                                        Pending</option>
                                                                    <option value="Canceled">
                                                                        Canceled
                                                                    </option> -->
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please select a one.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" id="cetakPDF" class="btn btn-primary">Cetak
                                                PDF</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                    <div class="card-header d-flex justify-content-center align-items-center">
                        <h4 class="card-title fs-35">Sertifikat</h4>
                    </div>
                    <div class="card-body">
                        <!-- Status filter buttons -->
                        <div class="mb-4 border-bottom">
                            <ul class="nav nav-tabs border-0">
                                <li class="nav-item">
                                    <a class="nav-link active" data-status="all" href="#all">Semua</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-status="Pending" href="#pending">Menunggu Validasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-status="Canceled" href="#canceled">Tidak Valid</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-status="Approved" href="#approved">Sudah
                                        Tervalidasi</a>
                                </li>
                            </ul>
                        </div>

                        <div class="certificate-container" style="height: 100vh; overflow: auto;">
                            <?php 
                            $cek_nis = $_COOKIE['nis'] ?? NULL;
                            if($cek_nis == NULL){
                                $result = mysqli_query($koneksi, "SELECT s.*, kat.Kategori, k.Jenis_Kegiatan, kat.Sub_Kategori, sis.Nama_Siswa, sis.Angkatan, sis.No_Telp, j.Jurusan,
                                                        (SELECT IFNULL(SUM(Angka_Kredit), 0) FROM sertifikat JOIN kegiatan USING(Id_Kegiatan) WHERE Id_Sertifikat = s.Id_Sertifikat) AS Total_Skor
                                                       FROM sertifikat s 
                                                       JOIN kegiatan k USING (Id_Kegiatan) 
                                                       JOIN kategori kat USING(Id_Kategori)
                                                       JOIN siswa sis USING(NIS)
                                                       JOIN jurusan j USING(Id_Jurusan)");
                            }else{
                                $result = mysqli_query($koneksi, "SELECT s.*, kat.Kategori, k.Jenis_Kegiatan, kat.Sub_Kategori, sis.Nama_Siswa, sis.Angkatan, sis.No_Telp, j.Jurusan,
                                                        (SELECT IFNULL(SUM(Angka_Kredit), 0) FROM sertifikat JOIN kegiatan USING(Id_Kegiatan) WHERE Id_Sertifikat = s.Id_Sertifikat) AS Total_Skor
                                                       FROM sertifikat s 
                                                       JOIN kegiatan k USING (Id_Kegiatan) 
                                                       JOIN kategori kat USING(Id_Kategori)
                                                       JOIN siswa sis USING(NIS)
                                                       JOIN jurusan j USING(Id_Jurusan)
                                                       WHERE s.NIS = '$cek_nis'");
                            }
                            
                            while ($data = mysqli_fetch_assoc($result)) { 
                                // Determine status class for badge
                                $status_class = '';
                                if($data['Status'] == 'Approved') {
                                    $status_class = 'badge-success';
                                } elseif($data['Status'] == 'Pending') {
                                    $status_class = 'badge-warning text-dark';
                                } else {
                                    $status_class = 'badge-danger';
                                }
                            ?>
                            <div class="certificate-card mb-5 sertifikat_shadow position-relative"
                                data-status="<?= $data['Status'] ?>" style="border-radius: 15px; margin: 2rem;">
                                <div class="card">
                                    <div class="card-body">
                                        <div
                                            class="d-flex align-items-center justify-content-between p-3 rounded mb-3 certificate-header">
                                            <div class="d-flex align-items-center">
                                                <div class="btn btn-dark p-2 me-3 sertifikat_kategori">
                                                    <h5 class="mb-0"><?= $data['Kategori'] ?></h5>
                                                </div>
                                                <h5 class="mb-0">
                                                    <span
                                                        class="sertifikat_kegiatan"><?= $data['Sub_Kategori'] ?></span>
                                                    >
                                                    <?= $data['Jenis_Kegiatan'] ?>
                                                </h5>
                                            </div>
                                            <!-- Score Badge -->
                                            <div class="score-badge">
                                                <div class="badge bg-primary rounded-pill fs-6 px-3 py-2">
                                                    <i class="fas fa-star text-warning me-1"></i>
                                                    <span><?= number_format($data['Total_Skor'], 0) ?>
                                                        Poin</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-8">
                                                <div class="d-flex mb-2">
                                                    <i class="fas fa-file-pdf text-danger me-2 mt-1"></i>
                                                    <div>
                                                        <a href="../uploads/<?= htmlspecialchars($data['Sertifikat']) ?>"
                                                            class="text-primary">Lihat File</a>
                                                        <p class="text-muted mb-0"><?= $data['NIS'] ?> -
                                                            <?= $data['Nama_Siswa'] ?> - <?= $data['Jurusan'] ?></p>
                                                    </div>
                                                </div>

                                                <div class="d-flex">
                                                    <i class="fab fa-whatsapp text-success me-2 mt-1"></i>
                                                    <p class="mb-0">
                                                        <?php 
                                                            $no_telp = $data['No_Telp']; // Ambil data nomor telepon
                                                            if (substr($no_telp, 0, 2) == "08") {
                                                                $no_telp = "62" . substr($no_telp, 1); // Ubah '08' menjadi '62'
                                                            }
                                                            echo substr($no_telp, 0, 2) . '-' . substr($no_telp, 2, 3) . '-' . substr($no_telp, 5, 3) . '-' . substr($no_telp, 8);
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-4 text-md-end">
                                                <div class="d-flex flex-column align-items-end">
                                                    <span
                                                        class="badge <?= $status_class ?> mb-2"><?= $data['Status'] ?></span>
                                                    <?php
                                                    if (!empty($data['Catatan'])) {
                                                    ?>
                                                    <p class="text-danger mb-1">Catatan: <?= $data['Catatan'] ?></p>
                                                    <?php
                                                    }
                                                    ?>
                                                    <p class="mb-1">Angkatan: <?= $data['Angkatan'] ?></p>
                                                    <p class="mb-0"><?= $data['Tanggal_Upload'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end">
                                            <?php
                                            $cek_nis = $_COOKIE['nis'] ?? NULL;
                                            
                                            // For admin only: show edit button for non-Approved, non-Canceled certificates
                                            if($cek_nis == NULL && $data['Status'] !== 'Approved' && $data['Status'] !== 'Canceled'): ?>
                                                <a href="dashboard.php?page=update_sertifikat&id_sertifikat=<?= $data['Id_Sertifikat'] ?>"
                                                    class="btn btn-primary shadow sharp me-1">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            <?php endif; 
                                            
                                            // For both admin and student: show delete button only if status is not Approved
                                            if($data['Status'] !== 'Approved'): ?>
                                                <a onclick="confirmDelete(<?= $data['Id_Sertifikat'] ?>)"
                                                    class="btn btn-danger shadow sharp">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Certificate cards - Using your existing database structure -->

                </div>
            </div>
        </div>
    </div>

    <!-- Add JavaScript for filtering -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const filterLinks = document.querySelectorAll('.nav-link[data-status]');
    const certificateCards = document.querySelectorAll('.certificate-card');
    const certificateContainer = document.querySelector('.certificate-container');
    
    // Search-related elements
    const searchInput = document.getElementById('live-search');
    const searchSpinner = document.getElementById('search-spinner');
    const searchInfo = document.getElementById('search-info');
    const resultCount = document.getElementById('result-count');
    const resetButton = document.getElementById('reset-search');
    
    // Variabel untuk throttling
    let searchTimeout = null;
    let currentStatus = 'all';

    // Function to check if there are visible cards and show/hide empty state message
    function checkEmptyState(status) {
        // Remove any existing empty state message
        const existingEmptyState = document.getElementById('empty-state-message');
        if (existingEmptyState) {
            existingEmptyState.remove();
        }

        // Count visible cards with the current status
        let visibleCount = 0;
        certificateCards.forEach(card => {
            if (status === 'all' || card.getAttribute('data-status') === status) {
                visibleCount++;
            }
        });

        // If no cards are visible, show empty state message
        if (visibleCount === 0) {
            let statusText = 'data';
            switch (status) {
                case 'Approved':
                    statusText = 'sertifikat yang sudah tervalidasi';
                    break;
                case 'Pending':
                    statusText = 'sertifikat yang menunggu validasi';
                    break;
                case 'Canceled':
                    statusText = 'sertifikat yang tidak valid';
                    break;
                default:
                    statusText = 'data sertifikat';
            }

            const emptyStateDiv = document.createElement('div');
            emptyStateDiv.id = 'empty-state-message';
            emptyStateDiv.classList.add('text-center', 'py-5', 'my-4');
            emptyStateDiv.innerHTML = `
            <div class="mb-3">
                <i class="fas fa-file-alt text-muted" style="font-size: 4rem;"></i>
            </div>
            <h4 class="text-muted">Tidak ada ${statusText}</h4>
            <p class="text-muted">Belum ada data yang tersedia untuk ditampilkan</p>
        `;
            certificateContainer.appendChild(emptyStateDiv);
        }
    }

    filterLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            // Remove active class from all links
            filterLinks.forEach(el => el.classList.remove('active'));

            // Add active class to clicked link
            this.classList.add('active');

            currentStatus = this.getAttribute('data-status');

            // Show/hide certificates based on status
            certificateCards.forEach(card => {
                if (currentStatus === 'all' || card.getAttribute('data-status') === currentStatus) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            // Check if we need to show empty state message
            checkEmptyState(currentStatus);
            
            // If there's an active search, refresh the results
            if (searchInput.value.trim() !== '') {
                performSearch(searchInput.value.trim());
            }
        });
    });

    // Run the check on initial page load for the default active tab
    const activeTabStatus = document.querySelector('.nav-link.active').getAttribute('data-status');
    checkEmptyState(activeTabStatus);

    // Make the confirmDelete function available globally
    window.confirmDelete = function(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data akan dihapus dan tidak bisa dikembalikan!",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                // Redirect ke PHP untuk hapus data
                window.location.href = 'dashboard.php?page=sertifikat&id_sertifikat=' + id + '&confirm_delete=true';
            }
        });
    };

    // Live search ketika mengetik
    searchInput.addEventListener('input', function() {
        const keyword = this.value.trim();

        // Tampilkan spinner
        searchSpinner.style.display = 'block';

        // Clear timeout sebelumnya jika ada
        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }

        // Set timeout baru (throttling untuk mengurangi beban server)
        searchTimeout = setTimeout(() => {
            performSearch(keyword);
        }, 300); // 300ms delay
    });

    // Reset pencarian
    resetButton.addEventListener('click', function() {
        searchInput.value = '';
        performSearch('');
        this.style.display = 'none';
    });

    // Fungsi untuk melakukan pencarian
    function performSearch(keyword) {
        // Sembunyikan spinner setelah search selesai
        searchSpinner.style.display = 'none';

        // Jika keyword kosong, tampilkan semua card sesuai filter status
        if (keyword === '') {
            // Reset highlights jika ada
            document.querySelectorAll('.highlight-text').forEach(el => {
                el.outerHTML = el.textContent;
            });

            // Tampilkan semua card sesuai filter status
            let visibleCount = 0;
            certificateCards.forEach(card => {
                if (currentStatus === 'all' || card.getAttribute('data-status') === currentStatus) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Check for empty state after search is cleared
            checkEmptyState(currentStatus);

            // Sembunyikan info pencarian
            searchInfo.style.display = 'none';
            resetButton.style.display = 'none';
            return;
        }

        // Tampilkan tombol reset
        resetButton.style.display = 'block';

        // Lakukan pencarian pada semua elemen card
        let matchCount = 0;

        certificateCards.forEach(card => {
            // Ambil semua teks dalam card
            const cardText = card.textContent.toLowerCase();
            const cardStatus = card.getAttribute('data-status');

            // Cek apakah card mengandung keyword dan sesuai dengan filter status
            const matchesKeyword = cardText.includes(keyword.toLowerCase());
            const matchesStatus = currentStatus === 'all' || cardStatus === currentStatus;

            if (matchesKeyword && matchesStatus) {
                card.style.display = 'block';
                matchCount++;

                // Highlight teks yang cocok
                highlightMatches(card, keyword);
            } else {
                card.style.display = 'none';
            }
        });

        // Check if we need to show empty state for search results
        if (matchCount === 0) {
            const existingEmptyState = document.getElementById('empty-state-message');
            if (existingEmptyState) {
                existingEmptyState.remove();
            }

            const emptyStateDiv = document.createElement('div');
            emptyStateDiv.id = 'empty-state-message';
            emptyStateDiv.classList.add('text-center', 'py-5', 'my-4');
            emptyStateDiv.innerHTML = `
            <div class="mb-3">
                <i class="fas fa-search text-muted" style="font-size: 4rem;"></i>
            </div>
            <h4 class="text-muted">Tidak ada hasil pencarian</h4>
            <p class="text-muted">Tidak ditemukan sertifikat yang sesuai dengan kriteria pencarian</p>
        `;
            certificateContainer.appendChild(emptyStateDiv);
        } else {
            // Remove empty state if we have matches
            const existingEmptyState = document.getElementById('empty-state-message');
            if (existingEmptyState) {
                existingEmptyState.remove();
            }
        }

        // Update info hasil pencarian
        resultCount.textContent = matchCount;
        searchInfo.style.display = 'block';
    }

    // Fungsi untuk highlight teks yang cocok
    function highlightMatches(element, keyword) {
        // Hapus highlights sebelumnya
        element.querySelectorAll('.highlight-text').forEach(el => {
            el.outerHTML = el.textContent;
        });

        if (!keyword) return;

        // Fungsi rekursif untuk mencari dan highlight teks
        function searchAndHighlight(node) {
            if (node.nodeType === 3) { // Text node
                const text = node.nodeValue;
                const lowerText = text.toLowerCase();
                const lowerKeyword = keyword.toLowerCase();

                if (lowerText.includes(lowerKeyword)) {
                    const parts = [];
                    let lastIndex = 0;
                    let index;

                    // Find all instances of the keyword
                    while ((index = lowerText.indexOf(lowerKeyword, lastIndex)) > -1) {
                        // Add text before match
                        if (index > lastIndex) {
                            parts.push(document.createTextNode(text.substring(lastIndex, index)));
                        }

                        const span = document.createElement('span');
                        span.className = 'highlight-text';
                        span.style.backgroundColor = '#ffff00';
                        span.style.color = '#000';
                        span.textContent = text.substring(index, index + keyword.length);
                        parts.push(span);
                        
                        lastIndex = index + keyword.length;
                    }

                    // Add remaining text
                    if (lastIndex < text.length) {
                        parts.push(document.createTextNode(text.substring(lastIndex)));
                    }

                    // Replace original node with highlighted parts
                    const fragment = document.createDocumentFragment();
                    parts.forEach(part => fragment.appendChild(part));
                    node.parentNode.replaceChild(fragment, node);
                    return true;
                }
            } else if (node.nodeType === 1 && // Element node
                node.nodeName !== 'SCRIPT' &&
                node.nodeName !== 'STYLE' &&
                !node.classList.contains('highlight-text')) {
                // Process child nodes
                Array.from(node.childNodes).forEach(child => {
                    searchAndHighlight(child);
                });
            }
            return false;
        }

        searchAndHighlight(element);
    }
});
    </script>