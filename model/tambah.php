<?php

require "../config/koneksi.php";

// memecah tanggal
$awalannis = implode(explode('-', date('Y-m-d')));

// pembuatan nis
$query = "SELECT MAX(nis) AS nis FROM siswa WHERE nis LIKE '$awalannis%'";
$result = $konek->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    if ($row['nis'] !== null) { // Cek jika ada NIS yang ditemukan
        $nis_baru = $awalannis . str_pad(intval(substr($row['nis'], -3) + 1), 3, '0', STR_PAD_LEFT);
    } else {
        $nis_baru = $awalannis . "001";
    }
}

// Ambil data dari form
$id_kelas = "4";
$nis = $nis_baru;
$nama = strtoupper(string: $_POST['nama_lengkap']);

// Validasi apakah nama sudah ada di database
$query_check = "SELECT COUNT(*) AS count FROM siswa WHERE nama = '$nama'";
$result_check = $konek->query($query_check);
$row_check = $result_check->fetch_assoc();
if ($row_check['count'] > 0) {
    header("Location: ../siswa.php?nama=$nama");
} else {
    $panggilan = strtoupper($_POST['nama_panggilan']);
    $gender = strtoupper($_POST['gender']);
    $tempat_lahir = strtoupper($_POST['tempat_lahir']);
    $tgl_lahir = $_POST['tgl_lahir'];
    $wa = $_POST['wa'];
    $no_rumah = $_POST['no_rumah'];
    $agama = strtoupper($_POST['agama']);
    $provinsi = $_POST['provinsi'];
    $kabupaten = $_POST['kabupaten'];
    $kecamatan = $_POST['kecamatan'];
    $kelurahan = $_POST['kelurahan'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $status = "";
    $darah = "";
    $bb = "";
    $tb = "";
    $merokok = "";
    $alkohol = "";
    $tangan = "";
    $hobi = "";
    $tujuan = "";
    $kelebihan = "";
    $kekurangan = "";

    $ekstensi_diperbolehkan    = array('png', 'jpg', 'jpeg');
    $foto = $_FILES['file']['name'];
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran    = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 2048000) { //1MB
            move_uploaded_file($file_tmp, 'uploads/' . $foto);
        }
    }

    $query_insert = "INSERT INTO siswa (id_kelas, nis, nama, panggilan, gender, tempat_lhr, tgl, wa, no_rumah, agama, provinsi, kabupaten, kecamatan, kelurahan, rt, rw, status, darah, bb, tb, merokok, alkohol, tangan, hobi, tujuan, kelebihan, kekurangan, foto) 
     VALUES ('$id_kelas', '$nis', '$nama', '$panggilan', '$gender', '$tempat_lahir', '$tgl_lahir', '$wa', '$no_rumah', '$agama', '$provinsi', '$kabupaten', '$kecamatan', '$kelurahan', '$rt', '$rw', '$status', '$darah', '$bb', '$tb', '$merokok', '$alkohol', '$tangan', '$hobi', '$tujuan', '$kelebihan', '$kekurangan', '$foto')";

    // Menjalankan query
    if ($konek->query($query_insert) === TRUE) {
        header("Location: ../siswa.php?sukses");
    } else {
        echo "Error: " . $query_insert . "<br>" . $konek->error;
    }
}
