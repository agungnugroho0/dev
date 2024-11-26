<?php
require_once '../config/koneksi.php';
require '../config/admin.php';

$id_job = $_GET['id_job'];
$query ="DELETE FROM job WHERE id_job = '$id_job'";

if ($konek->query($query) === TRUE) {
    header("Location: ../admin/wawancara.php?status=hapus");
    exit;
} else {
    echo "Error: " . $query . "<br>" . $konek->error;
}
?>