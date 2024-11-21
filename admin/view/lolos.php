<?php
$lolos = $konek -> query("SELECT  log_lolos.*,lolos.nama FROM log_lolos JOIN lolos ON log_lolos.nis = lolos.nis "); ?>
<table class="w-full text-sm text-left mt-5">
<thead class="text-md text-gray-700 uppercase bg-gray-100">
<tr>
    <th scope="col" class="px-6 py-3">No</th>   
    <th scope="col" class="px-6 py-3">Nama</th>
    <th scope="col" class="px-6 py-3">Tanggal lolos</th>  
    <th scope="col" class="px-6 py-3">Job</th>    
    <th scope="col" class="px-6 py-3">SO</th>
    <th scope="col" class="px-6 py-3"></th>
</tr>    
</thead>
<tbody>
    <?php 
    $no = 1;
    while ($lolos2 = $lolos -> fetch_assoc()) { 
    ?>
        <tr class="bg-white border-b hover:bg-gray-50 cursor-default">
            <td class="px-6 py-2"><?= $no++; ?></td>
            <td class="px-6 py-2"><?= $lolos2['nama']?></td>
            <td class="px-6 py-2"><?= $lolos2['tgl_lolos'] ?></td>
            <td class="px-6 py-2"><?= $lolos2['job'] ?></td>
            <td class="px-6 py-2"><?= $lolos2['so'] ?></td>
            <td class="px-6 py-2"><a href="../features/detail_siswa.php?nis=<?=$lolos2['nis']?>">Detail</a></td>
        </tr>
        <?php
        }
        ?>
</tbody>
</table>
