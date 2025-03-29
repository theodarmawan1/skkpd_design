<?php
// Koneksi ke database
require_once '../koneksi.php';

// Periksa apakah request adalah metode POST dan parameter NIS dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan NIS dari request
    $nis = isset($_POST['nis']) ? $_POST['nis'] : NULL;
    
    if ($nis === NULL || trim($nis) === "") {
        // Jika admin, hapus notifikasi dengan isTambah = 1
        $query = "DELETE FROM notifikasi WHERE isTambah = 1";
    } else {
        // Jika siswa, hapus notifikasi berdasarkan NIS dan isTambah = 0
        $query = "DELETE FROM notifikasi WHERE Id_Sertifikat IN (
                      SELECT Id_Sertifikat FROM sertifikat WHERE NIS = '$nis'
                  ) AND isTambah = 0";
    }

    // Jalankan query
    $hasil = mysqli_query($koneksi, $query);

    if ($hasil) {
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

    // Tutup koneksi
    mysqli_close($koneksi);
} else {
    // Jika bukan request POST
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
}
?>
