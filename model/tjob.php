<?php
require_once '../config/koneksi.php';
require '../config/admin.php';

$id_awal = $konek ->query("SELECT max(id_job) as jobs FROM job");
$rowjob = $id_awal->fetch_assoc();

$id_akhir = $rowjob['jobs'] + 1;
$id_so = $_POST['id_so'];
$job = $_POST['job'];
$perusahaan = $_POST['perusahaan'];
$tgl_job = $_POST['tgl_job'];

$query = "INSERT INTO job (id_job,  job, perusahaan,id_so, tgl_job) VALUES ('$id_akhir',  '$job', '$perusahaan','$id_so', '$tgl_job')";

if ($konek->query($query) === TRUE) {
    header("Location: ../admin/wawancara.php?status=sudah");
    exit;
} else {
    echo "Error: " . $query . "<br>" . $konek->error;
}
?>