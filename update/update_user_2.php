<?php
$id = $_GET['id_pengguna'];
if(!isset($_COOKIE["nis"])){
    $data_pengguna = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT Id_Pengguna, Username, Password, Nama_Lengkap FROM pengguna JOIN pegawai USING(username) WHERE Id_Pengguna='$id'"));
}else{
    $data_pengguna = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pengguna JOIN siswa USING(NIS) WHERE Id_Pengguna='$id'"));
}
if (isset($_POST['update'])) {
    $id_pengguna    = $_POST['id_pengguna'];
    $nis            = $data_pengguna['NIS'];
    $nama_lengkap   = $_POST['nama_lengkap'];
    $username_baru  = $_POST['username'];
    $password_lama  = $_POST['password_lama'];
    $password_baru  = $_POST['password_baru'];

    $hashed_password_baru = $data_pengguna['Password'];
    $username_lama   = $data_pengguna['Username'];
    
    if (!empty($password_lama) && empty($password_baru)) {
        echo "<script> let intervalId = setInterval(function() {
        Swal.fire({
            title: 'Error!',
            text: 'Password baru harus diisi jika memasukkan password lama.',
            type: 'warning',
            timer: 4000,
            showConfirmButton: true
        });
        clearInterval(intervalId);
        }, 2000);
        </script>";
    }
    
    if (!empty($password_baru)) {
        if (password_verify($password_lama, $data_pengguna['Password'])) {
            $hashed_password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
        } else {
            echo "<script>
            let intervalId = setInterval(function() {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Password salah',
                    type: 'error',
                    timer: 2000,
                    showConfirmButton: false,
                    backdrop: false
                })
                clearInterval(intervalId);
            }, 2000);
            </script>";
        }
    }

    if (empty($nis)) {
        $cek_username = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE Username='$username_baru' AND Id_Pengguna != '$id_pengguna'");
        if (mysqli_num_rows($cek_username) > 0 || $username_lama == NULL) {
            echo "<script>
                let intervalId = setInterval(function() {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Username sudah digunakan & Tidak boleh kosong',
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: false,
                        backdrop: false
                    });
                    clearInterval(intervalId);
                }, 2000);
                </script>";
        }
        else{
            if($username_baru == $username_lama){
                $update_pegawai = mysqli_query($koneksi, "UPDATE pegawai SET Nama_Lengkap='$nama_lengkap', Username='$username_baru' WHERE Username='$username_lama'");
                $update_pengguna = mysqli_query($koneksi, "UPDATE pengguna SET Username='$username_baru', Password='$hashed_password_baru' WHERE Id_Pengguna='$id_pengguna'");
            }else{
                $update_pengguna_1 = mysqli_query($koneksi, "UPDATE pengguna SET Username=NULL WHERE Id_Pengguna='$id_pengguna'");
                $update_pegawai = mysqli_query($koneksi, "UPDATE pegawai SET Nama_Lengkap='$nama_lengkap', Username='$username_baru' WHERE Username='$username_lama'");
                $update_pengguna = mysqli_query($koneksi, "UPDATE pengguna SET Username='$username_baru', Password='$hashed_password_baru' WHERE Id_Pengguna='$id_pengguna'");
            }
        }
        if($update_pengguna){
            $redirectURL = "dashboard.php?page=operator";

            if ($username_baru !== $username_lama || !empty($password_baru)) {
                $redirectURL = "../logout.php";
            }

            echo "<script>
            let intervalId = setInterval(function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data telah diupdate & anda akan log out.',
                    type: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    backdrop: false
                }).then(() => {
                    setTimeout(() => {
                        window.location.href = '$redirectURL';
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
                        window.location.href = 'dashboard.php?page=update_user_2&id_pengguna=$id_pengguna';
                    }, 1000);
                });
                clearInterval(intervalId);
            }, 2000);
            </script>";
        }
    } else {
        $nama = $_COOKIE['nama'];
        $update_pengguna = mysqli_query($koneksi, "UPDATE pengguna SET Password='$hashed_password_baru' WHERE Id_Pengguna='$id_pengguna'");
        $update_siswa = mysqli_query($koneksi, "UPDATE siswa SET Nama_Siswa='$nama_lengkap' WHERE NIS='$nis'");
        if($update_pengguna && $update_siswa){
            $redirectURL = "dashboard.php?page=sertifikat";

            if (!empty($password_baru || $nama !== $nama_lengkap)) {
                $redirectURL = "../logout.php";
            }

            echo "<script>
            let intervalId = setInterval(function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data telah diupdate & anda akan log out.',
                    type: 'success',
                    timer: 2000,
                    showConfirmButton: false,
                    backdrop: false
                }).then(() => {
                    setTimeout(() => {
                        window.location.href = '$redirectURL';
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
                        window.location.href = 'dashboard.php?page=update_user_2&id_pengguna=$id_pengguna';
                    }, 1000);
                });
                clearInterval(intervalId);
            }, 2000);
            </script>";
        }
    }

    // Cek apakah username baru sudah digunakan oleh pengguna lain
    // $cek_username = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE Username='$username_baru'");
    // if (mysqli_num_rows($cek_username) > 0 && $username_baru !== $username_lama && $username_lama !== NULL) {
    //     echo "<script>
    //         let intervalId = setInterval(function() {
    //             Swal.fire({
    //                 title: 'Gagal!',
    //                 text: 'Username sudah digunakan',
    //                 type: 'error',
    //                 timer: 2000,
    //                 showConfirmButton: false,
    //                 backdrop: false
    //             });
    //             clearInterval(intervalId);
    //         }, 2000);
    //         </script>";
    // }elseif(mysqli_num_rows($cek_username) == 0 || $username_baru == $username_lama){
    //     if (empty($nis)) {
    //         if($username_baru == $username_lama){
    //             $update_pegawai = mysqli_query($koneksi, "UPDATE pegawai SET Nama_Lengkap='$nama_lengkap', Username='$username_baru' WHERE Username='$username_lama'");
    //             $update_pengguna = mysqli_query($koneksi, "UPDATE pengguna SET Username='$username_baru', Password='$hashed_password_baru' WHERE Id_Pengguna='$id_pengguna'");
    //         }else{
    //             $update_pengguna_1 = mysqli_query($koneksi, "UPDATE pengguna SET Username=NULL WHERE Id_Pengguna='$id_pengguna'");
    //             $update_pegawai = mysqli_query($koneksi, "UPDATE pegawai SET Nama_Lengkap='$nama_lengkap', Username='$username_baru' WHERE Username='$username_lama'");
    //             $update_pengguna = mysqli_query($koneksi, "UPDATE pengguna SET Username='$username_baru', Password='$hashed_password_baru' WHERE Id_Pengguna='$id_pengguna'");
    //         }
    //     } else {
    //         $update_pengguna = mysqli_query($koneksi, "UPDATE pengguna SET Username='$username_baru', Password='$hashed_password_baru' WHERE Id_Pengguna='$id_pengguna'");
    //     }
    
    //     if($username_baru !== $username_lama){
    //         echo "<script>
    //         let intervalId = setInterval(function() {
    //             Swal.fire({
    //                 title: 'Berhasil!',
    //                 text: 'Data telah diupdate & anda akan log out.',
    //                 type: 'success',
    //                 timer: 2000,
    //                 showConfirmButton: false,
    //                 backdrop: false
    //             }).then(() => {
    //                 setTimeout(() => {
    //                     window.location.href = '../logout.php';
    //                 }, 1000);
    //             });
    //             clearInterval(intervalId);
    //         }, 2000);
    //         </script>";
    //     }elseif(!empty($password_baru)){
    //         echo "<script>
    //         let intervalId = setInterval(function() {
    //             Swal.fire({
    //                 title: 'Berhasil!',
    //                 text: 'Data telah diupdate & anda akan log out.',
    //                 type: 'success',
    //                 timer: 2000,
    //                 showConfirmButton: false,
    //                 backdrop: false
    //             }).then(() => {
    //                 setTimeout(() => {
    //                     window.location.href = '../logout.php';
    //                 }, 1000);
    //             });
    //             clearInterval(intervalId);
    //         }, 2000);
    //         </script>";
    //     }elseif ($update_pengguna) {
    //         echo "<script>
    //         let intervalId = setInterval(function() {
    //             Swal.fire({
    //                 title: 'Berhasil!',
    //                 text: 'Data telah diupdate.',
    //                 type: 'success',
    //                 timer: 2000,
    //                 showConfirmButton: false,
    //                 backdrop: false
    //             }).then(() => {
    //                 setTimeout(() => {
    //                     window.location.href = 'dashboard.php?page=operator';
    //                 }, 1000);
    //             });
    //             clearInterval(intervalId);
    //         }, 2000);
    //         </script>";
    //     } else {
    //         echo "<script>
    //         let intervalId = setInterval(function() {
    //             Swal.fire({
    //                 title: 'Gagal!',
    //                 text: 'Data gagal diupdate.',
    //                 type: 'error',
    //                 timer: 2000,
    //                 showConfirmButton: false,
    //                 backdrop: false
    //             }).then(() => {
    //                 setTimeout(() => {
    //                     window.location.href = 'dashboard.php?page=update_user_2&id_pengguna=$id_pengguna';
    //                 }, 1000);
    //             });
    //             clearInterval(intervalId);
    //         }, 2000);
    //         </script>";
    //     }
    // }

}

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
                                                <span class="text-danger"></span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom01"
                                                    placeholder="" required value="<?= $data_pengguna['Username'] ?>"
                                                    name="username">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom02">Nama Lengkap
                                                <span class="text-danger"></span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom02"
                                                    placeholder="" required
                                                    value="<?= $data_pengguna['Nama_Lengkap'] ?>" name="nama_lengkap">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom04">Password
                                                Lama
                                                <span class="text-danger"></span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="password" class="form-control" id="validationCustom04"
                                                    placeholder="" required name="password_lama">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom04">Password
                                                Baru
                                                <span class="text-danger"></span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="password" class="form-control" id="validationCustom04"
                                                    placeholder="" required name="password_baru">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
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
                                                <input type="text" class="form-control" id="validationCustom04"
                                                    placeholder="" required value="<?= $data_pengguna['NIS'] ?>"
                                                    name="nis">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom02">Nama Lengkap
                                                <span class="text-danger"></span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom02"
                                                    placeholder="" required value="<?= $data_pengguna['Nama_Siswa'] ?>"
                                                    name="nama_lengkap">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom04">Password
                                                Lama
                                                <span class="text-danger"></span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="password" class="form-control" id="validationCustom04"
                                                    placeholder="" required name="password_lama">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom04">Password
                                                Baru
                                                <span class="text-danger"></span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="password" class="form-control" id="validationCustom04"
                                                    placeholder="" required name="password_baru">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        }
                                        ?>

                                        <div class="mb-3 row">
                                            <div class="col-lg-8 ms-auto">
                                                <button type="submit" class="btn btn-primary"
                                                    name="update">Update</button>
                                                <a href="dashboard.php?page=update_user&id_pengguna=<?= $data_pengguna['Id_Pengguna'] ?>"
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