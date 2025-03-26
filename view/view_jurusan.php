<?php
if (isset($_GET['id_jurusan']) && isset($_GET['confirm_delete']) && $_GET['confirm_delete'] == 'true') {
    $id = mysqli_real_escape_string($koneksi, $_GET['id_jurusan']);
    $hasil = mysqli_query($koneksi, "DELETE FROM jurusan WHERE id_jurusan = '$id'");

    if ($hasil) {
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
                    window.location.href = 'dashboard.php?page=jurusan';
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
                window.location.href = 'dashboard.php?page=jurusan';
            }, 1000);
        });
            clearInterval(intervalId);
        }, 2000);
        </script>";
    }
    
}
?>


<!--**********************************
        Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">

        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Jurusan</a></li>
            </ol>
        </div>
        <!-- row -->


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Jurusan</h4>
                        <a href="dashboard.php?page=tambah_jurusan" class="btn btn-rounded btn-info"><span
                                class="btn-icon-start text-info"><i class="fa fa-plus color-secondary"></i>
                            </span>Tambah Data</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Jurusan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                                $no = 1;
                                                $result = mysqli_query($koneksi, "SELECT * FROM jurusan");
                                                while ($data = mysqli_fetch_assoc($result)) {
                                            ?>
                                    <tr>
                                        <td><?=$no++?></td>
                                        <td><a href="javascript:void(0);"><strong><?= $data['Jurusan']?></strong></a>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="dashboard.php?page=update_jurusan&id_jurusan=<?= $data['Id_Jurusan'] ?>"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <a onclick="confirmDelete('<?= $data['Id_Jurusan'] ?>')"
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
    </div>
</div>
<!--**********************************
        Content body end
***********************************-->

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
            window.location.href = 'dashboard.php?page=jurusan&id_jurusan=' + id + '&confirm_delete=true';
        }
    });
}
</script>