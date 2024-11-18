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
    <div class="flex mb-3 p-3 flex-col md:flex-row">
        <form action="" method="GET" class="w-full md:max-w-96">
        <label for="cari" class="mb-1 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
            </div>
            <input type="text" id="cari" class="block w-full p-4 ps-10 text-sm text-gray-900 rounded-lg bg-slate-50 active:ring-0" placeholder="Cari Siswa" name="">
        </div>
        </form>
        <div id="muncul" class="mx-2 p-3 md:-translate-y-2 relative">
        
        </div>
    </div>

    <!-- ///////////////////////////// -->
    <div class="bg-slate-50 grid grid-cols-1 lg:grid-cols-3 ">
        <?php
            $kelas = $konek ->query("SELECT * FROM kelas");
            $data_kelas_array = [];
            while($data_kelas = $kelas ->fetch_assoc()) {
                $data_kelas_array[] = $data_kelas;?>
                <div class="bg-white shadow-md p-3 m-3 rounded-lg">
                    <div class="flex">
                        <p class="font-bold">KELAS <?= $data_kelas['kelas']?></p>
                        <a href="#" class="bg-red-900 self-center rounded-lg w-6 h-5 ml-2 cursor-default hover:bg-red-800 active:scale-95 transition ">
                        <p class="text-white font-bold translate-x-1.5 -translate-y-1">+</p>
                        </a>
                    </div>
                    <hr>
                    <p><?php  $wali = $konek ->query("SELECT nama FROM staff WHERE id_kelas = $data_kelas[id_kelas]") ->fetch_assoc(); if($wali){echo "Wali : ".$wali['nama'];}else {echo "";} ?></p>
                    <hr>
                    <?php 
                    $siswa = $konek ->query("SELECT nis, nama,foto, wa FROM  siswa WHERE id_kelas = $data_kelas[id_kelas] ORDER BY gender,nama");

                    while($siswa1 =  $siswa ->fetch_assoc()) {
                        echo  "<p>$siswa1[nama]</p>";
                    }

                    ?>
                </div>

            <?php 
            }?>
        
        <div class="bg-white shadow-md p-3 m-3 rounded-lg">
            <div class="flex">
                <p>Daftar Kelas</p>
                <a href="#" class="bg-red-900 self-center rounded-lg w-6 h-5 ml-2 cursor-default hover:bg-red-800 active:scale-95 transition ">
                    <p class="text-white font-bold translate-x-1.5 -translate-y-1">+</p>
                </a>
            </div>
            <?php
             foreach ($data_kelas_array as $data_kelas) { ?>
                <div class="flex h-8 mt-2 hover:bg-slate-50 p-2 *:self-center">
                    <p class="grow "><?=$data_kelas['kelas']?></p>
                    <a href="#" class=""><img src="../image/pensil.png" class="w-5"></a>
                    <a href="#" class=" rounded-full overflow-hidden ml-2"><img src="../image/sampah.png" class="w-5"></a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>

<script>
    let cari = document.getElementById('cari');
    let muncul = document.getElementById('muncul');

    cari.addEventListener('keydown',function(){
        var xhr = new XMLHttpRequest();
        // cek ajax
        xhr.onreadystatechange = function(){
            if (xhr.readyState === 4 && xhr.status === 200){
                muncul.innerHTML = xhr.responseText;
                // console.log(cari.value);
            }
        };
        xhr.open('GET','./../model/cari_admin.php?cari='+cari.value,true);
        xhr.send();
    });
</script>