<?php
// Koneksi ke database
require_once '../koneksi.php';

// Periksa apakah request adalah metode POST dan parameter NIS dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan NIS dari request
    $nis = isset($_POST['nis']) ? $_POST['nis'] : NULL;
    
    if ($nis === NULL || trim($nis) === "") {
        // Hapus semua notifikasi jika NIS tidak dikirim
        $query = "DELETE FROM notifikasi";
        $stmt = mysqli_prepare($koneksi, $query);
    } else {
        // Hapus notifikasi berdasarkan NIS dengan prepared statement
        $query = "DELETE FROM notifikasi WHERE Id_Sertifikat IN (SELECT Id_Sertifikat FROM sertifikat WHERE NIS = ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "s", $nis);
    }

    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode([
            'success' => true,
            'message' => 'Notifikasi berhasil dihapus'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Gagal menghapus notifikasi: ' . mysqli_error($koneksi)
        ]);
    }

    // Tutup statement dan koneksi
    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
} else {
    // Jika bukan request POST
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
}
?>
