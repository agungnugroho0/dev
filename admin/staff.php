<?php
require_once '../config/koneksi.php';
require '../config/admin.php';

$staff = $konek ->query('SELECT staff.*,kelas.* FROM staff LEFT JOIN kelas ON staff.id_kelas = kelas.id_kelas');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <?php include 'menu.html'; ?>
    <div class="p-3 bg-slate-50">
        <div class="relative bg-white rounded-lg p-3 overflow-auto">
            <div class="flex mb-2">
                <p class="font-bold text-slate-800 self-center">STAFF </p>
                <a class="ml-2 w-10 rounded-full bg-red-800 hover:bg-red-700 active:scale-90 transition cursor-default" href="#">
                        <p class="font-bold translate-x-3.5 -translate-y-0.5 text-lg text-white">+</p>
                </a>
            </div>
            <table class="w-full text-sm text-left table-auto">
                <tr >
                    <th>&nbsp;</th>
                    <th>Nama</th>
                    <th>&nbsp;</th>
                    <th>Level</th>
                    <th>Kelas</th>
                    <th class="pl-2">Aksi</th>
                    <th>&nbsp;</th>
                </tr>
            <?php
                while($staff_hasil = $staff->fetch_assoc()) {
                echo "<tr class='hover:bg-slate-100 odd:bg-slate-50 py-2'>";
                if ($staff_hasil['foto']== null ){
                    echo '<td class="py-2 md:min-w-3 lg:max-w-4"><img class="max-w-8 rounded-full mr-2" src="../image/app.png" /></td>';
                } else {
                    echo '<td class="py-2 md:min-w-3 lg:max-w-4"><img class="max-w-8 rounded-full mr-2" src="../model/uploads/'.$staff_hasil['foto'].'" /></td>';
                }
                echo '<td class="text-sm font-medium text-slate-800 self-center pr-3 hover:font-bold hover:translate-x-2 transition">'.$staff_hasil['nama'].'</td>';

                $nomor_asli = $staff_hasil['no'];
                $nomor_baru = preg_replace('/^0/', '+62', $nomor_asli);
                echo '<td class=" font-medium text-white self-center pr-3 "><a href="https://wa.me/'.$nomor_baru.'" class="bg-green-900 px-3 py-1 rounded-full ">Whatsapp</a></td>';

                echo '<td class="text-sm font-medium text-slate-800 self-center pr-3">'.$staff_hasil['level'].'</td>';
                echo '<td class="text-sm font-medium text-slate-800 self-center pr-3">'.$staff_hasil['kelas'].'</td>';
                echo '<td class="w-10 active:scale-90 transition pr-3 pl-2"><a href="" class="cursor-default"><img src="../image/pensil.png" class="w-6"></a></td>';
                echo '<td class="w-10 active:scale-90 transition pr-3 pl-2"><a href="" class="cursor-default"><img src="../image/sampah.png" class="min-w-6 max-w-6"></a></td>';
                echo "</tr>";
                
            }
            ?>
            </table>
        </div>  
        
    </div>
</body>
</html>