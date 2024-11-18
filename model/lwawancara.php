<?php
require_once '../config/koneksi.php';
require '../config/admin.php';

$nis = filter_input(INPUT_GET, 'nis', FILTER_SANITIZE_NUMBER_INT);
$tagihan = filter_input(INPUT_GET, 'tagihan', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$keterangan = "biaya SO";
$status_tagihan = "belum lunas";

$queryPindah = $konek->prepare("INSERT INTO lolos SELECT * FROM siswa WHERE nis = ?");
$queryPindah->bind_param('i', $nis);

if ($queryPindah->execute()) {
    $awalantagihan = str_replace('-', '', date('Y-m-d'));
    $queryid = $konek->query("SELECT MAX(id_tagihan) AS tgh FROM tagihan WHERE id_tagihan LIKE '$awalantagihan%'");

    if ($queryid) {
        $row = $queryid->fetch_assoc();
        if ($row['id_tagihan'] !== null) {
            $id_baru = "T" . $awalantagihan . str_pad(intval(substr($row['id_tagihan'], -3) + 1), 3, '0', STR_PAD_LEFT);
        } else {
            $id_baru = "T" . $awalantagihan . "001";
        }
    } else {
        echo "Error fetching max ID: " . $konek->error;
        exit();
    }

    $queryTagihan = $konek->prepare("INSERT INTO tagihan (id_tagihan, nis, keterangan, biaya, status_tagihan) VALUES (?, ?, ?, ?, ?)");
    $queryTagihan->bind_param('sisds', $id_baru, $nis, $keterangan, $tagihan, $status_tagihan);

    if ($queryTagihan->execute()) {
        $queryHapus = $konek->prepare("DELETE FROM siswa WHERE nis = ?");
        $queryHapus->bind_param('i', $nis);

        if ($queryHapus->execute()) {
            header('Location: ../admin/wawancara.php?status=sukses');
            exit();
        } else {
            echo "Gagal menghapus data dari tabel siswa: " . $queryHapus->error;
        }
    } else {
        echo "Gagal menambahkan tagihan: " . $queryTagihan->error;
    }
} else {
    echo "Gagal memindahkan data ke tabel lolos: " . $queryPindah->error;
}
