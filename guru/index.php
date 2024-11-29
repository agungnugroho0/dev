<?php 
include __DIR__."../../config/koneksi.php";
session_start();
if($_SESSION['level']==""){
    header("location:../index.php?pesan=gagal");
}elseif($_SESSION['level']=="admin"){
    header("location:../index.php?pesan=salah");
};
    $username  = $_SESSION['username'];
    $id_kelas = $_SESSION['kelas'];
    $nama = $_SESSION['nama'];

    $pilihkelas = mysqli_query($konek,"SELECT * from kelas WHERE id_kelas = '$id_kelas'");
    $datakelas = mysqli_fetch_assoc($pilihkelas);
    $kelas = $datakelas["kelas"];
    // $siswa = "SELECT * FROM siswa JOIN kelas ON siswa.id_kelas = kelas.id_kelas WHERE siswa.id_kelas = '$id_kelas' ORDER BY nama";
    $siswa = "SELECT siswa.nis, siswa.nama,siswa.gender,siswa.tgl,wawancara.id_job,kelas.* FROM siswa LEFT JOIN wawancara ON siswa.nis = wawancara.nis JOIN kelas ON siswa.id_kelas = kelas.id_kelas WHERE kelas.id_kelas = '$id_kelas' ORDER BY nama";
    $staff = $konek ->query("SELECT staff.*,kelas.* FROM staff LEFT JOIN kelas ON staff.id_kelas = kelas.id_kelas WHERE staff.username= '$username' ");
    $staff_hasil = $staff->fetch_assoc();


?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
    <?php include 'menu.html' ?>
    <main class="container mx-auto sm:p-5 p-3">
        <p class="text-md text-slate-400">ようこそ</p>
        <div id="judul" class="flex">
            <?php
            if ($staff_hasil['foto']== null ){
                echo '<div class="py-2 "><img class="max-w-12 rounded-full mr-2" src="../image/app.png" /></div>';
            } else {
                echo '<div class="py-2 "><img class="max-w-12 rounded-full mr-2" src="../model/uploads/'.$staff_hasil['foto'].'" /></div>';
            }
            ?>
            <h2 class="font-bold text-xl self-center"><?php echo $nama?> 先生</h2>

        </div>
        <hr>
        <p class="font-bold text-xl pt-3 pb-3">Siswa Kelas <?=$kelas?></p>
        <div class="flex items-center">
            <div class="bg-green-800 w-3 h-3"></div>
            <p class="pl-1 pr-3 text-sm">Mengikuti Job</p>
            <div class="bg-red-800 w-3 h-3"></div>
            <p class="pl-1 pr-3 text-sm">Siswa Cuti</p>
        </div>
        <table class=" w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="">&nbsp;</th>
                    <th class="">&nbsp;</th>
                    <th class="px-3 py-3 font-bold hidden sm:inline-block text-start">NIS</th>
                    <th class="px-3 py-3 font-bold text-start sm:w-96" >NAMA</th>
                    <th class="px-3 py-3 font-bold text-start">GENDER</th>
                    <th class="px-3 py-3 font-bold text-start">UMUR</th>
                    <th class="px-3 py-3 font-bold text-start">&nbsp;</th>
                </tr>
            </thead>
            <tbody class=" divide-y divide-gray-200">
                <?php
                    //siswa
                    $no = 1;
                    $data_siswa = mysqli_query($konek, $siswa);
                    while ($data = mysqli_fetch_assoc($data_siswa)){ ?>
                    <!-- tanda Job -->
                    <tr class="hover:bg-slate-50">
                        <?php 
                        if ($data['id_job']>0){
                            echo "<td class='w-1 bg-green-800'></td>";
                        } else {
                            echo "<td class='w-1'></td>";
                        };

                         ?>
                    <td class="text-start px-3 py-3 max-w-1"><?php echo $no; ?></td>
                    <td class="hidden sm:inline-block text-start pl-5 py-3 text-red-900"><?php echo $data['nis'];?></td>
                    <td class="text-start px-3 py-3 text-wrap sm:text-nowrap"><?php echo $data['nama'];?></td>
                    <td class="text-start px-3 py-3 text-wrap sm:text-nowrap"><?php echo $data['gender'];?></td>
                    <td class="text-start px-3 py-3">
                        <?php
                        $tgl_lahir = new DateTime($data['tgl']);
                        $today = new DateTime();
                        $interval = date_diff($tgl_lahir,$today);
                        echo $interval->y." Th";
                        ?>
                    </td>
                    <td class="text-start px-3 py-3 text-wrap text-red-800 font-bold"><a href="../features/detail_siswa.php?nis=<?php  echo $data['nis'];?>">Detail</a></td>

                    </tr>
                <?php $no++; }; ?>
            </tbody>
        </table>
        ©️ 2024 v 1.2.1
    </main>
    </body>
</html>