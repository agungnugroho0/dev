<?php  
    include __DIR__ . "../../config/koneksi.php";
    
    session_start();
    if($_SESSION['level']==""){
        header("location:../index.php?pesan=gagal");
        exit;
    };
    $username  = $_SESSION['username'];
    $level  = $_SESSION['level'];
    $id_kelas = $_SESSION['kelas'];
    $nama = $_SESSION['nama'];
    include "phpqrcode/qrlib.php";
    
    $nis = $_GET['nis'];
    $siswa = "SELECT * FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id_kelas WHERE nis  = '$nis'";

    $data_siswa = mysqli_query($konek, "$siswa");
    while ($data = mysqli_fetch_assoc($data_siswa)){ 
        $judul = $data["nama"];
        $nama = $data["nama"];
        $panggilan = $data["panggilan"];
        // tampil data siswa
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <?php include '../guru/menu.html' ?>
    <div  class="grid md:grid-cols-6 sm:grid-cols-3 gap-3 sm:mx-10 mx-3 *:p-3 mt-4">
        <div class="bg-slate-200 sm:col-span-4 sm:order-first">Data Siswa
        <?php
            echo "<br>".$nama."<br>";
            echo $panggilan."<br>";
        ?>
        </div>
        <?php //if($level == "admin") {?>
        <div class="sm:col-span-4 md:col-span-2 order-first ">
            
            <a href="id_card_pdf.php?nis=<?=$nis ?>" target="_blank">
            <button>Cetak ID Card (PDF)</button>
            </a>
            <img src="generate_qrcode.php?nis=<?= $nis ?>" alt="QR Code for NIS " class="w-[8rem]"/>
        </div>
        <?php //} ?>
        <div class="bg-red-200">Job</div>
        <div class="bg-red-200">Absensi</div>
    </div>

    <script>
        
    </script>
</body>
</html>
