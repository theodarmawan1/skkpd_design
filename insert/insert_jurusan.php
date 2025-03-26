<?php
if (isset($_POST['tambah'])) {
    $result = mysqli_query($koneksi, "SELECT Id_Jurusan FROM jurusan ORDER BY Id_Jurusan DESC LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        // Ambil angka dari ID terakhir (misal: 'j3' → 3)
        $last_id = (int)substr($row['Id_Jurusan'], 1);
        $id_jurusan = 'J' . ($last_id + 1); // Buat ID baru ('j4', 'j5', ...)
    } else {
        $id_jurusan = 'J1'; // Jika tabel kosong, mulai dari 'j1'
    }
    $nama_jurusan = $_POST['nama_jurusan'];

    $hasil = mysqli_query($koneksi, "INSERT INTO jurusan (Id_Jurusan, Jurusan) VALUES('$id_jurusan', '$nama_jurusan')");

    if (!$hasil) {
        echo "<script>
    let intervalId = setInterval(function() {
    Swal.fire({
        title: 'Gagal!',
        text: 'Data gagal ditambahkan.',
        type: 'error',
        timer: 2000,
        showConfirmButton: false,
        backdrop: false
    }).then(() => {
        setTimeout(() => {
            window.location.href = 'dashboard.php?page=tambah_jurusan';
        }, 1000);
    });
        clearInterval(intervalId);
    }, 2000);
    </script>";
    } else {
        echo "<script>
    let intervalId = setInterval(function() {
    Swal.fire({
        title: 'Berhasil!',
        text: 'Data telah ditambahkan.',
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Kegiatan</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah Kegiatan</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Kegiatan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" novalidate="" method="post">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Nama
                                                Jurusan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom07"
                                                    placeholder="RPL" required name="nama_jurusan">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-8 ms-auto">
                                                <button type="submit" class="btn btn-primary"
                                                    name="tambah">Tambah</button>
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
<script>
document.querySelector(".needs-validation").addEventListener("submit", function(event) {
    let inputNamaJurusan = document.getElementById("validationCustom07");

    if (inputNamaJurusan.value.trim() === "") {
        event.preventDefault(); // Mencegah form dikirim
        event.stopPropagation();
        let intervalId = setInterval(function() {
            Swal.fire({
                title: "Error!",
                text: "Nama jurusan tidak boleh kosong!",
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