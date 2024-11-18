<?php
include __DIR__."../../config/koneksi.php";

// tangkap post
$nis = $_POST['nis'];
$metode = $_POST['metode'];

// buat tgl
$tgl = date('Y-m-d');

// percabangan scan dan manual
if (isset($_POST['type'])){
    // pilih siswa dan kelas berdasarkan nis
    $siswa = "SELECT nis,nama,kelas FROM siswa INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas WHERE nis LIKE '%$nis%'";
    $query = mysqli_query($konek, $siswa);
    while ($data = mysqli_fetch_assoc($query)) { 
        $nama = $data['nama'];
    }
    $ket    = 'H';
} else {
    $nama = $_POST['nama'];
    $ket    = $_POST['ket'];
    
};

//cek absen
$cek = mysqli_query($konek, "SELECT 1 FROM absen WHERE nis = '$nis' AND tgl = '$tgl' LIMIT 1");
if (mysqli_num_rows($cek) > 0){
    if ($metode == "manual"){
        header("Location: ../guru/scanner.php?absensi=sudah");
        exit;
    } else if ($metode == "otomatis"){
        echo "Siswa sudah absen hari ini";
        exit;
    };
} else {
    // buat id_absen
    $id_absen = mysqli_query($konek,"SELECT MAX(id_absen) AS id FROM absen");
    $id_absen = mysqli_fetch_assoc($id_absen);
    $absen = $id_absen['id'] + 1;
    // masukkan data ke absen
    $absensi = "INSERT INTO absen (id_absen,nis,nama,tgl,ket) VALUE ('$absen','$nis','$nama','$tgl','$ket')";
    $result = mysqli_query($konek, $absensi);
    // cabang penentuan halaman setelah aksi
    if ($metode == "manual"){
        header("Location: ../guru/scanner.php?status=sudah");
        exit;
    } else if ($metode == "otomatis"){
        echo "Absensi sudah masuk";
        exit;
    };

}

?>