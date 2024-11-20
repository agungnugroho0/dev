<?php
require_once '../config/koneksi.php';
require '../config/admin.php';
$so = $konek->query('SELECT id_so,so,foto_so FROM SO');
$so2 = $konek->query("SELECT  so.id_so,so.so,so.foto_so,job.* FROM SO JOIN job ON so.id_so = job.id_so");
$pesan = '';
if (isset($_GET['status']) && $_GET['status'] == 'sudah') {
    $pesan = "OK";
} else if (isset($_GET['status']) && $_GET['status'] == 'hapus') {
    $pesan = "TERHAPUS SUDAH";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wawancara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="">
    <?php include 'menu.html'; ?>
    <div class="bg-slate-50 grid lg:grid-cols-4">
        <!-- kiri -->
        <div class="lg:col-span-3 m-2">
            <div class="p-3 grid grid-cols-1 md:grid-cols-3 bg-white rounded-lg shadow-sm gap-3">
                <div class="flex md:col-span-3">
                    <p class="font-bold text-sky-950 text-lg self-center ">DAFTAR JOBS</p>
                    <a href="./view/add_job.php" class="bg-blue-900 self-center rounded-lg w-6 h-5 ml-2 cursor-default hover:bg-red-800 active:scale-95 transition ">
                        <p class="text-white font-bold translate-x-1.5 -translate-y-0.5 md:-translate-y-1">+</p>
                    </a>
                </div>

                <!-- JOBS -->
                <?php
                while ($hasil = $so2->fetch_assoc()) {
                    $id_jobs = $hasil['id_job'] ?>
                    <div class="grid rounded-xl shadow-md p-3">
                        <div class="flex border-b-2">
                            <div class="bg-contain bg-center bg-no-repeat w-8 h-8 rounded-full" style="background-image:url(../model/img_so/<?= $hasil['foto_so'] ?>);"></div>
                            <p class='font-medium basis-full ml-2'><?= $hasil['job'] ?></p>
                            <a href='./view/edit_job.php?id_job=<?= $id_jobs ?>' class='mr-2'><img src='../image/pensil.png' class='w-5 translate-y-1 '></a>
                            <a href='#' onclick="confirmDelete(<?= $id_jobs ?>)"><img src='../image/sampah.png' class='w-5 translate-y-1'></a>
                        </div>
                        <div class="flex">
                            <p class=""><?= $hasil['perusahaan'] ?>&nbsp;|</p>
                            <p class="">&nbsp;<?= $hasil['tgl_job'] ?></p>
                        </div>
                        <div class="divide-y divide-gray-200 *:mt-1">
                            <?php
                            $anak = $konek->query("SELECT job.*, siswa.nis, wawancara.*, siswa.nama, siswa.foto FROM job JOIN wawancara ON job.id_job = wawancara.id_job JOIN siswa ON wawancara.nis = siswa.nis WHERE job.id_job = $id_jobs");
                            if ($anak->num_rows > 0) {
                                while ($hasil2 = $anak->fetch_assoc()) {
                            ?>
                                    <div class="flex">
                                        <p class="basis-full"><?= $hasil2['nama'] ?></p>
                                        <a href="#" onclick="inputTagihan(<?= $hasil2['nis'] ?>)"><img src="../image/centang.png" class="w-6 h-6 -translate-x-2 hover:scale-125 transition" alt="lulus"></a>
                                        <a href="../model/hwawancara.php?id_w=<?= $hasil2['id_w'] ?>"><img src="../image/silang.png" class="w-6 h-6 hover:scale-125 transition" alt="gagal"></a>
                                    </div>

                            <?php }
                            } else {
                                echo "<div class='font-medium text-slate-400'>Belum Ada Peserta</div>";
                            } ?>

                        </div>
                    </div>
                <?php } ?>


                <!-- JOBS -->

            </div>
        </div>
        <!-- kiri -->
        <!-- kanan -->
        <div class="bg-white m-2 p-3 rounded-lg shadow-md ">
            <div class="flex">
                <p class="font-bold text-sky-950 text-lg self-center">DAFTAR SO</p>
                <a href="#" class="bg-red-900 self-center rounded-lg w-6 h-5 ml-2 cursor-default hover:bg-red-800 active:scale-95 transition ">
                    <p class="text-white font-bold translate-x-1.5 -translate-y-0.5 md:-translate-y-1">+</p>
                </a>
            </div>
            <?php while ($hasil_so = $so->fetch_assoc()) { ?>
                <a href="#" class="group flex p-1 max-w-full cursor-default rounded-lg hover:bg-slate-50 active:scale-95 ">
                    <div class="bg-contain bg-center bg-no-repeat w-8 h-8 rounded-full" style="background-image:url(../model/img_so/<?= $hasil_so['foto_so'] ?>);" alt="so"></div>
                    <p class="self-center font-medium text-slate-400 group-hover:text-red-900 group-hover:font-bold pl-2 transition "><?= $hasil_so['so'] ?></p>

                </a>
            <?php  } ?>
        </div>
    </div>
</body>

</html>
<script>
    function confirmDelete(id_job) {
        Swal.fire({
            title: 'YAKIN?',
            text: "Job akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OKEH',
            cancelButtonText: 'Sekkk'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the delete action
                window.location.href = '../model/hjob.php?id_job=' + id_job;
            }
        });
    }
    // Memanggil SweetAlert jika ada status message
    <?php if ($pesan): ?>
        Swal.fire({
            icon: 'success',
            title: '<?= $pesan ?>',
            showConfirmButton: false,
            timer: 1500
        });
    <?php endif; ?>;

    function inputTagihan(nis) {
        Swal.fire({
            title: 'Biaya SO',
            html: `<input 
            type="text" 
            id="tagihan" class="mb-3 appearance-none border w-full rounded py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" 
            placeholder="Masukkan sisa tagihan" 
            oninput="formatCurrency(this)" 
            maxlength="15">`,
            showCancelButton: true,
            confirmButtonText: 'GASKEUN',
            cancelButtonText: 'Batal',
            cancelButtonColor: '#d33',
            preConfirm: () => {
                const tagihan = document.getElementById('tagihan').value.replace(/[.,]/g, ''); //hapus titik dan koma
                if (!tagihan) {
                    Swal.showValidationMessage('Tagihan kosong!');
                }
                return {
                    tagihan
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const tagihan = result.value.tagihan;

                // Redirect ke halaman lwawancara.php dengan parameter
                window.location.href = `../model/lwawancara.php?nis=${nis}&tagihan=${tagihan}`;
            }
        });
    }

    function formatCurrency(input) {
        let value = input.value.replace(/[^\d]/g, ''); // Hapus karakter non-angka
        if (value) {
            value = parseInt(value, 10).toLocaleString('id-ID'); // Format ke "id-ID"
        }
        input.value = value;
    }
</script>