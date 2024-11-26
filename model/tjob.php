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

// Mencari nomor urut terakhir yang ada di tabel job
$query = "SELECT MAX(CAST(SUBSTRING(id_job, LENGTH('$id_job') + 1) AS UNSIGNED)) AS nomor_urut FROM job WHERE id_job LIKE '$id_job%'";
$result = mysqli_query($konek, $query);
$row = mysqli_fetch_assoc($result);
$nomor_urut = isset($row['nomor_urut']) ? $row['nomor_urut'] + 1 : 1;
// Membuat id_job baru dengan nomor urut
$id_job_baru = $id_job . $nomor_urut;
// Query untuk memasukkan data ke dalam tabel job
$query_insert = "INSERT INTO job (id_job, id_so, job, perusahaan, tgl_job) VALUES ('$id_job_baru', '$id_so', '$job', '$perusahaan', '$tgl_job')";

if ($konek->query($query_insert) === TRUE) {
    header("Location: ../admin/wawancara.php?status=sudah");
    exit;
} else {
    echo "Error: " . $query . "<br>" . $konek->error;
}
?>