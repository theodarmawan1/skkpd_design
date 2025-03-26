<?php
include '../koneksi.php';
$query = "SELECT DISTINCT Status FROM sertifikat"; // DISTINCT sudah cukup, tidak perlu GROUP BY
$result = mysqli_query($koneksi, $query);

$options = "<option value=''>-- Pilih Status --</option>";
$options .= "<option value='Semua'>Semua</option>"; // Tambahkan "Semua" hanya sekali

while ($row = mysqli_fetch_assoc($result)) {
    $options .= "<option value='{$row['Status']}'>{$row['Status']}</option>";
}

echo $options;
?>