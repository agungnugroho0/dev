<?php 
require_once '../config/koneksi.php';
require '../config/admin.php';
include 'function/lolos.php';
$nis = filter_input(INPUT_GET, 'nis', FILTER_SANITIZE_NUMBER_INT);
$tagihan = filter_input(INPUT_GET, 'tagihan', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$tagihan2 = "4000000";
$keterangan_biaya = "biaya SO";
$keterangan_biaya2 = "biaya Hikari";
$status_tagihan = "belum lunas";

$tgl_lolos = filter_input(INPUT_GET, 'tgl_lolos');
$id_awal = str_replace('-','',$tgl_lolos);

$konek->begin_transaction();
try{
    log_lolos($nis,$id_awal,$tgl_lolos);
    lolos();
    tagihan ($keterangan_biaya,$tagihan);
    tagihan ($keterangan_biaya2,$tagihan2);
    hapus ('siswa');
    hapus ('wawancara');

    
    $konek->commit();
    header ("Location: ../admin/wawancara.php?status=sukses");
    exit;
} catch (Exception $e) {
    // Rollback jika ada error
    $konek->rollback();
    $message = urlencode("Error: " . $e->getMessage());
    header("Location: ../admin/wawancara.php?error=$message");
    exit;
}


?>