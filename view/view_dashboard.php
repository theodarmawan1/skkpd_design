<div class="content-body">
    <div class="container-fluid">
        <?php
        if (!isset($_COOKIE['nis'])) {

        ?>
        <div class="row page-titles mb-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard
                    </a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            </ol>
        </div>
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="dashboard_box d-flex flex-wrap justify-content-between px-0">
                        <div class="admin dashboard_card col-lg-3 col-md-6">
                            <?php
                    $querySiswa = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM siswa");
                    $jumlahSiswa = mysqli_fetch_assoc($querySiswa)['total'];
                    ?>
                            <div>
                                <div class="card_number"><?=$jumlahSiswa?></div>
                                <div class="card_name">Total Siswa</div>
                            </div>

                            <div class="icon_card">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                        </div>

                        <div class="dashboard_card col-lg-3 col-md-6">
                            <?php
                    $queryJurusan = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM jurusan");
                    $jumlahJurusan = mysqli_fetch_assoc($queryJurusan)['total'];
                    ?>
                            <div>
                                <div class="card_number"><?=$jumlahJurusan?></div>
                                <div class="card_name">Total Jurusan</div>
                            </div>

                            <div class="icon_card">
                                <i class="fas fa-laptop"></i>
                            </div>
                        </div>

                        <div class="dashboard_card col-lg-3 col-md-6">
                            <?php
                    $queryKegiatan = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM kegiatan");
                    $jumlahKegiatan = mysqli_fetch_assoc($queryKegiatan)['total'];
                    ?>
                            <div>
                                <div class="card_number"><?=$jumlahKegiatan?></div>
                                <div class="card_name">Total Kegiatan</div>
                            </div>

                            <div class="icon_card">
                                <i class="fas fa-trophy"></i>
                            </div>
                        </div>

                        <div class="dashboard_card col-lg-3 col-md-6">
                            <?php
                    // Query jumlah kategori unik dalam kegiatan
                    $querySubKategori = mysqli_query($koneksi, "SELECT COUNT(DISTINCT Sub_Kategori) as total FROM kegiatan JOIN kategori USING(Id_Kategori)");
                    $jumlahSubKategori = mysqli_fetch_assoc($querySubKategori)['total'];
                    ?>
                            <div>
                                <div class="card_number"><?=$jumlahSubKategori?></div>
                                <div class="card_name">Total Kategori</div>
                            </div>

                            <div class="icon_card">
                                <i class="fa fa-puzzle-piece"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header border-0 flex-wrap">
                                <h4 class="fs-20 font-w700 mb-2">Siswa</h4>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade active show">
                                        <div id="chartBarSiswa" class="chartBarSiswa"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header border-0 flex-wrap">
                                <h4 class="fs-20 font-w700 mb-2">Jurusan</h4>
                                <div class="d-flex align-items-center project-tab mb-2">
                                    <div class="card-tabs mt-3 mt-sm-0 mb-3 ">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#approved"
                                                    role="tab">Approved</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#pending"
                                                    role="tab">Pending</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#canceled"
                                                    role="tab">Canceled</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="approved">
                                        <div id="chartBar" class="chartBar"></div>
                                    </div>
                                    <div class="tab-pane fade" id="pending">
                                        <div id="chartBar1" class="chartBar"></div>
                                    </div>
                                    <div class="tab-pane fade" id="canceled">
                                        <div id="chartBar2" class="chartBar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="col-xl-12 col-lg-12">
                        <div class="row">
                            <div class="col-xl-6 col-xxl-12">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <div>
                                            <h4 class="fs-20 font-w700">Status</h4>
                                            <span class="fs-14 font-w400 d-block">Total Sertifikat per Status</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="emailchart"> </div>
                                        <div class="mb-3 mt-4">
                                            <h4 class="fs-18 font-w600">Legend</h4>
                                        </div>
                                        <div>
                                            <?php
                                                $query = "SELECT j.Jurusan, 
                                                                COUNT(s.Id_Sertifikat) AS Total_Sertifikat, 
                                                                ROUND((COUNT(s.Id_Sertifikat) / (SELECT COUNT(*) FROM sertifikat)) * 100,0) AS Persen
                                                        FROM sertifikat s
                                                        JOIN siswa si ON s.NIS = si.NIS
                                                        JOIN jurusan j ON si.Id_Jurusan = j.Id_Jurusan
                                                        GROUP BY j.Jurusan";
                                                $result = mysqli_query($koneksi, $query);
                                                $data_jurusan = [];

                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $jurusan = $row['Jurusan']; // Nama jurusan
                                                    $data_jurusan[$jurusan] = [
                                                        'total' => $row['Total_Sertifikat'],
                                                        'persen' => $row['Persen']
                                                    ];
                                                }
                                                $total_rpl = $data_jurusan['RPL']['total'] ?? 0;
                                                $persen_rpl = $data_jurusan['RPL']['persen'] ?? 0;

                                                $total_tkj = $data_jurusan['TKJ']['total'] ?? 0;
                                                $persen_tkj = $data_jurusan['TKJ']['persen'] ?? 0;

                                                $total_an = $data_jurusan['AN']['total'] ?? 0;
                                                $persen_an = $data_jurusan['AN']['persen'] ?? 0;

                                                $total_dkv = $data_jurusan['DKV']['total'] ?? 0;
                                                $persen_dkv = $data_jurusan['DKV']['persen'] ?? 0;

                                            ?>
                                            <div class="d-flex align-items-center justify-content-between mb-4">
                                                <span class="fs-18 font-w500">
                                                    <svg class="me-3" width="20" height="20" viewbox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="20" height="20" rx="6" fill="#886CC0">
                                                        </rect>
                                                    </svg>
                                                    RPL (<?=$persen_rpl?>%)
                                                </span>
                                                <span class="fs-18 font-w600"><?=$total_rpl?></span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between  mb-4">
                                                <span class="fs-18 font-w500">
                                                    <svg class="me-3" width="20" height="20" viewbox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="20" height="20" rx="6" fill="#26E023">
                                                        </rect>
                                                    </svg>
                                                    TKJ (<?=$persen_tkj?>%)
                                                </span>
                                                <span class="fs-18 font-w600"><?=$total_tkj?></span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between  mb-4">
                                                <span class="fs-18 font-w500">
                                                    <svg class="me-3" width="20" height="20" viewbox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="20" height="20" rx="6" fill="#61CFF1">
                                                        </rect>
                                                    </svg>
                                                    AN (<?=$persen_an?>%)
                                                </span>
                                                <span class="fs-18 font-w600"><?=$total_an?></span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between  mb-4">
                                                <span class="fs-18 font-w500">
                                                    <svg class="me-3" width="20" height="20" viewbox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="20" height="20" rx="6" fill="#FFDA7C">
                                                        </rect>
                                                    </svg>
                                                    DKV (<?=$persen_dkv?>%)
                                                </span>
                                                <span class="fs-18 font-w600"><?=$total_dkv?></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>