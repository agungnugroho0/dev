<?php
include __DIR__."../../config/koneksi.php";
$nis = $_GET['nis'];
$siswa = "SELECT nis,nama,kelas FROM siswa INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas WHERE nis LIKE '%$nis%'";
$query = mysqli_query($konek, $siswa);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>

    
</head>
<body>
<div class="container mx-auto mt-3 ">
    <form action="absen_proses.php" method="post" class="max-w-xl mx-auto flex flex-col gap-3">
    <h3 class="font-semibold text-xl pl-3">ABSENSI</h3>
    <?php while ($data = mysqli_fetch_assoc($query)) { ?>
    
    <input class="bg-slate-200 p-3 text-slate-500" name="nis" value="<?php echo $data['nis']; ?>" hidden>
    <input class="bg-slate-200 p-3 text-slate-500" name="metode" value="manual" hidden>
    <input class="bg-slate-200 p-3 text-slate-500" name="nama" value="<?php echo $data['nama']; ?>" readonly>
    <input class="bg-slate-200 p-3 text-slate-500" name="kelas" value="<?php echo $data['kelas']; ?>" readonly>
    <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex ">
    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
        <div class="flex items-center ps-3">
            <input id="horizontal-list-radio-license" type="radio" value="H" name="ket" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 ">
            <label for="horizontal-list-radio-license" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 ">Hadir</label>
        </div>
    </li>
    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
        <div class="flex items-center ps-3">
            <input id="horizontal-list-radio-license1" type="radio" value="I" name="ket" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 ">
            <label for="horizontal-list-radio-license1" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 ">izin</label>
        </div>
    </li>
    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
        <div class="flex items-center ps-3">
            <input id="horizontal-list-radio-license2" type="radio" value="M" name="ket" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 ">
            <label for="horizontal-list-radio-license2" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 pr-2">Mensetsu</label>
        </div>
    </li>
    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
        <div class="flex items-center ps-3">
            <input id="horizontal-list-radio-license3" type="radio" value="S" name="ket" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 ">
            <label for="horizontal-list-radio-license3" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 pr-2">Sakit</label>
        </div>
    </li>
    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
        <div class="flex items-center ps-3">
            <input id="horizontal-list-radio-license4" type="radio" value="A" name="ket" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 ">
            <label for="horizontal-list-radio-license4" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 pr-2">Alfa</label>
        </div>
    </li>
</ul>
<button class="bg-red-800 px-5 py-3 rounded-lg text-slate-50 font-bold hover:bg-red-600 active:scale-95 transition" name="absen">ABSEN</button>
    </form>
    <?php } ?>
</div>
</body>

</html>