<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_notifikasi = $_POST['id'];
    mysqli_query($koneksi, "UPDATE notifikasi SET Status='read' WHERE Id_Notifikasi='$id_notifikasi'");
    echo "Notifikasi diperbarui!";
}
?>