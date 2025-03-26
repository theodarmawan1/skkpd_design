<?php
$id_jurusan = $_GET['id_jurusan'];
$data_jurusan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM jurusan WHERE Id_Jurusan = '$id_jurusan'"));

if (isset($_POST['update'])) {
    $id_jurusan = $_POST['id_jurusan'];
    $nama_jurusan = $_POST['nama_jurusan'];

    $update = mysqli_query($koneksi, "UPDATE jurusan SET Jurusan='$nama_jurusan' WHERE Id_Jurusan='$id_jurusan'");

    if ($update) {
        echo "<script>
        let intervalId = setInterval(function() {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data telah diupdate.',
            type: 'success',
            timer: 2000,
            showConfirmButton: false,
            backdrop: false
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
            text: 'Data gagal diupdate.',
            type: 'error',
            timer: 2000,
            showConfirmButton: false,
            backdrop: false
        }).then(() => {
            setTimeout(() => {
                window.location.href = 'dashboard.php?page=update_jurusan&id_jurusan=$id_jurusan';
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Jurusan</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Update Jurusan</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Jurusan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" novalidate="" method="post">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <input type="hidden" name="id_jurusan"
                                            value="<?= $data_jurusan['Id_Jurusan'] ?>">

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Nama
                                                Jurusan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom07"
                                                    placeholder="Project Gaya Hidup Berkelajutan" required=""
                                                    value="<?= $data_jurusan['Jurusan'] ?>" name="nama_jurusan">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-8 ms-auto">
                                                <button type="submit" class="btn btn-primary"
                                                    name="update">Update</button>
                                                <a href="dashboard.php?page=jurusan"
                                                    class="btn light btn-warning ms-3">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
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