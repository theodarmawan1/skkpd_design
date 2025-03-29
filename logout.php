<?php
// Menghapus sesi jika ada
// session_start();
// session_destroy();

// Menghapus cookie dengan mengatur waktu kadaluarsa ke masa lalu
setcookie("username", "", time() - 3600, "/");
setcookie("nis", "", time() - 3600, "/");
setcookie("id_pengguna", "", time() - 3600, "/");
setcookie("nama", "", time() - 3600, "/");

echo '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Theo : Dashboard SKKPd">
    <meta property="og:title" content="Theo : Dashboard SKKPd">
    <meta property="og:description" content="Theo : Dashboard SKKPd">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Admin Dashboard</title>
    <script src="vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <link href="vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link href="css/cleaned.css" rel="stylesheet">

</head>
<body>
<!-- Required vendors -->
    <script src="js/theme_settings.js"></script>
    <script src="js/custom.min.js"></script>
    <script>
        Swal.fire({
            title: "Berhasil!",
            text: "Anda Logout",
            type: "success",
            timer: 2000,
            showConfirmButton: true,
            backdrop: false
        }).then(() => {
            window.location.href = "login.php";
        });
    </script>
</body>
</html>';
?>