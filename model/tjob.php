<?php
require_once '../config/koneksi.php';
require '../config/admin.php';

$bulan = date('m');
$tanggal = date('d');
$id_job = 'J' . $bulan . $tanggal;

$id_awal = $konek ->query("SELECT max(id_job) as jobs FROM job");
$rowjob = $id_awal->fetch_assoc();
$no_urut = isset($rowjob['jobs']) ? intval(substr($rowjob['jobs'], -1)) + 1 : 1;
$id_jobakhir =$id_job.$no_urut;

$id_so = $_POST['id_so'];
$job = $_POST['job'];
$perusahaan = $_POST['perusahaan'];
$tgl_job = $_POST['tgl_job'];

$query = "INSERT INTO job (id_job,  job, perusahaan,id_so, tgl_job) VALUES ('$id_jobakhir',  '$job', '$perusahaan','$id_so', '$tgl_job')";

if ($konek->query($query) === TRUE) {
    header("Location: ../admin/wawancara.php?status=sudah");
    exit;
} else {
    echo "Error: " . $query . "<br>" . $konek->error;
}
?>