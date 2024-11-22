<?php
require_once '../config/koneksi.php';
require '../config/admin.php';

$nis = $_POST['nis'];
$id_job =  $_POST['wawancara'];
$bulan = date('m');
$tanggal = date('d');
$id_wawancara = 'W' . $bulan . $tanggal;
$query = "SELECT MAX(id_w) AS max_id FROM wawancara";
$row = $konek ->query($query)->fetch_assoc();
$no_urut = isset($row['max_id']) ? intval(substr($row['max_id'], -1)) + 1 : 1; // Mengambil angka terakhir dari id terbesar dan menambahkannya
$id_wawancara .= $no_urut;
$tambah = "INSERT INTO wawancara (id_w, id_job, nis) VALUES ('$id_wawancara', '$id_job', '$nis')";
if ($konek->query($tambah) === TRUE) {
    header("Location: ../admin/wawancara.php?status=sudah");
    exit;
} else {
    echo "Error: " . $query . "<br>" . $konek->error;
}
?>