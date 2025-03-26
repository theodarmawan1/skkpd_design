<?php
if (isset($_POST['tambah'])) {

    $nama_pegawai = $_POST['nama_pegawai'];
    $username     = $_POST['username'];
    $password     = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Query INSERT ke tabel pegawai
        $hasil_pegawai = mysqli_query($koneksi, "INSERT INTO pegawai (Nama_Lengkap, Username) VALUES ('$nama_pegawai', '$username')");

        if (!$hasil_pegawai) {
            throw new Exception(mysqli_error($koneksi)); // Tangkap error jika gagal
        }

        // Jika berhasil, lanjutkan ke tabel pengguna
        $hasil_pengguna = mysqli_query($koneksi, "INSERT INTO pengguna (Id_Pengguna, Username, NIS, Password) VALUES (NULL, '$username', NULL, '$hashed_password')");

        if (!$hasil_pengguna) {
            throw new Exception(mysqli_error($koneksi));
        }

        // Jika semua berhasil
        echo "<script>
        let intervalId = setInterval(function() {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data telah ditambahkan.',
            type: 'success',
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            window.location.href = 'dashboard.php?page=operator';
        });
        clearInterval(intervalId);
        }, 2000);
        </script>";

    } catch (Exception $e) {
        echo "<script>
        let intervalId = setInterval(function() {
        Swal.fire({
            title: 'Gagal!',
            text: '". addslashes($e->getMessage()) ."',
            type: 'error',
            timer: 2000,
            showConfirmButton: false
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Operator</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah Operator</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Operator</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" novalidate="" method="post">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom08">Nama Lengkap
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom08"
                                                    placeholder="Theo Darmawan" required="" name="nama_pegawai">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom09">Username
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom09"
                                                    placeholder="theo" name="username">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Password
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="password" class="form-control" id="validationCustom07"
                                                    name="password">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-8 ms-auto">
                                                <button type="submit" class="btn btn-primary"
                                                    name="tambah">Tambah</button>
                                                <a href="dashboard.php?page=operator"
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
<script>
document.querySelector(".needs-validation").addEventListener("submit", function(event) {
    let inputNamaJurusan = document.getElementById("validationCustom07");

    if (inputNamaJurusan.value.trim() === "") {
        event.preventDefault(); // Mencegah form dikirim
        event.stopPropagation();
        let intervalId = setInterval(function() {
            Swal.fire({
                title: "Error!",
                text: "Data tidak boleh kosong!",
                type: "error",
                timer: 2000,
                showConfirmButton: false
            });
            clearInterval(intervalId);
        }, 2000);
    }
});
</script>
<!--**********************************
    Content body end
***********************************-->