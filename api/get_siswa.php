<?php
include '../koneksi.php';

$angkatan = isset($_POST['angkatan']) ? $_POST['angkatan'] : '';
$search = isset($_POST['search']) ? $_POST['search'] : '';

if (empty($angkatan)) {
    echo json_encode(["error" => "Angkatan tidak dikirim"]);
    exit;
}

// Debugging - Cek apakah angkatan dan search diterima
file_put_contents("debug.log", "Angkatan: $angkatan, Search: $search\n", FILE_APPEND);

// Mulai query dengan SELECT
$query = "SELECT NIS, Nama_Siswa FROM sertifikat JOIN siswa USING(NIS)";

// Jika angkatan bukan "Semua", tambahkan kondisi WHERE sebelum GROUP BY
$conditions = [];

if ($angkatan !== 'Semua') {
    $conditions[] = "Angkatan = '$angkatan'";
}

// Tambahkan filter pencarian jika ada
if (!empty($search)) {
    $conditions[] = "(NIS LIKE '%$search%' OR Nama_Siswa LIKE '%$search%')";
}

// Jika ada kondisi, tambahkan WHERE
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

// Tambahkan GROUP BY setelah WHERE
$query .= " GROUP BY NIS";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    echo json_encode(["error" => mysqli_error($koneksi)]);
    exit;
}

$data = [["id" => "all", "text" => "Semua"]]; // Tambahkan opsi "Semua"

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = ["id" => $row['NIS'], "text" => "{$row['NIS']} - {$row['Nama_Siswa']}"];
}

echo json_encode($data);

?>