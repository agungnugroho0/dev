<?php
include __DIR__."../../config/koneksi.php";
$nama = $_GET['cari'];
    if ($nama > 0){
        $siswa = "SELECT nis,nama,kelas FROM siswa INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas WHERE nama LIKE '%$nama%'";

        $query = mysqli_query($konek, $siswa);
        echo "<center>";
        // echo "<table style='margin-top: 5px;border-spacing: 30px;'>";
        while ($data = mysqli_fetch_assoc($query)) { ?>
            <div style="display: block; padding: 5px; margin-top:2px;">
                <?php echo $data['nama'] ." |";?>
                <?php echo $data['kelas']." |";?>
                <a href="./../model/absen.php?nis=<?php echo $data['nis']; ?>" style="color:red"> absen</a>
            </div>
            <!-- echo $data['nis']; -->
            <!-- echo $data['nama'];  -->
            <!-- echo $data['kelas']."<br>";  -->
            <?php
        }
        
    }
?>