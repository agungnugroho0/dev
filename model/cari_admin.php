<?php
include __DIR__."../../config/koneksi.php";
$nama = $_GET['cari'];
if ($nama > 0){
    $query = $konek -> query("SELECT nis,nama,kelas,foto FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id_kelas WHERE nama LIKE '%$nama%'");
    echo "<div class='hasil-pencarian z-10'>";
    if ($query->num_rows >0){
        while ($siswa = $query ->fetch_assoc()){?>
        <a href="../features/detail_siswa.php?nis=<?=$siswa['nis'] ?>" class="relative group flex p-1 max-w-full cursor-default rounded-lg hover:bg-slate-50 active:scale-95 ">
                    <div class="bg-contain bg-center bg-no-repeat w-8 h-8 rounded-full" style="background-image:url(../model/uploads/<?=$siswa['foto'] ?>);" alt="siswa"></div>
                    <p class="self-center font-medium text-slate-800 group-hover:text-red-900 group-hover:font-bold pl-2 transition "><?=$siswa['nama'] ?></p>
        </a>
    <?php } } else {
        echo '<p class="self-center font-medium text-slate-800 transition translate-y-2">Siswa tidak ada</p>';
    }
    echo "</div>";
}
?>