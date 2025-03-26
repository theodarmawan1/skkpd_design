<?php
$id = $_GET['id_pengguna'] ?? null; // Ambil ID dari GET

if(!isset($_COOKIE["nis"])){
    $data_pengguna = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT Id_Pengguna, Username, Password, Nama_Lengkap FROM pengguna JOIN pegawai USING(username) WHERE Id_Pengguna='$id'"));
}else{
    $data_pengguna = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pengguna JOIN siswa USING(NIS) JOIN jurusan USING(Id_Jurusan) WHERE Id_Pengguna='$id'"));
}

$jurusan_query = mysqli_query($koneksi, "SELECT Id_Jurusan, Jurusan FROM jurusan ORDER BY Jurusan ASC");
?>
?>
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Pengguna</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Update Pengguna</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Pengguna (<span class="fs-5 text-muted">Masukkan password
                                terlebih
                                dahulu</span> )</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" novalidate="" method="post">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <input type="hidden" name="id_pengguna"
                                            value="<?= $data_pengguna['Id_Pengguna'] ?>">
                                        <?php
                                        if(!isset($_COOKIE["nis"])){
                                        ?>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom0 1">Username
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" readonly id="validationCustom01"
                                                    placeholder="" required value="<?= $data_pengguna['Username'] ?>"
                                                    name="username">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom02">Nama Lengkap
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" readonly id="validationCustom02"
                                                    placeholder="" required
                                                    value="<?= $data_pengguna['Nama_Lengkap'] ?>" name="username">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">
                                                <span class="text-danger"></span>
                                            </label>
                                            <div class="row d-flex col-lg-6 pe-0">
                                                <div class="col-lg-3 mb-3 w-auto">
                                                    <button type="submit" class="btn btn-primary editdata"
                                                        data-id="<?= $data_pengguna['Id_Pengguna'] ?>">Edit Akun
                                                    </button>
                                                    <a href="dashboard.php?page=operator"
                                                        class="btn light btn-warning ms-3">Cancel</a>
                                                </div>
                                                <div class="col-lg-3 mb-3 w-auto ms-auto pe-0">
                                                    <!-- Tambahkan atribut data-id pada tombol -->
                                                    <button type="submit" class="btn light btn-danger hapusdata"
                                                        data-id="<?= $data_pengguna['Id_Pengguna'] ?>">
                                                        Hapus Akun
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }else{
                                        ?>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom04">NIS
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" readonly id="validationCustom04"
                                                    placeholder="" required value="<?= $data_pengguna['NIS'] ?>"
                                                    name="nis">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom05">Jurusan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" name="jurusan"
                                                    id="jurusan">
                                                    <option data-display="Pilihan Jurusan">Pilih Jurusan</option>
                                                    <?php 
                                                    // Loop through all jurusan from the database
                                                    while($row = mysqli_fetch_assoc($jurusan_query)) {
                                                        $selected = ($data_pengguna['Id_Jurusan'] == $row['Id_Jurusan']) ? 'selected' : '';
                                                        echo "<option value='{$row['Id_Jurusan']}' {$selected}>{$row['Jurusan']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a jurusan.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">No Absen
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom07"
                                                    placeholder="1" required="" name="no_absen"
                                                    value="<?= $data_pengguna['No_Absen'] ?>">
                                                <div class="invalid-feedback">
                                                    Please enter a catatan.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Nama Siswa
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom07"
                                                    placeholder="theo" required="" name="nama_siswa"
                                                    value="<?= $data_pengguna['Nama_Siswa'] ?>">
                                                <div class="invalid-feedback">
                                                    Please enter a catatan.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">No Telp
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom07"
                                                    placeholder="8123456789" required="" name="no_telp"
                                                    value="<?= $data_pengguna['No_Telp'] ?>">
                                                <div class="invalid-feedback">
                                                    Please enter a catatan.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Email
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="email" class="form-control" id="validationCustom07"
                                                    placeholder="theo@gmail.com" required="" name="email"
                                                    value="<?= $data_pengguna['Email'] ?>">
                                                <div class="invalid-feedback">
                                                    Please enter a catatan.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Kelas
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom07"
                                                    placeholder="1" required="" name="kelas"
                                                    value="<?= $data_pengguna['Kelas'] ?>">
                                                <div class="invalid-feedback">
                                                    Please enter a catatan.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Angkatan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom07"
                                                    placeholder="2024" required="" name="angkatan"
                                                    value="<?= $data_pengguna['Angkatan'] ?>">
                                                <div class="invalid-feedback">
                                                    Please enter a catatan.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Ganti
                                                Password
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="password" class="form-control" id="password_baru"
                                                    placeholder="" required="" name="password_baru">
                                                <div class="invalid-feedback">
                                                    Please enter a catatan.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">
                                                <span class="text-danger"></span>
                                            </label>
                                            <div class="row d-flex col-lg-6 pe-0 justify-content-between">
                                                <div class="col-lg-3 w-auto mb-3">
                                                    <button type="submit" class="btn btn-primary editdatasiswa"
                                                        data-id="<?= $data_pengguna['Id_Pengguna'] ?>">Edit Akun
                                                    </button>
                                                    <a href="dashboard.php?page=operator"
                                                        class="btn light btn-warning ms-3">Cancel</a>
                                                </div>
                                                <div class="col-lg-3 mb-3 w-auto pe-0">
                                                    <!-- Tambahkan atribut data-id pada tombol -->
                                                    <button type="submit" class="btn light btn-danger hapusdata"
                                                        data-id="<?= $data_pengguna['Id_Pengguna'] ?>">
                                                        Hapus Akun
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>

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
<script>
function confirmDelete_2(id) {
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
            window.location.href = 'dashboard.php?page=update_sertifikat&id_sertifikat=' + id +
                '&confirm_delete=true';
        }
    });
}

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