<?php
include '../koneksi.php';

$id = $_GET['id_pengguna'] ?? null; // Ambil ID dari GET

if (!$id) {
    echo json_encode(["status" => "error", "message" => "ID pengguna tidak ditemukan"]);
    exit();
}

// Ambil data pengguna berdasarkan ID
$query = "SELECT Id_Pengguna, NIS, Username, Password, Nama_Lengkap 
          FROM pengguna 
          JOIN pegawai USING(Username) 
          WHERE Id_Pengguna = '$id'";

$result = mysqli_query($koneksi, $query);
$data_pengguna = mysqli_fetch_assoc($result);

if (!$data_pengguna) {
    echo json_encode(["status" => "error", "message" => "Data pengguna tidak ditemukan"]);
    exit();
}

// Ambil password yang dikirim dari Ajax
$password = $_POST['password'] ?? '';

if (!password_verify($password, $data_pengguna['Password'])) {
    echo json_encode(["status" => "error", "message" => "Password salah"]);
    exit();
}

// Proses penghapusan
if (empty($data_pengguna['NIS'])) {
    $delete_pengguna = mysqli_query($koneksi, "DELETE FROM pengguna WHERE Id_Pengguna = '$id'");
    $delete_pegawai = mysqli_query($koneksi, "DELETE FROM pegawai WHERE Username = '{$data_pengguna['Username']}'");
} else {
    $delete_pengguna = mysqli_query($koneksi, "DELETE FROM pengguna WHERE NIS = '{$data_pengguna['NIS']}'");
    $delete_sertifikat = mysqli_query($koneksi, "DELETE FROM sertifikat WHERE NIS = '{$data_pengguna['NIS']}'");
    $delete_siswa = mysqli_query($koneksi, "DELETE FROM siswa WHERE NIS = '{$data_pengguna['NIS']}'");
}

// Cek apakah query berhasil
if ($delete_pengguna) {
    echo json_encode(["status" => "success", "message" => "Data berhasil dihapus"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal menghapus data"]);
}
?>