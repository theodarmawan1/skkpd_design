<?php
// File: get_suggestions.php
include '../koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Menerima parameter
$keyword = mysqli_real_escape_string($koneksi, $_GET['keyword'] ?? '');
$filter_by = $_GET['filter_by'] ?? 'Jenis_Kegiatan';

$suggestions = [];

if (!empty($keyword)) {
    // Query untuk mendapatkan suggestion berdasarkan filter
    switch($filter_by) {
        case 'Jenis_Kegiatan':
            $query = "SELECT DISTINCT Jenis_Kegiatan FROM kegiatan WHERE Jenis_Kegiatan LIKE '%$keyword%' LIMIT 10";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $suggestions[] = $row['Jenis_Kegiatan'];
            }
            break;
        case 'Kategori':
            $query = "SELECT DISTINCT Kategori FROM kategori WHERE Kategori LIKE '%$keyword%' LIMIT 10";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $suggestions[] = $row['Kategori'];
            }
            break;
        case 'Sub_Kategori':
            $query = "SELECT DISTINCT Sub_Kategori FROM kategori WHERE Sub_Kategori LIKE '%$keyword%' LIMIT 10";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $suggestions[] = $row['Sub_Kategori'];
            }
            break;
        case 'Nama_Siswa':
            $query = "SELECT DISTINCT Nama_Siswa FROM siswa WHERE Nama_Siswa LIKE '%$keyword%' LIMIT 10";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $suggestions[] = $row['Nama_Siswa'];
            }
            break;
        case 'NIS':
            $query = "SELECT DISTINCT NIS FROM siswa WHERE NIS LIKE '%$keyword%' LIMIT 10";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $suggestions[] = $row['NIS'];
            }
            break;
        case 'Angkatan':
            $query = "SELECT DISTINCT Angkatan FROM siswa WHERE Angkatan LIKE '%$keyword%' LIMIT 10";
            $result = mysqli_query($koneksi, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $suggestions[] = $row['Angkatan'];
            }
            break;
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($suggestions);
?>