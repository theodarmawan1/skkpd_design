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

// Jika password benar, ambil data siswa tambahan
$data_siswa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT *, siswa.NIS as nis FROM pengguna JOIN siswa USING(NIS) JOIN jurusan USING(Id_Jurusan) WHERE Id_Pengguna='$id'"));

if (!$data_siswa) {
    echo json_encode(["status" => "error", "message" => "Data siswa tidak ditemukan"]);
    exit();
}

// Kembalikan data siswa beserta status sukses
echo json_encode([
    "status" => "success",
    "message" => "Password benar, data berhasil ditemukan",
    "nis" => $data_siswa['nis'],
    "jurusan" => $data_siswa['Jurusan'],
    "no_absen" => $data_siswa['No_Absen'],
    "nama_siswa" => $data_siswa['Nama_Siswa'],
    "no_telp" => $data_siswa['No_Telp'],
    "email" => $data_siswa['Email'],
    "kelas" => $data_siswa['Kelas'],
    "angkatan" => $data_siswa['Angkatan'],
]);
?>