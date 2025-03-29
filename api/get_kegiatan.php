<?php
include "../koneksi.php";

if (isset($_POST['Id_Kategori'])) {
    $Id_Kategori = $_POST['Id_Kategori'];

    // Query untuk mengambil kegiatan berdasarkan kategori yang dipilih
    $query = mysqli_query($koneksi, "SELECT * FROM kegiatan WHERE Id_Kategori = '$Id_Kategori'");

    // Mengecek jika ada kegiatan yang sesuai dengan kategori
    if ($query && mysqli_num_rows($query) > 0) {
        echo "<option value=''>Pilih Kegiatan</option>";

        // Cek jika request adalah untuk update, periksa apakah Id_Kegiatan sudah ada (untuk menambah `selected`)
        $is_update = isset($_POST['Id_Kegiatan']);

        // Loop untuk menampilkan semua kegiatan yang terkait dengan kategori yang dipilih
        while ($data = mysqli_fetch_assoc($query)) {
            // Jika dalam mode update, pastikan pilihan yang sudah dipilih sebelumnya mendapat atribut `selected`
            $selected = "";
            if ($is_update && $_POST['Id_Kegiatan'] == $data['Id_Kegiatan']) {
                $selected = "selected"; // Jika Id_Kegiatan yang dipilih sesuai dengan data yang sudah ada, tambahkan selected
            }

            // Tampilkan opsi kegiatan dalam dropdown
            echo "<option value='{$data['Id_Kegiatan']}' $selected>{$data['Jenis_Kegiatan']}</option>";
        }
    } else {
        echo "<option value=''>Tidak ada kegiatan</option>";
    }
}
?>