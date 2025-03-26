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
    <meta name="description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:title" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:image" content="https://fillow.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="vendor/sweetalert2/dist/sweetalert2.min.js"></script> -->
    <!-- <script src="js/plugins-init/sweetalert.init.js"></script> -->

    <link href="vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <!-- Datatable -->
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>
<body>
<!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="js/plugins-init/sweetalert.init.js"></script>

    <script src="vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
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
    <script src="js/custom.min.js"></script>

    <script src="js/dlabnav-init.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>
</html>';
?>