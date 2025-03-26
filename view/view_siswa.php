<?php

if (isset($_GET['nis']) && isset($_GET['confirm_delete']) && $_GET['confirm_delete'] == 'true') {
    $id = mysqli_real_escape_string($koneksi, $_GET['nis']);
    $hasil_pengguna = mysqli_query($koneksi,"DELETE FROM pengguna WHERE nis = $id");
    $hasil_sertifikat = mysqli_query($koneksi, "DELETE FROM sertifikat WHERE nis = '$id'");
    $hasil_siswa = mysqli_query($koneksi,"DELETE FROM siswa WHERE nis = $id");

    if ($hasil_pengguna && $hasil_sertifikat && $hasil_siswa) {
        echo "<script>
        let intervalId = setInterval(function() {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data telah dihapus.',
                type: 'success',
                timer: 1000,
                showConfirmButton: false
            }).then(() => {
                setTimeout(() => {
                    window.location.href = 'dashboard.php?page=siswa';
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
            text: 'Data gagal dihapus.',
            type: 'error',
            timer: 1000,
            showConfirmButton: false
        }).then(() => {
            setTimeout(() => {
                window.location.href = 'dashboard.php?page=siswa';
            }, 1000);
        });
            clearInterval(intervalId);
        }, 2000);
        </script>";
    }
    
}
?>


<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Siswa</a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Siswa</h4>
                        <a href="dashboard.php?page=tambah_siswa" class="btn btn-rounded btn-info"><span
                                class="btn-icon-start text-info"><i class="fa fa-plus color-secondary"></i>
                            </span>Tambah Siswa</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>No Absen</th>
                                        <th>Nama Siswa</th>
                                        <th>No Telpon</th>
                                        <th>Email</th>
                                        <th>Jurusan</th>
                                        <th>Kelas</th>
                                        <th>Angkatan</th>
                                        <th>Total Kredit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    // Query untuk mendapatkan data siswa beserta total skor kredit dari tabel kegiatan
                                    $data_siswa = mysqli_query($koneksi, "
                                        SELECT 
                                            siswa.*, 
                                            jurusan.Jurusan,
                                            COALESCE(SUM(kegiatan.Angka_Kredit), 0) AS Total_Skor
                                        FROM siswa
                                        INNER JOIN jurusan USING(Id_Jurusan)
                                        LEFT JOIN sertifikat ON siswa.NIS = sertifikat.NIS AND sertifikat.Status = 'Approved'
                                        LEFT JOIN kegiatan ON sertifikat.Id_Kegiatan = kegiatan.Id_Kegiatan
                                        GROUP BY siswa.NIS
                                    ");
                                
                                    while ($data = mysqli_fetch_assoc($data_siswa)) {
                                    ?>
                                        <tr>
                                            <td><strong><?= $data['NIS'] ?></strong></td>
                                            <td><strong><?= $data['No_Absen'] ?></strong></td>
                                            <td><?= $data['Nama_Siswa'] ?></td>
                                            <td><?= $data['No_Telp'] ?></td>
                                            <td><?= $data['Email'] ?></td>
                                            <td><?= $data['Jurusan'] ?></td>
                                            <td><?= $data['Kelas'] ?></td>
                                            <td><?= $data['Angkatan'] ?></td>
                                            <td><div class="badge badge-primary rounded-circle p-2 d-flex justify-content-center align-items-center"
                                            style="height: 35px; width: 35px;">
                                            <?= htmlspecialchars($data['Total_Skor']) ?></td>
                                        </div>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="dashboard.php?page=update_siswa&nis=<?= $data['NIS'] ?>" 
                                                        class="btn btn-primary shadow btn-xs sharp me-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a onclick="confirmDelete(<?= $data['NIS'] ?>)" 
                                                        class="btn btn-danger shadow btn-xs sharp">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Siswa</h4>
                        <a href="dashboard.php?page=tambah_siswa" class="btn btn-rounded btn-info"><span
                                class="btn-icon-start text-info"><i class="fa fa-plus color-secondary"></i>
                            </span>Tambah Data</a>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex flex-row justify-content-around">
                            <?php
                            $no = 1;
                            $data_siswa = mysqli_query($koneksi,"SELECT 
                                            siswa.*, 
                                            jurusan.Jurusan,
                                            COALESCE(SUM(kegiatan.Angka_Kredit), 0) AS Total_Skor
                                        FROM siswa
                                        INNER JOIN jurusan USING(Id_Jurusan)
                                        LEFT JOIN sertifikat ON siswa.NIS = sertifikat.NIS AND sertifikat.Status = 'Approved'
                                        LEFT JOIN kegiatan ON sertifikat.Id_Kegiatan = kegiatan.Id_Kegiatan
                                        GROUP BY siswa.NIS");
                            while($data = mysqli_fetch_assoc($data_siswa)){
                            
                        ?>
                            <div class="siswa mb-3 px-3 col-lg-3 me-1">
                                <button class="angkatan">
                                    <span><?=$data['NIS'];?></span>
                                </button>
                                <div class="profile">
                                    <img src="../images/user2.png" alt="">
                                </div>
                                <div class="content">
                                    <div class="info">
                                        <div class="side-button">
                                            <a class="btn btn-warning rounded-pill"
                                                href="dashboard.php?page=update_siswa&nis=<?=$data['NIS']?>">Edit
                                            </a>
                                            <a class="btn btn-danger rounded-pill"
                                                onclick="confirmDelete(<?= $data['NIS'] ?>)">Hapus
                                            </a>
                                        </div>
                                        <span class="name">Absen : <?=$data['No_Absen'];?></span>
                                        <span class="name"><?=$data['Nama_Siswa']?></span>
                                        <span class="about"><?=$data['Email']?></span>
                                        <span class="about"><?=$data['No_Telp']?></span>
                                        <span class="about">Kelas : <?=$data['Kelas']?></span>
                                    </div>
                                    <div class="bottom">
                                        <div class="social-links">
                                            <a href="#">
                                                <?=$data['Jurusan'];?>
                                            </a>
                                            </a>
                                        </div>
                                        <a class="button"><?=$data['Angkatan'];?> - Total Kredit : <?=$data['Total_Skor'];?></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<script>
function confirmDelete(id) {
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
            window.location.href = 'dashboard.php?page=siswa&nis=' + id + '&confirm_delete=true';
        }
    });
}
</script>