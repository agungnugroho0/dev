<?php

include __DIR__."../../config/koneksi.php";
session_start();
if($_SESSION['level']==""){
    header("location:../index.php?pesan=gagal");
};
$username  = $_SESSION['username'];
$level  = $_SESSION['level'];
$nama = $_SESSION['nama'];
// Cek jika ada GET parameter untuk notifikasi
$notification = '';
$message = '';

if (isset($_GET['absensi'])) {
    $notification = 'info';
    $message = "Siswa sudah absensi hari ini";
} elseif (isset($_GET['status'])) {
    $notification = 'success';
    $message = "Absensi siswa sudah masuk";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCAN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <?php 
        include 'menu.html';
        include '../features/pencarian.php';
        
        ?>
        <div class="container mx-auto grid max-w-md mt-3 ">
            <div id="reader" class="rounded-lg overflow-hidden m-5 md:m-0"></div>
              <!-- SweetAlert2 Notifikasi -->
        <?php if ($message): ?>
        <script>
            Swal.fire({
                icon: '<?= $notification; ?>',
                title: 'Notifikasi',
                text: '<?= $message; ?>'
            });
        </script>
        <?php endif; ?>
        </div>
</body>

<script src="../node_modules/html5-qrcode/html5-qrcode.min.js"></script>
<script src="../features/scanner.js"></script>

</html>
