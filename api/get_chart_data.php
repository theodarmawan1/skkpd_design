<?php
// Koneksi ke database
include "../koneksi.php";

// Query jumlah siswa
$querySiswa = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM siswa");
$jumlahSiswa = mysqli_fetch_assoc($querySiswa)['total'];

// Query jumlah jurusan
$queryJurusan = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM jurusan");
$jumlahJurusan = mysqli_fetch_assoc($queryJurusan)['total'];

// Query jumlah kegiatan
$queryKegiatan = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM kegiatan");
$jumlahKegiatan = mysqli_fetch_assoc($queryKegiatan)['total'];

// Query jumlah kategori unik dalam kegiatan
$queryKategori = mysqli_query($koneksi, "SELECT COUNT(DISTINCT Kategori) as total FROM kegiatan JOIN kategori USING(Id_Kategori)");
$jumlahKategori = mysqli_fetch_assoc($queryKategori)['total'];

// Query jumlah kegiatan per kategori
$queryKegiatanPerKategori = mysqli_query($koneksi, "SELECT Sub_Kategori, COUNT(*) as total FROM kategori");

$kegiatanPerKategori = [];
while ($row = mysqli_fetch_assoc($queryKegiatanPerKategori)) {
    $kegiatanPerKategori[$row['Sub_Kategori']] = $row['total'];
}

// Query jumlah sertifikat berdasarkan status secara keseluruhan
$queryApproved = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM sertifikat WHERE Status='Approved'");
$queryPending = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM sertifikat WHERE Status='Pending'");
$queryCanceled = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM sertifikat WHERE Status='Canceled'");

// Simpan hasil query status sertifikat
$data = [
    'jumlah_siswa' => $jumlahSiswa,
    'jumlah_jurusan' => $jumlahJurusan,
    'jumlah_kegiatan' => $jumlahKegiatan,
    'jumlah_kategori' => $jumlahKategori,
    'kegiatan_per_kategori' => $kegiatanPerKategori,
    'approved' => mysqli_fetch_assoc($queryApproved)['total'],
    'pending' => mysqli_fetch_assoc($queryPending)['total'],
    'canceled' => mysqli_fetch_assoc($queryCanceled)['total'],
];

// Ambil daftar jurusan dari database
$queryJurusan = mysqli_query($koneksi, "SELECT Id_Jurusan, Jurusan FROM jurusan");
$jurusanList = [];

while ($row = mysqli_fetch_assoc($queryJurusan)) {
    $jurusanList[$row['Id_Jurusan']] = $row['Jurusan'];
}

// Query jumlah siswa per jurusan
foreach ($jurusanList as $id_jurusan => $jurusan) {
    $query = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM siswa WHERE Id_Jurusan = '$id_jurusan'");
    $data[strtolower('siswa_' . str_replace(' ', '_', $jurusan))] = mysqli_fetch_assoc($query)['total'];
}

// Looping untuk mengambil jumlah sertifikat per jurusan dan status
$statuses = ['Approved', 'Pending', 'Canceled'];

foreach ($jurusanList as $id_jurusan => $jurusan) {
    foreach ($statuses as $status) {
        $query = mysqli_query($koneksi, "SELECT COUNT(*) as total 
                                         FROM sertifikat 
                                         JOIN siswa USING(NIS) 
                                         WHERE Status = '$status' 
                                         AND Id_Jurusan = '$id_jurusan'");
        $data[strtolower(str_replace(' ', '_', $jurusan)) . "_" . strtolower(substr($status, 0, 1))] = mysqli_fetch_assoc($query)['total'];
    }
}


// Ubah data menjadi JSON
header('Content-Type: application/json');
echo json_encode($data);
?>