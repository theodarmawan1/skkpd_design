<?php
    $nis = $_GET['nis'];
    $data_siswa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT NIS, No_Absen, Nama_Siswa, No_Telp, Email, Id_Jurusan, Kelas, Angkatan, Jurusan, Password FROM siswa JOIN jurusan USING(Id_Jurusan) JOIN pengguna USING(NIS) WHERE NIS = '$nis'"));
    
    if(isset($_POST['update'])){
        $jurusan = $_POST['jurusan'];
        $id = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT Id_Jurusan from jurusan WHERE Jurusan = '$jurusan'"));
    
        $id_jurusan    = $id['Id_Jurusan'];
        $nis           = $_POST['nis'];
        $no_absen      = $_POST['no_absen'];
        $nama_siswa    = $_POST['nama_siswa'];
        $no_telp       = $_POST['no_telp'];
        $email         = $_POST['email'];
        $kelas         = $_POST['kelas'];
        $angkatan      = $_POST['angkatan'];

        $password_baru  = $_POST['password_baru'];
        $hashed_password_baru = $data_siswa['Password'];

        if (!empty($password_baru)) {
            $hashed_password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
            $hasil = mysqli_query($koneksi, "UPDATE siswa SET Id_Jurusan = '$id_jurusan', NIS = '$nis', No_Absen = '$no_absen', Nama_Siswa = '$nama_siswa', No_Telp = '$no_telp', Email = '$email', Kelas = '$kelas', Angkatan = '$angkatan' WHERE NIS = '$nis'");
            $update_pengguna = mysqli_query($koneksi, "UPDATE pengguna SET Password='$hashed_password_baru' WHERE NIS='$nis'");
            if($hasil && $update_pengguna){
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
                        text: 'Data gagal diupdate.',
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false,
                        backdrop: false
                    }).then(() => {
                        setTimeout(() => {
                            window.location.href =
                                'dashboard.php?page=update_siswa&nis=".$nis."';
                        }, 1000);
                    });
                    clearInterval(intervalId);
                }, 2000);
                </script>";
            }
        }else{
            $hasil = mysqli_query($koneksi, "UPDATE siswa SET Id_Jurusan = '$id_jurusan', NIS = '$nis', No_Absen = '$no_absen', Nama_Siswa = '$nama_siswa', No_Telp = '$no_telp', Email = '$email', Kelas = '$kelas', Angkatan = '$angkatan' WHERE NIS = '$nis'");
            if($hasil){
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
                        text: 'Data gagal diupdate.',
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false,
                        backdrop: false
                    }).then(() => {
                        setTimeout(() => {
                            window.location.href =
                                'dashboard.php?page=update_siswa&nis=".$nis."';
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">siswa</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Update siswa</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update siswa</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" novalidate="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <input type="hidden" name="nis" value="<?= $data_siswa['NIS'] ?>">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom05">Jurusan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" name="jurusan"
                                                    id="validationCustom05">
                                                    <option data-display="Pilihan Jurusan">Pilih Jurusan</option>
                                                    <option value="RPL"
                                                        <?php echo ($data_siswa['Jurusan'] == 'RPL') ? 'selected' : ''; ?>>
                                                        RPL</option>
                                                    <option value="TKJ"
                                                        <?php echo ($data_siswa['Jurusan'] == 'TKJ') ? 'selected' : ''; ?>>
                                                        TKJ
                                                    </option>
                                                    <option value="AN"
                                                        <?php echo ($data_siswa['Jurusan'] == 'AN') ? 'selected' : ''; ?>>
                                                        AN
                                                    </option>
                                                    <option value="DKV"
                                                        <?php echo ($data_siswa['Jurusan'] == 'DKV') ? 'selected' : ''; ?>>
                                                        DKV
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a one.
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
                                                    value="<?= $data_siswa['No_Absen'] ?>">
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
                                                    value="<?= $data_siswa['Nama_Siswa'] ?>">
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
                                                    value="<?= $data_siswa['No_Telp'] ?>">
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
                                                    value="<?= $data_siswa['Email'] ?>">
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
                                                    value="<?= $data_siswa['Kelas'] ?>">
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
                                                    value="<?= $data_siswa['Angkatan'] ?>">
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
                                                <input type="password" class="form-control" id="validationCustom07"
                                                    placeholder="" required="" name="password_baru">
                                                <div class="invalid-feedback">
                                                    Please enter a catatan.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-8 ms-auto">
                                                <button type="submit" class="btn btn-primary"
                                                    name="update">Update</button>
                                                <a href="dashboard.php?page=sertifikat"
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