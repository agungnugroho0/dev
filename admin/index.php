<?php
    require_once '../config/koneksi.php';
    require '../config/admin.php';
    $hitung_siswa = $konek->query('SELECT kelas.*, COUNT(siswa.nis) AS jumlah_siswa FROM siswa INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas GROUP BY kelas.kelas');
    $jobdesk = $konek -> query ("SELECT job.*, so.* FROM job JOIN so ON  job.id_so = so.id_so ");
    $jumlah_so = $konek -> query ("SELECT COUNT(so) as jumlah_so FROM so") ->fetch_assoc();
    $jumlah_job = $konek -> query ("SELECT COUNT(job) as jumlah_job FROM job") ->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard</title>
</head>
<body>
    <?php include 'menu.html'?>
    <div class="grid md:grid-cols-3 bg-slate-50">
    <!-- kiri besar -->
    <div class="md:col-span-2">
        <div class="p-3 gap-2 grid grid-cols-2 md:grid-cols-4 lg:col-span-2 ">
            <?php 
            while($row = $hitung_siswa->fetch_assoc()) {
                echo "<div class='p-3 bg-white rounded-xl shadow-sm grid grid-cols-3 max-h-20 relative'>";
                    echo "<p class='font-medium text-slate-500 col-span-3'> KELAS ".$row["kelas"] ."</p>";
                    echo "<p class='font-bold text-2xl text-sky-900 col-span-2'>".$row["jumlah_siswa"] ."</p>";
                    echo "<a href='./admin/siswa?kelas=".$row["kelas"]."'><img src='../image/panah.png' class='relative w-9  md:w-6 lg:w-9 -translate-y-3.5 translate-x-1 md:translate-x-2'/> </a>";
                echo "</div>";
            }
            ?>
        </div>
        <div class="p-3 gap-2 grid grid-cols-2 md:grid-cols-4 lg:col-span-2 ">
                <div class='p-3 bg-white rounded-xl shadow-sm grid grid-cols-3 max-h-20 relative'>
                        <p class='font-medium text-slate-500 col-span-3'> SO </p>
                        <p class='font-bold text-2xl text-sky-900 col-span-2'><?= $jumlah_so['jumlah_so']?></p>
                        <a href='./admin/siswa?kelas='><img src='../image/panah.png' class='relative w-9 md:w-6 lg:w-9 -translate-y-3.5 translate-x-1 md:translate-x-2'/> </a>
                </div>
                <div class='p-3 bg-white rounded-xl shadow-sm grid grid-cols-3 max-h-20 relative'>
                        <p class='font-medium text-slate-500 col-span-3'> JOB </p>
                        <p class='font-bold text-2xl text-sky-900 col-span-2'><?= $jumlah_job['jumlah_job']?></p>
                        <a href='./admin/siswa?kelas='><img src='../image/panah.png' class='relative w-9  md:w-6 lg:w-9 -translate-y-3.5 translate-x-1 md:translate-x-2'/> </a>
                </div>
                <div class='col-span-2 p-3 bg-white rounded-xl shadow-sm grid grid-cols-3 max-h-20 relative'>
                        <p class='font-medium text-slate-500 col-span-3'>Siswa Yang Mengikuti Job</p>
                        <p class='font-bold text-2xl text-sky-900 col-span-2'>XX</p>
                        <a href='./admin/siswa?kelas='><img src='../image/panah.png' class='relative w-9  md:w-6 lg:w-9 -translate-y-3.5 translate-x-14 md:translate-x-12 lg:translate-x-20'/> </a>
                </div>
        </div>
    </div>
    
    <!-- kiri besar -->
     <!-- kanan besar-->
     <div class="m-3 p-3 rounded-xl bg-white md:col-span-1">
        <p class="font-medium text-slate-500">Daftar Job</p>
        <?php
            while($job = $jobdesk->fetch_assoc()) {
                echo '<a href="#" class="flex m-2 p-2 max-w-full cursor-default rounded-lg hover:bg-slate-50  active:scale-95 transition">';
                echo '<img class="w-8 rounded-full mr-2" src="../model/img_so/'.$job['foto_so'].'" />';
                echo '<p class="text-sm font-bold text-slate-800 self-center">'.$job['job'].'</p>';
                echo '<p class="text-sm font-bold text-slate-800 self-center">&nbsp;|&nbsp;'.$job['perusahaan'].'</p>';
                echo '</a>';
                
            }

        ?>
     </div>
    <!-- kanan besar-->
</div>
©️ 2024 v 1.2.1
</body>
</html>