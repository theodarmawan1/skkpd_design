<?php
if (isset($_GET['username']) && isset($_GET['confirm_delete']) && $_GET['confirm_delete'] == 'true') {
    $username = mysqli_real_escape_string($koneksi, $_GET['username']);
    
    $data_pengguna = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT Id_Pengguna FROM pengguna WHERE Username = '$username'"));
    
    if ($data_pengguna) {
        $id_pengguna = $data_pengguna['Id_Pengguna'];
        $hapus_pengguna = mysqli_query($koneksi, "DELETE FROM pengguna WHERE Id_Pengguna = '$id_pengguna'");
        $hapus_pegawai = mysqli_query($koneksi, "DELETE FROM pegawai WHERE Username = '$username'");

        if ($hapus_pengguna && $hapus_pegawai) {
            echo "<script>
            let intervalId = setInterval(function() {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data telah dihapus.',
                type: 'success',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'dashboard.php?page=operator';
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
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'dashboard.php?page=operator';
            });
            clearInterval(intervalId);
        }, 2000);
            </script>";
        }
    }
}
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Operator</a></li>
            </ol>
        </div>

        <div class="row">
            <?php
            $no = 1;
            $result = mysqli_query($koneksi, "SELECT Id_Pengguna, Username, Password, Nama_Lengkap FROM pengguna JOIN pegawai USING(username) WHERE NIS IS NULL");
            $current_user = $_COOKIE['username'] ?? null;
            while ($data = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-xl-3 col-xxl-4 col-lg-4 col-md-6 col-sm-6 items">
                <div class="card contact-bx item-content">
                    <div class="card-header border-0">
                        <div class="action-dropdown">
                            <div class="dropdown ">
                                <div class="btn-link" data-bs-toggle="dropdown">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5">
                                        </circle>
                                        <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5">
                                        </circle>
                                        <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5">
                                        </circle>
                                    </svg>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body user-profile">
                        <div class="image-bx">
                            <img src="../images/profile.png" data-src="../images/contacts/Untitled-3.jpg" alt=""
                                class="rounded-circle">
                            <span class="active"></span>
                        </div>
                        <div class="media-body user-meta-info">
                            <h6 class="fs-18 font-w600 my-1"><a href="javascript:void(0)"
                                    class="text-black user-name"><?= $data['Nama_Lengkap'] ?></a></h6>
                            <p class="fs-14 mb-3 user-work"><?= $data['Username'] ?>
                            </p>
                            <a href="dashboard.php?page=update_user&id_pengguna=<?= $data['Id_Pengguna'] ?>"
                                class="btn btn-primary shadow btn-lg rounded-circle sharp2">
                                <i class="fas fa-pencil-alt" style="font-size: 1.8rem; padding-top: 4px;"></i>
                            </a>
                            <?php if ($current_user !== $data['Username']) { ?>
                            <a onclick="confirmDelete('<?= $data['Username'] ?>')"
                                class="btn btn-danger shadow btn-lg rounded-circ sharp2">
                                <i class="fa fa-trash" style="font-size: 1.8rem; padding-top: 4px;"></i>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Operator</h4>
                        <a href="dashboard.php?page=tambah_operator" class="btn btn-rounded btn-info"><span
                                class="btn-icon-start text-info"><i class="fa fa-plus color-secondary"></i>
                            </span>Tambah Data</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Pengguna</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $result = mysqli_query($koneksi, "SELECT Id_Pengguna, Username, Password, Nama_Lengkap FROM pengguna JOIN pegawai USING(username) WHERE NIS IS NULL");
                                    $current_user = $_COOKIE['username'] ?? null;
                                    while ($data = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['Id_Pengguna'] ?></td>
                                        <td><?= $data['Nama_Lengkap'] ?></td>
                                        <td><?= $data['Username'] ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="dashboard.php?page=update_user&id_pengguna=<?= $data['Id_Pengguna'] ?>"
                                                    class="btn btn-primary shadow btn-xs sharp me-1">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <?php if ($current_user !== $data['Username']) { ?>
                                                <a onclick="confirmDelete('<?= $data['Username'] ?>')"
                                                    class="btn btn-danger shadow btn-xs sharp">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <?php } ?>
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
            window.location.href = 'dashboard.php?page=operator&username=' + id + '&confirm_delete=true';
        }
    });
}
</script>