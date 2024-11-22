<?php
require_once '../config/koneksi.php';
require '../config/admin.php';

$nis = $_POST['nis'];
$id_job = $_POST['wawancara'];
$bulan = date('m');
$tanggal = date('d');
$id_wawancara = 'W' . $bulan . $tanggal;

// Logika untuk menghasilkan id_wawancara yang unik
do {
    // Ambil MAX(id_w) untuk mendapatkan nomor urut terakhir
    $query = "SELECT MAX(id_w) AS max_id FROM wawancara";
    $row = $konek->query($query)->fetch_assoc();
    $no_urut = isset($row['max_id']) ? intval(substr($row['max_id'], -1)) + 1 : 1; // Mengambil angka terakhir dari id terbesar dan menambahkannya
    $id_wawancara = 'W' . $bulan . $tanggal . $no_urut;

    // Cek apakah id_wawancara sudah ada
    $check_query = "SELECT COUNT(*) AS count FROM wawancara WHERE id_w = '$id_wawancara'";
    $check_result = $konek->query($check_query);
    $count = $check_result->fetch_assoc()['count'];

} while ($count > 0); // Ulangi jika id_wawancara sudah ada

// Lanjutkan dengan INSERT
$tambah = "INSERT INTO wawancara (id_w, id_job, nis) VALUES ('$id_wawancara', '$id_job', '$nis')";
if ($konek->query($tambah) === TRUE) {
    header("Location: ../admin/wawancara.php?status=sudah");
    exit;
} else {
    echo "Error: " . $tambah . "<br>" . $konek->error;
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
?>