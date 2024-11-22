<?php
require_once '../config/koneksi.php';
require '../config/admin.php';

$bulan = date('m');
$tanggal = date('d');
$id_job = 'J' . $bulan . $tanggal;


$id_so = $_POST['id_so'];
$job = $_POST['job'];
$perusahaan = $_POST['perusahaan'];
$tgl_job = $_POST['tgl_job'];

// Cek apakah id_job sudah ada
$check_query = "SELECT COUNT(*) as count FROM job WHERE id_job = '$id_jobakhir'";
$check_result = $konek->query($check_query);
$check_row = $check_result->fetch_assoc();

if ($check_row['count'] > 0) {
    // Jika id_job sudah ada, buat id_job baru
    $no_urut = intval(substr($rowjob['jobs'], -1)) + 1; // Increment nomor urut
    $id_jobakhir = $id_job . $no_urut;
    
    // Cek lagi untuk id_job yang baru
    $check_query = "SELECT COUNT(*) as count FROM job WHERE id_job = '$id_jobakhir'";
    $check_result = $konek->query($check_query);
    $check_row = $check_result->fetch_assoc();
    
    // Jika masih ada duplikasi, teruskan increment
    while ($check_row['count'] > 0) {
        $no_urut++;
        $id_jobakhir = $id_job . $no_urut;
        $check_query = "SELECT COUNT(*) as count FROM job WHERE id_job = '$id_jobakhir'";
        $check_result = $konek->query($check_query);
        $check_row = $check_result->fetch_assoc();
    }
}

// Setelah memastikan id_job unik, lakukan insert
$query = "INSERT INTO job (id_job, job, perusahaan, id_so, tgl_job) VALUES ('$id_jobakhir', '$job', '$perusahaan', '$id_so', '$tgl_job')";

if ($konek->query($query) === TRUE) {
    header("Location: ../admin/wawancara.php?status=sudah");
    exit;
} else {
    echo "Error: " . $query . "<br>" . $konek->error;
}
?>