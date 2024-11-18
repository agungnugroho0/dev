<?php 
include __DIR__."../../config/koneksi.php";
session_start();
if($_SESSION['level']==""){
    header("location:../index.php?pesan=gagal");
};
    $username  = $_SESSION['username'];
    $level  = $_SESSION['level'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body>
    <?php 
        include 'menu.html';
    ?>
        <div class="container mx-auto grid max-w-xl mt-3">
            <div class="text-2xl font-bold pl-3 sm:pl-0">Laporan Absensi</div>
            <div>
                <input type="month" name="bulan" id="bulan" class="p-3">
                <?php ?>
            </div>
            
            <div class="overflow-auto " id="tampil"></div>
        </div>
</body>
<script src="../features/l_absen.js"></script>

</html>