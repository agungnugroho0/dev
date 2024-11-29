<div class="flex mb-3 p-3 flex-col md:flex-row">
        <form action="" method="GET" class="w-full md:max-w-96">
            <label for="cari" class="mb-1 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
            </div>
            <input type="text" id="cari" class="block w-full p-4 ps-10 text-sm text-gray-900 rounded-lg bg-slate-50 active:ring-0" placeholder="Cari Siswa" name="">
        </div>
        </form>
        <div id="muncul" class="mx-2 p-3 md:-translate-y-2 relative">
            
            </div>
    </div>
        <!-- search -->
        
        <!-- ///////////////siswa////////////// -->
    <div class="bg-slate-50 grid grid-cols-1 lg:grid-cols-4 ">
        <?php
            $kelas = $konek ->query("SELECT * FROM kelas");
            $data_kelas_array = [];
            while($data_kelas = $kelas ->fetch_assoc()) {
                $data_kelas_array[] = $data_kelas;?>
                <div class="bg-white shadow-md p-3 m-3 rounded-lg">
                    <div class="flex">
                        <p class="font-bold">KELAS <?= $data_kelas['kelas']?></p>
                        <a href="../siswa.php?id_kelas=<?= $data_kelas['id_kelas']?>" class="">
                        <img src="../image/add.png" alt="" class="w-4 h-4 translate-y-1 ml-2">
                        <!-- <p class="text-white font-bold translate-x-1.5 -translate-y-1">+</p> -->
                        </a>
                    </div>
                    <hr>
                    <p><?php  $wali = $konek ->query("SELECT nama FROM staff WHERE id_kelas = $data_kelas[id_kelas]") ->fetch_assoc(); if($wali){echo "Wali : ".$wali['nama'];}else {echo "";} ?></p>
                    <hr>
                    <?php 
                    $siswa = $konek ->query("SELECT siswa.nis, siswa.nama,siswa.foto, siswa.wa,wawancara.id_job FROM siswa LEFT JOIN wawancara ON siswa.nis = wawancara.nis WHERE id_kelas = $data_kelas[id_kelas] ORDER BY gender,nama");
                    $nomorUrut = 1;
                    while($siswa1 =  $siswa ->fetch_assoc()) {
                        echo "<a href='../features/detail_siswa.php?nis=$siswa1[nis]' class='cursor-default '>";
                        echo "<div class='flex hover:bg-slate-50 active:scale-95 py-0.5 transition'>";
                        
                        if ($siswa1['id_job'] !== null){
                            echo  "<div class='bg-green-800 w-1 mr-1'>&nbsp;</div>";
                        } else {
                            echo  "<div class='bg-white w-1 mr-1'>&nbsp;</div>";
                        } 
                        echo "<p class='self-center mr-2'>".$nomorUrut ."</p>";
                        ?>
                        <!-- <div class="bg-contain bg-center bg-no-repeat w-8 h-8 rounded-full" style="background-image:url(../model/uploads/);" alt="siswa"></div> -->
                        <p class="self-center"><?=$siswa1['nama']?></p>
                        </div>
                        </a>
                    <?php 
                    $nomorUrut++;
                    }
                    ?>
                </div>
 <!-- ///////////////siswa////////////// -->
            <?php } ?>
        
        <div class="bg-white shadow-md p-3 m-3 rounded-lg">
            <div class="flex">
                <p>Daftar Kelas</p>
                <a href="#" >
                <img src="../image/add.png" alt="" class="w-4 h-4 translate-y-1 ml-2">
                </a>
            </div>
            <?php
             foreach ($data_kelas_array as $data_kelas) { ?>
                <div class="flex h-8 mt-2 hover:bg-slate-50 p-2 *:self-center">
                    <p class="grow "><?=$data_kelas['kelas']?></p>
                    <a href="#" class=""><img src="../image/pensil.png" class="w-5"></a>
                    <a href="#" class=" rounded-full overflow-hidden ml-2"><img src="../image/sampah.png" class="w-5"></a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>