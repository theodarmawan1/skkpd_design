<?php
include '../koneksi.php';
$query = "SELECT DISTINCT siswa.Angkatan FROM sertifikat 
          JOIN siswa ON sertifikat.NIS = siswa.NIS 
          ORDER BY siswa.Angkatan DESC";
$result = mysqli_query($koneksi, $query);
$options = "<option value=''>-- Pilih Angkatan --</option>";
$options .= "<option value='Semua'>Semua</option>"; 
while ($row = mysqli_fetch_assoc($result)) {
    $options .= "<option value='{$row['Angkatan']}'>{$row['Angkatan']}</option>";
}
echo $options;
?>