<?php
    require '../../config/admin.php';
    require_once '../../config/koneksi.php';
    $so = $konek -> query('SELECT * FROM SO');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>+</title>
</head>
<body>
    <div class="container mx-auto max-w-lg shadow-md p-3 sm:mt-6">
        <a href="../wawancara.php">🔙</a> <span class="font-bold">Tambah Job</span>
        <form action="../../model/tjob.php" method="POST" class="mt-3">
            <label for="nama_so" class="font-bold text-gray-500 text-sm mb-2 block">SO</label>
            <select name="id_so" id="nama_so" class="mb-3 border w-full rounded py-2 px-3 leading-tight focus:outline-none focus:shadow-outline bg-white">
                <?php
                echo "<option>Pilih SO</option>";
                while($hasil = $so -> fetch_assoc()){ 
                echo "<option value=".$hasil['id_so'].">";
                echo $hasil['so'];
                echo "</option>";
                }

                ?>
            </select>
            <label for="nama_j" class="font-bold text-gray-500 text-sm mb-2 block">Nama Jobdesk</label>
            <input type="text" name="job" id="nama_j" class="mb-3 appearance-none border w-full rounded py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            <label for="nama_p" class="font-bold text-gray-500 text-sm mb-2 block">Nama Perusahaan</label>
            <input type="text" name="perusahaan" id="nama_p" class="mb-3 appearance-none border w-full rounded py-2 px-3 leading-tight focus:outline-none focus:shadow-outline">
            <label for="mensetsu" class="font-bold text-gray-500 text-sm mb-2 block">Tanggal</label>
            <input type="date" name="tgl_job" id="mensetsu" class="bg-gray-50 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-default">
            <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-bold rounded-lg text-sm px-5 py-2.5 me-2 mt-3 w-full">KIRIM</button>
        </form>
    </div>
</body>
</html>