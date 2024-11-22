<?php
require '../../config/admin.php';
require_once '../../config/koneksi.php';
$nis = $_GET['nis'];
$daftar_job = $konek->query("SELECT job.*,so.id_so,so.so FROM job JOIN so ON job.id_so = so.id_so");
$hasil = [];
while($query = $daftar_job -> fetch_assoc()){
$hasil[] = $query;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Wawancara</title>
</head>
<body>
<div class="container mx-auto max-w-lg shadow-md p-3 sm:mt-6">
        <a href="../../features/detail_siswa.php?nis=<?= $nis ?>">🔙</a> <span class="font-bold">Tambah Job</span>
        <form action="../../model/twawancara.php" method="POST" class="mt-3">
            <input type="hidden" name="nis" value="<?= $nis ?>">
            <label for="nama_wawancara" class="font-bold text-gray-500 text-sm mb-2 block">JOBS</label>
            <select name="wawancara" id="nama_wawancara" class="mb-3 border w-full rounded py-2 px-3 leading-tight focus:outline-none focus:shadow-outline bg-white" onchange="updateNamaSO()">
                <option>Pilih JOB</option>
                <?php foreach ($hasil as $job) { ?>
                    <option value="<?= $job['id_job'] ?>" data-nama-so="<?= $job['so'] ?>"><?= $job['job'] . " | " . $job['perusahaan'] ?></option>
                <?php } ?>
            </select>
            <label for="nama_w" class="font-bold text-gray-500 text-sm mb-2 block">Nama SO</label>
            <input type="text" id="nama_w" class="mb-3 appearance-none border w-full rounded py-2 px-3 leading-tight focus:outline-none focus:shadow-outline" disabled>
            <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-bold rounded-lg text-sm px-5 py-2.5 me-2 mt-3 w-full">KIRIM</button>
        </form>
    </div>
</body>
</html>

<script>
function updateNamaSO(){
    var select = document.getElementById('nama_wawancara');
    var selectedOption = select.options[select.selectedIndex];
    var namaSO = selectedOption.getAttribute("data-nama-so");
    document.getElementById("nama_w").value = namaSO;
}
</script>