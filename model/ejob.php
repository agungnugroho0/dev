<?php
require_once '../config/koneksi.php';
require '../config/admin.php';

$id_job = $_POST['id_job'];
$id_so = $_POST['id_so'];
$job = $_POST['job'];
$perusahaan = $_POST['perusahaan'];
$tgl_job = $_POST['tgl_job'];

$query = "UPDATE job SET job = '$job', perusahaan = '$perusahaan', id_so = '$id_so', tgl_job = '$tgl_job' WHERE id_job = '$id_job'";

if ($konek->query($query) === TRUE) {
    header("Location: ../admin/wawancara.php?status=sudah");
    exit;
} else {
    echo "Error: " . $query . "<br>" . $konek->error;
}
?>