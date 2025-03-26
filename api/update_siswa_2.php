<?php
include '../koneksi.php'; // Pastikan koneksi tersedia

header("Content-Type: application/json"); // Pastikan response JSON

if (!isset($_POST['nis']) || !isset($_POST['jurusan'])) {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
    exit;
}

$nis = $_POST['nis'];
$jurusan = $_POST['jurusan'];
$no_absen = $_POST['no_absen'];
$nama_siswa = $_POST['nama_siswa'];
$no_telp = $_POST['no_telp'];
$email = $_POST['email'];
$kelas = $_POST['kelas'];
$angkatan = $_POST['angkatan'];
$password_baru = $_POST['password_baru'];

$data_siswa = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT Password FROM siswa JOIN pengguna USING(NIS) WHERE NIS = '$nis'"));

if (!$data_siswa) {
    echo json_encode(["status" => "error", "message" => "Siswa tidak ditemukan"]);
    exit;
}

// Cek jurusan dan dapatkan ID-nya
$id_result = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT Id_Jurusan FROM jurusan WHERE Jurusan = '$jurusan'"));

if (!$id_result) {
    echo json_encode(["status" => "error", "message" => "Jurusan tidak valid"]);
    exit;
}

$id_jurusan = $id_result['Id_Jurusan'];
$hashed_password_baru = $data_siswa['Password'];

// Jika password diubah, hash password baru
if (!empty($password_baru)) {
    $hashed_password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
    $update_pengguna = mysqli_query($koneksi, 
        "UPDATE pengguna SET Password='$hashed_password_baru' WHERE NIS='$nis'");
}

$hasil = mysqli_query($koneksi, 
    "UPDATE siswa SET Id_Jurusan='$id_jurusan', No_Absen='$no_absen', Nama_Siswa='$nama_siswa',
     No_Telp='$no_telp', Email='$email', Kelas='$kelas', Angkatan='$angkatan' WHERE NIS='$nis'");

if ($hasil) {
    echo json_encode(["status" => "success", "message" => "Data berhasil diperbarui"]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal memperbarui data"]);
}
?>