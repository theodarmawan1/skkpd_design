<?php
include "koneksi.php";  // Pastikan tidak ada output di koneksi.php
ob_start();
// Cek jika tombol login ditekan
if (isset($_POST['tombol_login'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];

    $cek_login = mysqli_query($koneksi, "SELECT Id_Pengguna, Username, NIS, Password FROM pengguna WHERE Username='$id' OR NIS = '$id'");
    $data = mysqli_fetch_assoc($cek_login);

    if (mysqli_num_rows($cek_login) > 0) {
        if (password_verify($password, $data['Password'])) {
            // Menetapkan cookies
            if ($data['NIS'] == NULL) {
                setcookie("username", $data['Username'], time() + (60 * 60 * 24 * 7), "/");
                setcookie("id_pengguna", $data['Id_Pengguna'], time() + (60 * 60 * 24 * 7), "/");
                $message = "Login Berhasil! Anda akan dialihkan ke dashboard.";
            } else {
                $data_siswa = mysqli_query($koneksi, "SELECT * FROM pengguna JOIN siswa USING(NIS) WHERE NIS = '$id'");
                $siswa = mysqli_fetch_assoc($data_siswa);
                setcookie("nis", $siswa['NIS'], time() + (60 * 60 * 24 * 7), "/");
                setcookie("nama", $siswa['Nama_Siswa'], time() + (60 * 60 * 24 * 7), "/");
                setcookie("id_pengguna", $siswa['Id_Pengguna'], time() + (60 * 60 * 24 * 7), "/");
                $message = "Login Berhasil! Anda akan dialihkan ke dashboard.";
            }
            // Tentukan URL untuk redirect setelah login sukses
            $redirect_url = 'view/dashboard.php?page=sertifikat';
        } else {
            $message = 'Password Tidak Ditemukan';
            $redirect_url = 'login.php'; // Tetap di halaman login
        }
    } else {
        $message = 'Username Tidak Ditemukan';
        $redirect_url = 'login.php'; // Tetap di halaman login
    }
}

ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:title" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:image" content="https://fillow.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Admin Dashboard</title>

    <link href="vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link href="css/style.css" rel="stylesheet">

</head>

<style>
body {
    background: url('images/bg.png') no-repeat;
    background-size: cover;
    background-position: center;
}
</style>

<body class="vh-100 login">
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <svg class="logo-abbr" width="55" height="55" viewBox="0 0 55 55" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M27.5 0C12.3122 0 0 12.3122 0 27.5C0 42.6878 12.3122 55 27.5 55C42.6878 55 55 42.6878 55 27.5C55 12.3122 42.6878 0 27.5 0ZM17 16H38V24H30V40H24V24H17V16Z"
                                                fill="url(#paint0_linear)"></path>
                                            <defs>
                                            </defs>
                                        </svg>
                                    </div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form action="" method="post">
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Username / NIS</strong></label>
                                            <input type="text" name="id" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <div class="password-wrapper">
                                                <input type="password" name="password" id="password-field"
                                                    class="form-control">
                                                <div class="toggle-button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="eye-icon">
                                                        <path d="M12 15a3 3 0 100-6 3 3 0 000 6z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <input type="submit" name="tombol_login"
                                                class="btn btn-primary btn-block"></input>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="js/plugins-init/sweetalert.init.js"></script>

    <script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script>
    setTimeout(function() {
        <?php if (isset($message)) { ?>
        Swal.fire({
            title: '<?php echo (isset($message) && strpos($message, 'Tidak Ditemukan') !== false) ? "Gagal!" : "Berhasil!"; ?>',
            text: '<?php echo $message; ?>',
            type: '<?php echo (isset($message) && strpos($message, 'Tidak Ditemukan') !== false) ? 'error' : 'success'; ?>',
            showConfirmButton: true,
            backdrop: false
        }).then(() => {
            <?php if ($redirect_url !== 'login.php') { ?>
            window.location.href = '<?php echo $redirect_url; ?>';
            <?php } ?>

        });
        <?php } ?>
    }, 1000);
    jQuery(window).on('load', function() {
        setTimeout(function() {
            cardsCenter();
        }, 1000);
    });
    jQuery(document).ready(function() {
        setTimeout(function() {
            dlabSettingsOptions.version = 'dark';
            new dlabSettings(dlabSettingsOptions);
        }, 900)
    });
    const eyeIcons = {
        open: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="eye-icon"><path d="M12 15a3 3 0 100-6 3 3 0 000 6z" /><path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" /></svg>',
        closed: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="eye-icon"><path d="M3.53 2.47a.75.75 0 00-1.06 1.06l18 18a.75.75 0 101.06-1.06l-18-18zM22.676 12.553a11.249 11.249 0 01-2.631 4.31l-3.099-3.099a5.25 5.25 0 00-6.71-6.71L7.759 4.577a11.217 11.217 0 014.242-.827c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113z" /><path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0115.75 12zM12.53 15.713l-4.243-4.244a3.75 3.75 0 004.243 4.243z" /><path d="M6.75 12c0-.619.107-1.213.304-1.764l-3.1-3.1a11.25 11.25 0 00-2.63 4.31c-.12.362-.12.752 0 1.114 1.489 4.467 5.704 7.69 10.675 7.69 1.5 0 2.933-.294 4.242-.827l-2.477-2.477A5.25 5.25 0 016.75 12z" /></svg>'
    };

    function addListeners() {
        const toggleButton = document.querySelector(".toggle-button");

        if (!toggleButton) {
            return;
        }

        toggleButton.addEventListener("click", togglePassword);
    }

    function togglePassword() {
        const passwordField = document.querySelector("#password-field");
        const toggleButton = document.querySelector(".toggle-button");

        if (!passwordField || !toggleButton) {
            return;
        }

        toggleButton.classList.toggle("open");

        const isEyeOpen = toggleButton.classList.contains("open");

        toggleButton.innerHTML = isEyeOpen ? eyeIcons.closed : eyeIcons.open;
        passwordField.type = isEyeOpen ? "text" : "password";
    }

    document.addEventListener("DOMContentLoaded", addListeners);
    </script>

    <script src="js/custom.min.js"></script>

    <script src="js/dlabnav-init.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>

</html>