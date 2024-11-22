<?php
require_once '../config/koneksi.php';
require '../config/admin.php';

$nis = $_POST['nis'];
$id_job = $_POST['wawancara'];
$bulan = date('m');
$tanggal = date('d');
$id_wawancara = 'W' . $bulan . $tanggal;

// Query untuk mendapatkan nomor urut terakhir pada tanggal yang sama
$query = "SELECT MAX(id_w) AS max_id FROM wawancara WHERE id_w LIKE '$id_wawancara%'";
$row = $konek->query($query)->fetch_assoc();

if ($row && $row['max_id']) {
    // Ambil nomor urut dari ID terakhir, lalu tambahkan 1
    $no_urut = intval(substr($row['max_id'], -3)) + 1; // Asumsikan no urut maksimal 3 digit
} else {
    $no_urut = 1; // Jika belum ada ID pada tanggal ini
}

// Tambahkan nomor urut ke ID
$id_wawancara .= str_pad($no_urut, 3, '0', STR_PAD_LEFT); // Pad nomor urut jadi 3 digit

// Simpan ke database
$tambah = "INSERT INTO wawancara (id_w, id_job, nis) VALUES ('$id_wawancara', '$id_job', '$nis')";
if ($konek->query($tambah) === TRUE) {
    header("Location: ../admin/wawancara.php?status=sudah");
    exit;
} else {
    echo "Error: " . $query . "<br>" . $konek->error;
}
?>
