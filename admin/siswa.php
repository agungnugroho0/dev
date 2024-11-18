<?php
require_once '../config/koneksi.php';
require '../config/admin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <?php include 'menu.html'; ?>
    <div class="bg-slate-50 grid grid-cols-1 lg:grid-cols-4 ">
        <?php
            $kelas = $konek ->query("SELECT * FROM kelas");
            $data_kelas_array = [];
            while($data_kelas = $kelas ->fetch_assoc()) {
                $data_kelas_array[] = $data_kelas;?>
                <div class="bg-white shadow-md p-3 m-3 rounded-lg">
                    <p class="font-bold">KELAS <?= $data_kelas['kelas']?></p>
                    <hr>
                    <p><?php  $wali = $konek ->query("SELECT nama FROM staff WHERE id_kelas = $data_kelas[id_kelas]") ->fetch_assoc(); if($wali){echo "Wali : ".$wali['nama'];}else {echo "";} ?></p>

                </div>

            <?php 
            }?>
        
        <div class="bg-white shadow-md p-3 m-3 rounded-lg lg:col-span-2">Daftar Kelas
            <?php
             foreach ($data_kelas_array as $data_kelas) { ?>
                <div class="flex"><?=$data_kelas['kelas']?>
                <a href="#"><img src="../image/pensil.png"> &nbsp;edit</a>
                <a href="#"> &nbsp;hapus</a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>