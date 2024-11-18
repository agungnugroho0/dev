<?php

    include "phpqrcode/qrlib.php";

    // Ambil NIS dari URL
    $nis = $_GET['nis'];

    // Direktori untuk menyimpan QR code sementara
    $tempdir = "qr_images/";
    if (!file_exists($tempdir)) {
        mkdir($tempdir);
    }

    // Nama file QR code
    $filename = $tempdir . $nis. ".png";

    // Konten QR code (dalam hal ini adalah NIS)
    $content = $nis;

    // Buat QR code
    QRcode::png($content, $filename, QR_ECLEVEL_L, 4);

    // Tampilkan QR code sebagai gambar
    header('Content-Type: image/png');
    readfile($filename);
?>

?>
