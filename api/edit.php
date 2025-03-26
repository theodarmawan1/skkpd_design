<?php
include '../koneksi.php';
$id = $_GET['id_pengguna'] ?? null; // Ambil ID dari GET

if (!$id) {
    echo json_encode(["status" => "error", "message" => "ID pengguna tidak ditemukan"]);
    exit();
}

// Ambil data pengguna berdasarkan ID
if(!isset($_COOKIE["nis"])){
    $data_pengguna = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT Id_Pengguna, Username, Password, Nama_Lengkap FROM pengguna JOIN pegawai USING(username) WHERE Id_Pengguna='$id'"));
}else{
    $data_pengguna = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT Id_Pengguna, Username, Password FROM pengguna WHERE Id_Pengguna='$id'"));
}
$password  = $_POST['password'];

if (!$data_pengguna) {
    echo json_encode(["status" => "error", "message" => "Data pengguna tidak ditemukan"]);
    exit();
}

if (!$id || !$password) {
    echo json_encode(["status" => "error", "message" => "ID pengguna atau password tidak ditemukan"]);
    exit();
}


if (!password_verify($password, $data_pengguna['Password'])) {
    echo json_encode(["status" => "error", "message" => "Password salah"]);
    exit();
}

// Verifikasi password
if (password_verify($password, $data_pengguna['Password'])) {
    echo json_encode([
        "status" => "success",
        "message" => "Password benar, mengalihkan ke halaman update"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Password salah, coba lagi!"
    ]);
}

?>