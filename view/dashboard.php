<?php
include "../koneksi.php";

session_start();

if (!isset($_COOKIE["username"]) && !isset($_COOKIE["nis"])){
    echo "<script>alert('Anda Belum Login'); window.location.href = '../login.php'</script>";
}


else {
    
$page = $_GET['page'] ?? '';

// Cek apakah pengguna adalah siswa (dengan adanya NIS)
if (isset($_COOKIE["nis"])) {
    // Jika siswa mencoba mengakses halaman selain sertifikat, arahkan kembali
    if ($page !== 'sertifikat' && $page !== 'tambah_sertifikat' && $page !== 'update_sertifikat' && $page !== 'update_user' && $page !== 'update_user_2') {
        header("Location: dashboard.php?page=sertifikat");
        exit();
    }
}

    $id = $_COOKIE["id_pengguna"];
    if(!isset($_COOKIE["nis"])){
        $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT Id_Pengguna, Username, Password, Nama_Lengkap FROM pengguna JOIN pegawai USING(username) WHERE Id_Pengguna='$id'"));
    }else{
        $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pengguna JOIN siswa USING(NIS) WHERE Id_Pengguna='$id'"));
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Theo : Dashboard SKKPd">
    <meta property="og:title" content="Theo : Dashboard SKKPd">
    <meta property="og:description" content="Theo : Dashboard SKKPd">
    <meta property=" og:image" content="https://fillow.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>SKKPd Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <!-- <script src="../js/plugins-init/sweetalert.init.js"></script> -->

    <link href="../vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="../vendor/select2/css/select2.min.css" rel="stylesheet" />
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="../images/favicon.png">
    <!-- Datatable -->
    <link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header" style="z-index: 100;">
            <a href="index.html" class="brand-logo">
                <svg class="logo-abbr" width="55" height="55" viewBox="0 0 55 55" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M27.5 0C12.3122 0 0 12.3122 0 27.5C0 42.6878 12.3122 55 27.5 55C42.6878 55 55 42.6878 55 27.5C55 12.3122 42.6878 0 27.5 0ZM17 16H38V24H30V40H24V24H17V16Z"
                        fill="url(#paint0_linear)"></path>
                    <defs>
                    </defs>
                </svg>
                <div class="brand-title">
                    <h2 class="">TAROT</h2>
                    <!-- <span class="brand-sub-title">Tracking Achievement & Record of Talent</span> -->
                </div>
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->





        <!--**********************************
            Header start
        ***********************************-->
        <div class="header" style="z-index: 99;">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                Dashboard
                            </div>

                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    <svg width="28" height="28" viewbox="0 0 28 28" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M23.3333 19.8333H23.1187C23.2568 19.4597 23.3295 19.065 23.3333 18.6666V12.8333C23.3294 10.7663 22.6402 8.75902 21.3735 7.12565C20.1068 5.49228 18.3343 4.32508 16.3333 3.80679V3.49996C16.3333 2.88112 16.0875 2.28763 15.6499 1.85004C15.2123 1.41246 14.6188 1.16663 14 1.16663C13.3812 1.16663 12.7877 1.41246 12.3501 1.85004C11.9125 2.28763 11.6667 2.88112 11.6667 3.49996V3.80679C9.66574 4.32508 7.89317 5.49228 6.6265 7.12565C5.35983 8.75902 4.67058 10.7663 4.66667 12.8333V18.6666C4.67053 19.065 4.74316 19.4597 4.88133 19.8333H4.66667C4.35725 19.8333 4.0605 19.9562 3.84171 20.175C3.62292 20.3938 3.5 20.6905 3.5 21C3.5 21.3094 3.62292 21.6061 3.84171 21.8249C4.0605 22.0437 4.35725 22.1666 4.66667 22.1666H23.3333C23.6428 22.1666 23.9395 22.0437 24.1583 21.8249C24.3771 21.6061 24.5 21.3094 24.5 21C24.5 20.6905 24.3771 20.3938 24.1583 20.175C23.9395 19.9562 23.6428 19.8333 23.3333 19.8333Z"
                                            fill="#717579"></path>
                                        <path
                                            d="M9.9819 24.5C10.3863 25.2088 10.971 25.7981 11.6766 26.2079C12.3823 26.6178 13.1838 26.8337 13.9999 26.8337C14.816 26.8337 15.6175 26.6178 16.3232 26.2079C17.0288 25.7981 17.6135 25.2088 18.0179 24.5H9.9819Z"
                                            fill="#717579"></path>
                                    </svg>
                                    <?php
                                    $nis = $_COOKIE['nis'] ?? NULL;
                                    if ($nis == NULL) {
                                        $query = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah, notifikasi.Status, notifikasi.NIS FROM notifikasi WHERE notifikasi.Status = 'Unread'");
                                        $notif = mysqli_fetch_assoc($query);
                                    }
                                    else{
                                        $query = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah, notifikasi.Status, sertifikat.NIS  FROM notifikasi JOIN sertifikat USING(Id_Sertifikat) WHERE notifikasi.Status = 'Unread' AND sertifikat.NIS = '$nis'");
                                        $notif = mysqli_fetch_assoc($query);
                                    }
                                    $jumlah_notif = $notif['jumlah'];
                                    ?>
                                    <span class="badge bgl-danger text-danger rounded-circle border-0" id="jumlahNotif">
                                        <?= $jumlah_notif; ?>
                                    </span>
                                </a>
                                <?php
                                    $cek_nis = $_COOKIE['nis'] ?? NULL;
                                    if ($cek_nis !== NULL) {
                                    
                                    $query = mysqli_query($koneksi, 
                                        "SELECT *, notifikasi.Status AS notif_status, sertifikat.NIS
                                        FROM notifikasi 
                                        JOIN sertifikat USING(Id_Sertifikat)
                                        WHERE sertifikat.NIS = '$cek_nis'
                                        GROUP BY Id_Notifikasi
                                        ORDER BY 
                                            (CASE 
                                                WHEN notifikasi.Status = 'Unread' THEN 0 
                                                ELSE 1 
                                            END), 
                                            Tgl_Notifikasi DESC"
                                    );
                                    
                                    $jumlah_notif = mysqli_num_rows($query);
                                ?>
                                <div class="dropdown-menu dropdown-menu-end" style="
                                        box-shadow: 0px -3px 40px -12px red;
                                    ">
                                    <div id="DZ_W_Notification1" class="widget-media dlab-scroll p-3"
                                        style="height:380px;">
                                        <div
                                            class="d-flex justify-content-between align-items-center p-3 pt-0 mb-3 border-bottom">
                                            <h5 class="m-0">Notifikasi</h5>
                                            <?php if ($jumlah_notif > 0) { ?>
                                            <button class="btn btn-sm btn light btn-danger"
                                                onclick="deleteAllNotifications('<?= $cek_nis ?>')">
                                                Delete All
                                            </button>
                                            <?php } ?>
                                        </div>
                                        <ul class="timeline">
                                            <?php while ($notif = mysqli_fetch_assoc($query)) { ?>
                                            <li>
                                                <a href="dashboard.php?page=sertifikat" class="notif-item"
                                                    onclick="markAsRead(<?= $notif['Id_Notifikasi'] ?>, this, event)">
                                                    <div class="timeline-panel">
                                                        <div class="media me-2">
                                                            <img alt="image" width="50" src="../images/user2.png">
                                                        </div>
                                                        <div class="media-body">
                                                            <span class="mb-1 badge bgl-warning text-warning font-w700">
                                                                Admin
                                                            </span>

                                                            <span class="mb-1 badge <?= $notif['notif_status'] == 'Unread' ? 'bgl-danger text-danger' : 'bgl-success text-success' ?>
                                                            font-w700">
                                                                <?= $notif['notif_status'] ?>
                                                            </span>
                                                            <span class="mb-1 badge
                                                            <?php if($notif['Pesan'] == 'Sertifikat-mu baru saja diubah oleh Admin menjadi Approved'){echo 'bgl-success text-success';
                                                            }elseif($data['Pesan'] == 'Sertifikat-mu baru saja diubah oleh Admin menjadi Pending'){echo 'bgl-warning text-warning';} else{echo 'bgl-danger text-danger';}?>
                                                            font-w700">
                                                                <?php if($notif['Pesan'] == 'Sertifikat-mu baru saja diubah oleh Admin menjadi Approved'){echo 'Approved';
                                                            }elseif($data['Pesan'] == 'Sertifikat-mu baru saja diubah oleh Admin menjadi Pending'){echo 'Pending';} else{echo 'Canceled';}?>
                                                            </span>
                                                            <h6 class=" mb-1"><?= $notif['Pesan'] ?></h6>
                                                            <h6 class="d-block">
                                                                <?= date("d M Y", strtotime($notif['Tgl_Notifikasi'])) ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>

                                            <?php } ?>

                                            <?php if ($jumlah_notif == 0) { ?>
                                            <li>
                                                <p class="text-center">Tidak ada notifikasi baru</p>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <?php
                            }
                            $query = mysqli_query($koneksi, 
                            "SELECT *, notifikasi.Status AS notif_status 
                            FROM notifikasi 
                            GROUP BY Id_Notifikasi
                            ORDER BY 
                                (CASE 
                                    WHEN notifikasi.Status = 'Unread' THEN 0 
                                    ELSE 1 
                                END), 
                                Tgl_Notifikasi DESC"
                        );
                            $jumlah_notif = mysqli_num_rows($query);
                            ?>
                            <div class="dropdown-menu dropdown-menu-end" style="
                                        box-shadow: 0px -3px 40px -12px red;
                                    ">
                                <div id="DZ_W_Notification1" class="widget-media dlab-scroll p-3" style="height:380px;">
                                    <ul class="timeline">
                                        <div
                                            class="d-flex justify-content-between align-items-center p-3 pt-0 mb-3 border-bottom">
                                            <h5 class="m-0">Notifikasi</h5>
                                            <?php if ($jumlah_notif > 0) { ?>
                                            <button class="btn btn-sm btn light btn-danger"
                                                onclick="deleteAllNotifications('<?= $cek_nis ?>')">
                                                Delete All
                                            </button>
                                            <?php } ?>
                                        </div>
                                        <?php while ($notif = mysqli_fetch_assoc($query)) { ?>
                                        <li>
                                            <a href="dashboard.php?page=sertifikat" class="notif-item"
                                                onclick="markAsRead(<?= $notif['Id_Notifikasi'] ?>, this, event)">
                                                <div class="timeline-panel">
                                                    <div class="media me-2">
                                                        <img alt="image" width="50" src="../images/user2.png">
                                                    </div>
                                                    <div class="media-body">
                                                        <span class="mb-1 badge bgl-warning text-warning font-w700">
                                                            <?= $notif['NIS'] ?>
                                                        </span>
                                                        <span
                                                            class="mb-1 badge <?= $notif['notif_status'] == 'Unread' ? 'bgl-danger text-danger' : 'bgl-success text-success' ?> font-w700">
                                                            <?= $notif['notif_status'] ?>
                                                        </span>
                                                        <h6 class="mb-1"><?= $notif['Pesan'] ?></h6>
                                                        <h6 class="d-block">
                                                            <?= date("d M Y", strtotime($notif['Tgl_Notifikasi'])) ?>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>

                                        <?php } ?>

                                        <?php if ($jumlah_notif == 0) { ?>
                                        <li>
                                            <h6 class="text-center">Tidak ada notifikasi baru</h6>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>

                            <li class="nav-item dropdown  header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    <img src="../images/user2.png" width="56" alt="">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="dashboard.php?page=update_user&id_pengguna=<?= $data['Id_Pengguna'] ?>"
                                        class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                            width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ms-2">Profile </span>
                                    </a>
                                    <a href="../logout.php" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                            width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        <span class="ms-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    <?php
                        if(!isset($_COOKIE["nis"])){
                        ?>
                    <li><a href="dashboard.php?page=dashboard" class="" aria-expanded="false">
                            <i class="fa fa-chart-line"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li><a href="dashboard.php?page=siswa" class="" aria-expanded="false">
                            <i class="fas fa-user-check"></i>
                            <span class="nav-text">Siswa</span>
                        </a>
                    </li>
                    <li><a href="dashboard.php?page=kegiatan" class="" aria-expanded="false">
                            <i class="fas fa-trophy"></i>
                            <span class="nav-text">Kegiatan</span>
                        </a>
                    </li>
                    <li><a href="dashboard.php?page=jurusan" class="" aria-expanded="false">
                            <i class="fas fa-laptop"></i>
                            <span class="nav-text">Jurusan</span>
                        </a>
                    </li>
                    <li><a href="dashboard.php?page=operator" class="" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <span class="nav-text">Operator</span>
                        </a>
                    </li>
                    <li><a href="dashboard.php?page=sertifikat" class="" aria-expanded="false">
                            <i class="fas fa-certificate"></i>
                            <span class="nav-text">Sertifikat</span>
                        </a>
                    </li>
                    <?php
                        }else{
                    ?>
                    <li><a href="dashboard.php?page=sertifikat" class="" aria-expanded="false">
                            <i class="fas fa-certificate"></i>
                            <span class="nav-text">Sertifikat</span>
                        </a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
                <div class="side-bar-profile">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="side-bar-profile-img">
                            <img src="../images/user2.png" alt="">
                        </div>
                        <div class="profile-info1">
                            <h4 class="fs-18 font-w500"><?php 
                            if(!isset($_COOKIE["nis"])){
                                echo $_COOKIE['username']; 
                            }else{
                                echo $data['Nama_Siswa'];
                            }
                        ?></h4>
                            <span><?php 
                            if(!isset($_COOKIE["nis"])){
                                echo 'admin'; 
                            }else{
                                echo $_COOKIE['nis'];
                            }
                        ?></span>
                        </div>
                        <!-- Dropdown -->
                        <div class="profile-dropdown">
                            <i class="fas fa-caret-down scale5 text-light profile-button"></i>
                            <div class="dropdown-menu">
                                <a href="dashboard.php?page=update_user&id_pengguna=<?= $data['Id_Pengguna'] ?>"
                                    class="dropdown-item ai-icon">
                                    <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                        width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <span class="ms-2">Profile </span>
                                </a>
                                <a href="../logout.php" class="dropdown-item ai-icon">
                                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                        width="18" height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span class="ms-2">Logout </span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php
                    $cek_nis = $_COOKIE['nis'] ?? NULL;
                    if (isset($_COOKIE['nis'])) {
                        $query = "SELECT *, SUM(Angka_Kredit) as 'Total_Kredit', SUM(Angka_Kredit) / 30 * 100 as 'Persen'
                                FROM sertifikat 
                                JOIN kegiatan USING (Id_Kegiatan)
                                WHERE NIS = '$cek_nis' AND Status = 'Approved'";
                        $result = mysqli_query($koneksi, $query);
                        $data = mysqli_fetch_assoc($result);
                        $skor = $data['Total_Kredit'] ?? 0;
                        $persen = $data['Persen'] ?? 0;
                        ?>
                    <div class="d-flex justify-content-between mb-2 progress-info">
                        <span class="fs-12"><i class="fas fa-star text-orange me-2"></i>Scor Progress</span>
                        <span class="fs-12"><?php echo $skor; ?>/30</span>
                    </div>
                    <div class="progress default-progress">
                        <div class="progress-bar bg-gradientf progress-animated"
                            style="width: <?php echo $persen; ?>%; height:10px;" role="progressbar">

                            <span class="sr-only"><?php echo $persen; ?> Complete</span>

                        </div>
                    </div>
                    <?php
                    }
                     ?>
                </div>

                <div class="copyright">
                    <p><strong>Theo Darmawan Admin</strong> © 2021 All Rights Reserved</p>
                    <p class="fs-12">Made with <span class="heart"></span> by Theo D</p>
                </div>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <?php
        switch ($_GET['page']) {
                
            case 'siswa':
                include "view_siswa.php";
                break;
            case 'tambah_siswa':
                include "../insert/insert_siswa.php";
                break;
            case 'update_siswa':
                include "../update/update_siswa.php";
                break;

            case 'jurusan':
                include "view_jurusan.php";
                break;
            case 'tambah_jurusan':
                include "../insert/insert_jurusan.php";
                break;
            case 'update_jurusan':
                include "../update/update_jurusan.php";
                break;
                
            case 'operator':
                include "view_operator.php";
                break;
            case 'tambah_operator':
                include "../insert/insert_operator.php";
                break;
            case 'update_user':
                include "../update/update_user.php";
                break;
            case 'update_user_2':
                include "../update/update_user_2.php";
                break;
                
            case 'kegiatan':
                include "view_kegiatan.php";
                break;
            case 'tambah_kegiatan':
                include "../insert/insert_kegiatan.php";
                break;
            case 'update_kegiatan':
                include "../update/update_kegiatan.php";
                break;
           
            case 'sertifikat':
                include "view_sertifikat.php";
                break;
            case 'tambah_sertifikat':
                include "../insert/insert_sertifikat.php";
                break;
            case 'update_sertifikat':
                include "../update/update_sertifikat.php";
                break;
                
            case 'dashboard':
                include "view_dashboard.php";
                break;
            }

    ?>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer ps-0 mx-auto">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="../index.html" target="_blank">Theo D</a> 2025
                </p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->


    </div>
    <!--**********************************
    Main wrapper end
    ***********************************-->


    <!--**********************************
    Scripts
    ***********************************-->

    <!-- Required vendors -->
    <script src="../vendor/global/global.min.js"></script>

    <!-- Apex Chart -->
    <script src="../vendor/apexchart/apexchart.js"></script>

    <!-- Datatable -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../js/plugins-init/datatables.init.js"></script>
    <script src="../vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="../vendor/select2/js/select2.full.min.js"></script>

    <!-- Chart piety plugin files -->
    <script src="../vendor/peity/jquery.peity.min.js"></script>

    <!-- Dashboard 1 -->
    <script src="../js/dashboard/dashboard-1.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/dlabnav-init.js"></script>


    <script>

    jQuery(document).ready(function() {
        setTimeout(function() {
            dlabSettingsOptions.version = 'dark';
            new dlabSettings(dlabSettingsOptions);
        }, 100); // Kurangi delay agar lebih cepat
    });

    // This script handles theme setting, preloader styling, and proper class handling
    // Place this at the end of your HTML body, right before closing </body> tag

    document.addEventListener('DOMContentLoaded', function() {
        // 1. Fix preloader background color to match current theme
        const preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.style.backgroundColor = '#1e1e1e'; // Dark background for preloader
        }
        
        // 2. Proper theme cookie handling
        function setThemeCookie(theme) {
            const expiryDate = new Date();
            expiryDate.setMonth(expiryDate.getMonth() + 6); // Cookie expires in 6 months
            document.cookie = "dlabTheme=" + theme + "; expires=" + expiryDate.toUTCString() + "; path=/; SameSite=Strict";
        }
        
        function getThemeCookie() {
            const name = "dlabTheme=";
            const decodedCookie = decodeURIComponent(document.cookie);
            const ca = decodedCookie.split(';');
            for(let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) === 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "dark"; // Default to dark if no cookie found
        }
        
        // 3. Apply theme from cookie on page load
        function applyTheme() {
            const savedTheme = getThemeCookie();
            const body = document.getElementsByTagName('body')[0];
            
            if (savedTheme === "light") {
                body.setAttribute('data-theme-version', 'light');
                body.classList.remove('dark-theme');
                
                // Find and modify buttons with light class that should be dark in light mode
                document.querySelectorAll('.btn-light, .bg-light').forEach(element => {
                    if (!element.classList.contains('btn-dark') && !element.classList.contains('preserve-light')) {
                        element.classList.remove('btn-light');
                        element.classList.add('btn-dark');
                    }
                });
            } else {
                body.setAttribute('data-theme-version', 'dark');
                body.classList.add('dark-theme');
                
                // Restore light buttons in dark mode
                document.querySelectorAll('.btn-dark').forEach(element => {
                    if (!element.classList.contains('preserve-dark')) {
                        element.classList.remove('btn-dark');
                        element.classList.add('btn-light');
                    }
                });
            }
        }
        
        // Apply theme immediately when DOM loads
        applyTheme();
        
        // 4. Override the styleSwitcher's setCookie function
        if (typeof dlabSettings !== 'undefined') {
            const originalSetCookie = dlabSettings.prototype.setCookie;
            dlabSettings.prototype.setCookie = function(cname, cvalue, exdays) {
                originalSetCookie.call(this, cname, cvalue, exdays);
                
                // If this is a theme cookie being set, use our enhanced version
                if (cname === 'dlabTheme') {
                    setThemeCookie(cvalue);
                    
                    // Apply theme change immediately
                    setTimeout(function() {
                        applyTheme();
                    }, 100);
                }
            };
        }
        
        // 5. Make sure theme switcher buttons use our enhanced cookie handling
        document.querySelectorAll('[data-theme]').forEach(button => {
            button.addEventListener('click', function() {
                const theme = this.getAttribute('data-theme');
                setThemeCookie(theme);
                setTimeout(function() {
                    applyTheme();
                }, 100);
            });
        });
    });

    $(document).ready(function() {
        $("#select#kegiatan").select2({
            width: '100%',
            dropdownParent: $("body")
        });
    });
    jQuery(document).ready(function() {
        jQuery('#kategori').change(function() {
            var Id_Kategori = jQuery("select#kategori").val();
            jQuery.ajax({
                type: 'POST',
                url: 'get_kegiatan.php',
                data: {
                    Id_Kategori: Id_Kategori
                },
                success: function(response) {
                    jQuery('select#kegiatan').html(response);
                }
            });
        });
        var kategoriSelected = jQuery('#kategori').val();
        var kegiatanTerpilih =
            <?php echo isset($data_sertifikat['Id_Kegiatan']) ? $data_sertifikat['Id_Kegiatan'] : 'null'; ?>;
        if (kategoriSelected) {
            jQuery.ajax({
                type: "POST",
                url: "get_kegiatan.php",
                data: {
                    Id_Kategori: kategoriSelected,
                    Id_Kegiatan: kegiatanTerpilih
                },
                success: function(response) {
                    $('#kegiatan').html(response);
                }
            });
        }
    });


    jQuery('.hapusdata').click(function(e) {
        e.preventDefault(); // Mencegah reload halaman

        var id_pengguna = jQuery(this).data('id'); // Ambil ID dari data-id tombol

        (async () => {
            const {
                value: formValues
            } = await Swal.fire({
                title: 'Masukkan password jika ingin menghapus',
                html: '<input type="password" class="swal2-input" id="password">',
                showCancelButton: true
            });

            if (formValues) {
                var password = jQuery("#password").val(); // Ambil password dari input

                jQuery.ajax({
                    url: '../api/delete.php?id_pengguna=' +
                        id_pengguna, // Gunakan id dari tombol
                    type: 'POST',
                    data: {
                        password: password
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            Swal.fire({
                                type: 'success',
                                title: response.message,
                                text: 'Anda akan log out',
                            }).then(() => {
                                window.location.href =
                                    "../logout.php"; // Redirect setelah swal sukses
                            });
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: response.message
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            type: 'error',
                            title: 'Terjadi kesalahan saat menghapus data!'
                        });
                    }
                });
            }
        })();
    });

    jQuery('.editdata').click(function(e) {
        e.preventDefault(); // Mencegah reload halaman

        var id_pengguna = jQuery(this).data('id'); // Ambil ID dari data-id tombol

        (async () => {
            const {
                value: formValues
            } = await Swal.fire({
                title: 'Masukkan password untuk verifikasi',
                html: '<input type="password" class="swal2-input" id="password">',
                showCancelButton: true,
            });

            if (formValues) {
                var password = jQuery("#password").val();
                jQuery.ajax({
                    url: '../api/edit.php?id_pengguna=' +
                        id_pengguna,
                    type: 'POST',
                    data: {
                        id_pengguna: id_pengguna,
                        password: password
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response); // Debugging

                        if (response.status === "success") {
                            Swal.fire({
                                type: 'success',
                                title: response.message,
                                text: 'Anda akan diarahkan ke halaman update'
                            }).then(() => {
                                window.location.href =
                                    "dashboard.php?page=update_user_2&id_pengguna=" +
                                    id_pengguna;
                            });
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: response.message
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            type: 'error',
                            title: 'Terjadi kesalahan saat mengedit data! / Password Salah!'
                        });
                    }
                });
            }
        })();
    });

    jQuery('.editdatasiswa').click(function(e) {
        e.preventDefault();

        var id_pengguna = jQuery(this).data('id');

        (async () => {
            const {
                value: formValues
            } = await Swal.fire({
                title: 'Masukkan password untuk verifikasi',
                html: '<input type="password" class="swal2-input" id="password">',
                showCancelButton: true,
            });

            if (formValues) {
                var password = jQuery("#password").val();
                var password_baru = jQuery("#password_baru").val();

                jQuery.ajax({
                    url: '../api/edit_2.php?id_pengguna=' +
                        id_pengguna, // Pastikan edit.php menangani autentikasi
                    type: 'POST',
                    data: {
                        id_pengguna: id_pengguna,
                        password: password
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            jQuery.ajax({
                                url: '../api/update_siswa_2.php',
                                type: 'POST',
                                data: {
                                    nis: response.nis,
                                    jurusan: response.jurusan,
                                    no_absen: response.no_absen,
                                    nama_siswa: response.nama_siswa,
                                    no_telp: response.no_telp,
                                    email: response.email,
                                    kelas: response.kelas,
                                    angkatan: response.angkatan,
                                    password_baru: jQuery("#password_baru").val(),
                                },
                                dataType: "json",
                                success: function(updateResponse) {
                                    let intervalId = setInterval(function() {
                                        Swal.fire({
                                            title: 'Berhasil!',
                                            text: updateResponse
                                                .message,
                                            type: updateResponse
                                                .status,
                                            timer: 2000,
                                            showConfirmButton: false,
                                            backdrop: false
                                        }).then(() => {
                                            setTimeout(() => {
                                                window
                                                    .location
                                                    .href =
                                                    'dashboard.php?page=sertifikat';
                                            }, 1000);
                                        });
                                        clearInterval(intervalId);
                                    }, 2000);
                                },
                                error: function() {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'Gagal memperbarui data!'
                                    });
                                }
                            });
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: response.message
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            type: 'error',
                            title: 'Kesalahan saat memverifikasi password!'
                        });
                    }
                });
            }
        })();
    });

    $(document).ready(function() {
        $("#angkatan").select2({
            width: '100%',
            dropdownParent: $("body")
        });
    });

    $(document).ready(function() {
        $("#status").select2({
            width: '100%',
            dropdownParent: $("body")
        });
    });

    jQuery(document).ready(function() {
        // 🔥 Load angkatan saat modal pertama dibuka
        jQuery("#exampleModalCenter").on("shown.bs.modal", function() {
            jQuery.get("../api/get_angkatan.php", function(data) {
                console.log("Response dari server:", data); // Debugging
                jQuery("#angkatan").html(data);
            });
        });

        // 🔥 Klik Lanjut untuk modal kedua
        jQuery("#nextModal").click(function() {
            var angkatan = jQuery("#angkatan").val();
            if (!angkatan) {
                alert("Pilih angkatan terlebih dahulu!");
                return;
            }

            jQuery("#angkatan_selected").html('<option value="' + angkatan + '">' + angkatan +
                '</option>');
            loadSiswa(angkatan);
            loadStatus();

            jQuery("#exampleModalCenter").modal('hide');
            jQuery("#modalFilter").modal('show');
        });

        // 🔥 Saat user mengganti angkatan di modal kedua
        jQuery("#angkatan_selected").change(function() {
            var angkatan = jQuery(this).val();
            loadSiswa(angkatan);
        });

        // 🔥 Load daftar siswa berdasarkan angkatan (dengan search select2)
        function loadSiswa(angkatan) {
            console.log("Mengambil data siswa untuk angkatan:", angkatan);

            jQuery("#siswa").empty().trigger("change"); // Reset dropdown sebelum memuat data baru

            jQuery("#siswa").select2({
                dropdownParent: jQuery("#modalFilter"),
                ajax: {
                    url: "../api/get_siswa.php",
                    type: "POST",
                    dataType: "json",
                    delay: 250,
                    data: function(params) {
                        return {
                            angkatan: angkatan,
                            search: params.term || "" // Jika kosong, tetap kirim request
                        };
                    },
                    processResults: function(data) {
                        console.log("Response dari server:", data);
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                data: [{
                    id: "all",
                    text: "Semua"
                }], // Opsi langsung terlihat saat klik dropdown
                minimumInputLength: 0, // Mengubah dari 1 ke 0 agar muncul saat diklik
                placeholder: "-- Pilih Siswa --",
                allowClear: true
            });
        }




        jQuery("#modalFilter").on("shown.bs.modal", function() {
            var angkatan = jQuery("#angkatan_selected").val();
            if (angkatan) {
                loadSiswa(angkatan);
            }
        });


        // 🔥 Load status dari tabel sertifikat
        function loadStatus() {
            jQuery.get("../api/get_status.php", function(data) {
                jQuery("#status").html(data);
            });
        }

        // 🔥 Klik Cetak PDF
        jQuery("#cetakPDF").click(function() {
            var angkatan = jQuery("#angkatan_selected").val();
            var siswa = jQuery("#siswa").val();
            var status = jQuery("#status").val();

            if (!angkatan || !siswa || !status) {
                alert("Semua filter harus dipilih!");
                return;
            }

            // Kirim request ke generate_pdf.php dengan opsi "Semua" jika dipilih
            window.open("generate_pdf.php?angkatan=" + encodeURIComponent(angkatan) +
                "&siswa=" + encodeURIComponent(siswa) +
                "&status=" + encodeURIComponent(status),
                "_blank");
        });

        jQuery("#cetak_sertifikat").click(function() {
            window.open("generate_sertifikat.php");
        });

    });

    function markAsRead(id, element) {
        event.preventDefault(); // Mencegah link langsung membuka halaman

        // Kirim AJAX untuk update status ke database
        fetch('../update/update_notif.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + id
            }).then(response => response.text())
            .then(data => {
                console.log(data);
                element.closest("li").style.opacity = "0.5"; // Buat notifikasi terlihat "redup"
                updateNotifCount();
            });

        // Arahkan ke halaman tujuan setelah 0.5 detik
        setTimeout(() => {
            window.location.href = element.href;
        }, 500);
    }

    function updateNotifCount() {
        let badge = document.getElementById("jumlahNotif");
        let count = parseInt(badge.innerText) || 0; // Pastikan jika teks kosong, dianggap 0
        count = Math.max(count - 1, 0); // Hindari angka negatif
        badge.innerText = count > 0 ? count : "0"; // Jika nol, tetap tampilkan "0"
    }
    
    document.querySelector(".profile-button").addEventListener("click", function() {
        document.querySelector(".profile-dropdown").classList.toggle("active");
    });

    // Klik di luar dropdown untuk menutupnya
    document.addEventListener("click", function(e) {
        let dropdown = document.querySelector(".profile-dropdown");
        if (!dropdown.contains(e.target)) {
            dropdown.classList.remove("active");
        }
    });

    function deleteAllNotifications(nis) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menghapus semua notifikasi?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus semua!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                // Tambahkan loading state
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Menghapus semua notifikasi',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Kirim permintaan AJAX untuk menghapus semua notifikasi
                $.ajax({
                    url: '../api/delete_all_notifications.php',
                    type: 'POST',
                    data: {
                        nis: nis
                    },
                    success: function(response) {
                        // Parse respons JSON
                        let result;
                        try {
                            result = JSON.parse(response);
                        } catch (e) {
                            console.error("Error parsing JSON:", e);
                            Swal.fire({
                                type: 'error',
                                title: 'Terjadi Kesalahan',
                                text: 'Gagal memproses respons server'
                            });
                            return;
                        }

                        if (result.success) {
                            // Refresh komponen notifikasi
                            $('#DZ_W_Notification1 ul').html(
                                '<li><p class="text-center">Tidak ada notifikasi baru</p></li>'
                            );
                            $('#jumlahNotif').text('0');

                            // Tampilkan pesan sukses dengan SweetAlert
                            Swal.fire({
                                type: 'success',
                                title: 'Berhasil',
                                text: 'Semua notifikasi berhasil dihapus!'
                            });
                        } else {
                            // Tampilkan pesan error dengan SweetAlert
                            Swal.fire({
                                type: 'error',
                                title: 'Gagal',
                                text: 'Gagal menghapus notifikasi: ' + result
                                    .message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", xhr, status, error);
                        // Tampilkan pesan error dengan SweetAlert
                        Swal.fire({
                            type: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Terjadi kesalahan saat menghapus notifikasi'
                        });
                    }
                });
            }
        });
    }
    </script>

    <?php

    $queryApproved = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM sertifikat WHERE Status='Approved'");
    $queryPending = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM sertifikat WHERE Status='Pending'");
    $queryDeclined = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM sertifikat WHERE Status='Declined'");

    // Data dalam format JSON
    $dataChart = json_encode([
        'approved' => mysqli_fetch_assoc($queryApproved)['total'],
        'pending' => mysqli_fetch_assoc($queryPending)['total'],
        'declined' => mysqli_fetch_assoc($queryDeclined)['total']
    ]);
    ?>



</body>

</html>

<?php
}
?>