<?php
if(isset($_POST['tambah'])){
    
    $jurusan = $_POST['jurusan'];
    $id = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT Id_Jurusan from jurusan WHERE jurusan = '$jurusan'"));
    
    if($id == NULL){
        echo "<script>
        let intervalId = setInterval(function() {
        Swal.fire({
            title: 'Gagal!',
            text: 'Nama jurusan tidak terdaftar.',
            type: 'error',
            timer: 2000,
            showConfirmButton: false,
            backdrop: false
        }).then(() => {
        });
            clearInterval(intervalId);
        }, 1600);
        </script>";
    }else {
        $id_jurusan    = $id['Id_Jurusan'];
        $nis           = $_POST['nis'];
        $no_absen      = $_POST['no_absen'];
        $nama_siswa    = $_POST['nama_siswa'];
        $no_telp       = $_POST['no_telp'];
        $email         = $_POST['email'];
        $kelas         = $_POST['kelas'];
        $angkatan      = $_POST['angkatan'];
        $password     = "siswa".$_POST['nis'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        $hasil_siswa = mysqli_query($koneksi, "INSERT INTO siswa VALUES('$nis', '$no_absen', '$nama_siswa', '$no_telp', '$email', '$id_jurusan', '$kelas',  '$angkatan')");
        $hasil_pengguna = mysqli_query($koneksi, "INSERT INTO pengguna (Id_Pengguna, Username, NIS, Password) VALUES(NULL, NULL, '$nis', '$hashed_password')");
    
        if (!$hasil_siswa && !$hasil_pengguna) {
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
                window.location.href = 'dashboard.php?page=tambah_siswa';
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
                window.location.href = 'dashboard.php?page=siswa';
            }, 1000);
        });
            clearInterval(intervalId);
        }, 2000);
        </script>";
        }
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Siswa</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah Siswa</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Siswa</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" novalidate="" method="post">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">NIS
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom07"
                                                    placeholder="2121" required="" name="nis">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">No Absen
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="number" class="form-control" id="validationCustom07"
                                                    placeholder="1" required="" name="no_absen">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Nama Siswa
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom07"
                                                    placeholder="Theo" required="" name="nama_siswa">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">No Telp
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom07"
                                                    placeholder="8123456789" required="" name="no_telp">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Email
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="email" class="form-control" id="validationCustom07"
                                                    placeholder="theo@gmail.com" required="" name="email">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Jurusan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" name="jurusan"
                                                    id="validationCustom07">
                                                    <option data-display="Pilihan Jurusan">Pilih Jurusan</option>
                                                    <option value="RPL">RPL</option>
                                                    <option value="TKJ">TKJ</option>
                                                    <option value="AN">AN</option>
                                                    <option value="DKV">DKV</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a one.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Kelas
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom07"
                                                    placeholder="1" required="" name="kelas">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Angkatan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom07"
                                                    placeholder="2024" required="" name="angkatan">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-8 ms-auto">
                                                <button type="submit" class="btn btn-primary"
                                                    name="tambah">Tambah</button>
                                                <a href="dashboard.php?page=siswa"
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