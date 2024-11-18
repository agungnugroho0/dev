<?php
require_once '../config/koneksi.php';
require '../config/admin.php';

$so = $konek -> query('SELECT id_so,so,foto_so FROM SO');
$so2 = $konek ->query("SELECT  so.id_so,so.so,so.foto_so,job.* FROM SO JOIN job ON so.id_so = job.id_so");
while($hasil = $so2 -> fetch_assoc()){
    $id_jobs = $hasil['id_job'];
    echo $hasil['perusahaan'];
    $anak = $konek ->query("SELECT job.*, siswa.nis, wawancara.*, siswa.nama, siswa.foto FROM job JOIN wawancara ON job.id_job = wawancara.id_job JOIN siswa ON wawancara.nis = siswa.nis WHERE job.id_job = $id_jobs");
    while ($hasil2 = $anak -> fetch_assoc()){
        echo $hasil2['id_job'];
        echo $hasil2['nama'];
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wawancara</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="">
<?php include 'menu.html'; ?>
  <div class="bg-slate-50 grid lg:grid-cols-4">
    <!-- kiri -->
    <div class="lg:col-span-3">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <!-- kontend -->
    </div>
    </div>
    <!-- kiri -->
     <!-- kanan -->
      <div class="bg-white m-2 p-3 rounded-lg shadow-md ">
        <div class="flex">
            <p class="font-bold text-sky-950 text-lg self-center">DAFTAR SO</p>
            <a href="#" class="bg-red-900 self-center rounded-lg w-6 h-5 ml-2 cursor-default hover:bg-red-800 active:scale-95 transition "><p class="text-white font-bold translate-x-1.5 -translate-y-1">+</p></a>
        </div>
        <?php while ($hasil_so = $so ->fetch_assoc()){ ?>
            <a href="#" class="group flex p-1 max-w-full cursor-default rounded-lg hover:bg-slate-50 active:scale-95 ">
                
                <div class="bg-contain bg-center bg-no-repeat w-8 h-8 rounded-full" style="background-image:url(../model/img_so/<?= $hasil_so['foto_so']?>);" alt="so"></div>
                <p class="self-center font-medium text-slate-400 group-hover:text-red-900 group-hover:font-bold pl-2 transition"><?= $hasil_so['so']?></p>
            
            </a>
            <?php }?>
      </div>
  </div>
</body>
</html>