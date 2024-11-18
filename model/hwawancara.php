<?php
require_once '../config/koneksi.php';
require '../config/admin.php';

$id_w = $_GET['id_w'];

$query = "DELETE from wawancara WHERE id_w= $id_w ";
if ($konek->query($query) === TRUE) {
    header("Location: ../admin/wawancara.php?status=hapus");
    exit;
} else {
    echo "Error: " . $query . "<br>" . $konek->error;
}
