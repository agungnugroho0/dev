<?php 
include __DIR__."../../config/koneksi.php";
session_start();
if($_SESSION['level']==""){
    header("location:../index.php?pesan=gagal");
    exit;
};
    $username  = $_SESSION['username'];
    $level  = $_SESSION['level'];
    $id_kelas = $_SESSION['kelas'];

    $pilihkelas = mysqli_query($konek,"SELECT * from kelas WHERE id_kelas = '$id_kelas'");
    $datakelas = mysqli_fetch_assoc($pilihkelas);
    $kelas = $datakelas["kelas"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="https://cdn.tailwindcss.com"></script>


</head>
<body>
<?php
include __DIR__."../../config/koneksi.php";

$bulan = $_POST['bulan'];
$bln = substr($bulan,-2);
$thn = substr($bulan,0,4);

// buat percabangan admin dan guru
if (isset($_POST['kelas'])){
    // ambil dari input admin
    $kelas = $_POST['kelas'];
} else {
    $kelas = $datakelas["kelas"];
    //ambil dari sesi guru
}

// -----------------------------------------------------------------------

// ambil jumlah hari di bulan $bulan
$jumlah_hari = cal_days_in_month(CAL_GREGORIAN,$bln,$thn);




// query untuk absensi
$query = mysqli_query($konek,"SELECT siswa.nis, siswa.nama, absen.tgl, absen.ket 
    FROM absen 
    INNER JOIN siswa ON absen.nis = siswa.nis 
    INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
    WHERE DATE_FORMAT(absen.tgl, '%Y-%m') = '$bulan' AND kelas.kelas = '$kelas' 
    ORDER BY siswa.nama");
$l_absen = array();
while ($row = mysqli_fetch_assoc($query)) { $l_absen [$row['nis']][$row['nama']][$row['tgl']]=$row['ket']; } // simpan dalam array multi dimensi

echo "<table class='table border-spacing-1 '>";
    echo "<tr class=''>";
    echo "<td class='hidden sm:inline-block text-start px-3 py-3 text-red-900'> NIS </td>";
    echo "<td class='px-3 font-bold text-start'> Nama </td>";
    for ($i =1; $i <= $jumlah_hari; $i++) { echo "<td class= 'px-1 py-1 font-bold text-center'> $i </td>";
    }
    echo "</tr>";

    foreach ($l_absen as $nis => $data) {
        echo "<tr>";
        echo "<td class='hidden sm:inline-block text-start px-3 py-3 text-red border border-slate-200 text-red-900'>$nis</td>";
        $nama = key($data); // Nama siswa diambil dari kunci pertama
        echo "<td class='text-start px-3 py-3 text-wrap sm:text-nowrap border border-slate-200 '>$nama</td>";
        for ($i = 1;$i <= $jumlah_hari; $i++){
            $tanggal = date('Y-m-d',strtotime("$thn-$bln-$i"));
            // Memeriksa apakah ada catatan absen untuk tanggal tersebut
            if (isset($data[$nama][$tanggal])) {
                echo "<td class='text-center border border-slate-200'>{$data[$nama][$tanggal]}</td>";
            } else {
                echo "<td class='border border-slate-200'> </td>";
            }
            
        }
        // var_dump ($data[$tanggal]);
        echo "</tr>";
    }

echo "</table>";
?>
    
</body>
</html>