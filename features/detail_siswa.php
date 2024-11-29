<?php  
include __DIR__ . "../../config/koneksi.php";
include "phpqrcode/qrlib.php";
    
    session_start();
    if($_SESSION['level']==""){
        header("location:../index.php?pesan=gagal");
        exit;
    };
    
    $nis = $_GET['nis'];
    if (isset($_GET['lolos'])){
        $siswa = 'lolos';
    } else {
        $siswa = 'siswa';
    }
    
    $siswa = "SELECT * FROM $siswa JOIN kelas ON $siswa.id_kelas = kelas.id_kelas WHERE nis  = '$nis'";
    $data_siswa = $konek -> query("$siswa")->fetch_assoc();
    $nomor_wa = $data_siswa['wa'];
    if (strpos($nomor_wa, '0') === 0) {
    $nomor_wa = '+62' . substr($nomor_wa, 1);
    } elseif (strpos($nomor_wa, '62') !== 0) {
    $nomor_wa = '+62' . $nomor_wa;

    $pembayaran = "SELECT * FROM pembayaran WHERE nis = '$nis'";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data_siswa['nama'] ?></title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="">
    <?php
    if ($_SESSION['level']=="guru"){
        include '../guru/menu.html';
    } elseif($_SESSION['level']=="admin"){
        include '../admin/menu.html';
    }
    ?>
<div class="grid grid-cols-1 md:grid-cols-6 mx-auto md:max-w-5xl ">
    <div class="col-span-4">
        <div class="flex border-2 p-3 rounded-md items-center">
            <div class="bg-cover bg-center bg-no-repeat w-16 h-16 rounded-xl" style="background-image:url(../model/uploads/<?= $data_siswa['foto'] ?>);"></div>
            <div class="ml-1 pl-3 flex flex-col">
                <p class="font-semibold text-2xl "><?= $data_siswa['nama'];?></p>
                <a href="https:/wa.me/<?=$nomor_wa?>" class="bg-green-600 rounded-lg px-3 text-white font-semibold text-sm mt-1 hover:bg-green-700 active:scale-90 transition">WHATSAPP</a>
            </div>
            <div class="ml-auto flex ">
            <img src='../image/pensil.png' class='w-5'>
            </div>
        </div>
        <div class="col-span-4 grid grid-cols-3 gap-2 border-2 p-3 rounded-md items-center mt-2">
            <p class="font-semibold text-lg col-span-3">Data Diri
                <span class="bg-green-600 text-white px-3 text-sm rounded-md">tester </span>
            </p>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">Nama</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['nama'];?></p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">カタカナ</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['panggilan'];?></p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">Tgl Lahir</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['tgl'];?></p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">Tempat Lahir</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['tempat_lhr'];?></p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">Kelas</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['kelas'];?></p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">Umur</p>
                <p class="font-semibold text-black text-lg"><?php
                $tgl_lahir = new DateTime($data_siswa['tgl']);
                $today = new DateTime("today");
                $y = $today->diff($tgl_lahir)->y;
                echo $y." 歳";
                ?>
                </p>
            </div>
            <div class="mt-2 col-span-3">
                <p class="font-semibold text-slate-500 text-sm">Tempat Tinggal</p>
                <p class="font-semibold text-black text-lg "><?php
                $tinggal = $data_siswa['provinsi'] .",&nbsp;". $data_siswa['kabupaten'] .",&nbsp;". $data_siswa['kecamatan'] .",&nbsp;". $data_siswa['kelurahan'] .",&nbsp; RW. 0". $data_siswa['rw'] ."&nbsp;- RT. 0". $data_siswa['rt']; echo $tinggal;?></p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">Agama</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['agama'];?></p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">Status</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['status'];?></p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">Golongan Darah</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['darah'];?></p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">Berat Badan</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['bb'];?> KG</p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">Tinggi Badan</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['tb'];?> CM</p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">Gender</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['gender'];?></p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">Merokok</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['merokok'];?></p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">Alkohol</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['alkohol'];?></p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">Tangan Dominan</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['tangan'];?></p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">Hobi</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['hobi'];?></p>
            </div>
            <div class="mt-2">
                <p class="font-semibold text-slate-500 text-sm">No Keluarga</p>
                <p class="font-semibold text-black text-lg"><?= $data_siswa['no_rumah'];?></p>
            </div>
        </div>

        <div class="col-span-4 grid grid-cols-3 gap-2 border-2 p-3 rounded-md items-center mt-2">
            <p class="font-semibold text-lg col-span-3">Riwayat Pendidikan</p>
            <p><i>Coming Soon</i></p>
        </div>
        <div class="col-span-4 grid grid-cols-3 gap-2 border-2 p-3 rounded-md items-center mt-2">
            <p class="font-semibold text-lg col-span-3">Data Keluarga</p>
            <p><i>Coming Soon</i></p>
        </div>
    </div>
    <!-- ---------------------------------------- -->
    <div class="col-span-2">
    <?php 
        if ($_SESSION['level']=="admin"){ ?>
            <div class=" border-2 p-3 rounded-md items-center mt-2 md:mt-0 md:ml-3 flex">
                <img src="generate_qrcode.php?nis=<?= $nis ?>" alt="QR Code for NIS " class="w-16"/>
                <div class="ml-1 pl-3 flex flex-col">
                    <p>QR CODE</p>
                    <a href="id_card_pdf.php?nis=<?=$nis ?>" target="_blank" class="bg-red-900 px-2 rounded-md text-white mt-1">Download</a>
                </div>
            </div>
            <div class=" border-2 p-3 rounded-md items-center mt-2 md:ml-3 flex flex-wrap">
                <a href="../admin/view/add_wawancara.php?nis=<?= $data_siswa['nis']?>" class="bg-red-800 px-2 py-0 text-md rounded-md text-white font-semibold active:scale-95 transition cursor-pointer">IKUT JOB</a>
                <a href="#" class="bg-red-800 px-2 py-0 text-md rounded-md text-white font-semibold active:scale-95 transition cursor-pointer ml-2">ABSENSI</a>
            </div>
            <div class=" border-2 p-3 rounded-md items-center mt-2 md:ml-3 flex flex-wrap">
                <p>Pembayaran<br>
                <i>Coming Soon</i></p>
            </div>
            <?php } else { ?>
            <div class=" border-2 p-3 rounded-md items-center mt-2 md:mt-0 md:ml-3 flex">
                <div id="jam" class="font-semibold text-3xl "></div>
                <div class="font-semibold text-2xl ml-auto "><?php echo date('d / M /Y');?></div>
            </div>
            <?php }?>
    </div>
</div>
</body>
</html>

<script>
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('jam').innerHTML = hours + ':' + minutes + ':' + seconds;
    }

    setInterval(updateClock, 1000); // Update setiap detik
    updateClock();
</script>

