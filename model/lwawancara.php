<?php 
require_once '../config/koneksi.php';
require '../config/admin.php';

$nis = filter_input(INPUT_GET, 'nis', FILTER_SANITIZE_NUMBER_INT);

// kebutuhan tagihan
$tagihan = filter_input(INPUT_GET, 'tagihan', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$keterangan = "biaya so";
$tagihan_sekolah = "4000000";
$keterangan_sekolah = "biaya sekolah";
$status_tagihan = "belum lunas";



// kebutuhan lolos
$tgl_lolos = filter_input(INPUT_GET, 'tgl_lolos', FILTER_SANITIZE_STRING);
$lolos = "INSERT INTO lolos SELECT * FROM siswa WHERE nis = ?";
$aktif = "UPDATE keaktifan SET aktifasi = 'lolos' WHERE nis = ?";
$hapus_siswa = "DELETE FROM siswa WHERE nis = ?";
$hapus_wawancara = "DELETE FROM wawancara WHERE nis = ?";
//query lolos untuk ke log_lolos

$konek->begin_transaction();
try{
    //pindah & salin data dari siswa ke lolos dan log_lolos
    $queryPindah = $konek->prepare($lolos);
    $queryPindah->bind_param('i', $nis);
    if (!$queryPindah->execute()) {
        throw new Exception("Gagal memindahkan data ke tabel lolos: " . $queryPindah->error);
    };
     // Membuat ID unik untuk log_lolos
     $awalidloglolos = 'LLS' . str_replace('-', '', date('Y-m-d'));
    $queryidlog = $konek->query("SELECT MAX(id_loglolos) AS lls FROM log_lolos WHERE id_loglolos LIKE '$awalidloglolos%'")->fetch_assoc();
    $id_loglolos = $queryidlog['lls'] !== null 
    ? "LLS" . str_pad(intval(substr($queryidlog['lls'], -3)) + 1, 3, '0', STR_PAD_LEFT) 
    : $awalidloglolos . "001";
    // Ambil data dari tabel job
    $jobQuery = $konek->prepare("SELECT so.so, job.job, job.perusahaan,wawancara.nis FROM job JOIN so ON job.id_so = so.id_so JOIN wawancara ON job.id_job = wawancara.id_job WHERE wawancara.nis = ?");
    $jobQuery->bind_param('i', $nis);    
    $jobQuery->execute();
    $jobResult = $jobQuery->get_result();
    if ($jobResult->num_rows === 0) {
        throw new Exception("Data job untuk NIS $nis tidak ditemukan.");
    }
    $jobData = $jobResult->fetch_assoc();
    $so = $jobData['so'];
    $job = $jobData['job'];
    $perusahaan = $jobData['perusahaan'];
    // Insert data ke tabel log_lolos
    $insertLogLolos = $konek->prepare("INSERT INTO log_lolos (id_loglolos, nis, tgl_lolos, so, job, perusahaan) VALUES (?, ?, ?, ?, ?, ?)");
    $insertLogLolos->bind_param('sissss', $id_loglolos, $nis, $tgl_lolos, $so, $job, $perusahaan);    
    if (!$insertLogLolos->execute()) {
        throw new Exception("Gagal memasukkan data ke tabel log_lolos: " . $insertLogLolos->error);
    }



    // tagihan so
    $awalidtagihan = str_replace('-', '', date('Y-m-d'));
    $queryid = $konek->query("SELECT MAX(id_tagihan) AS tgh FROM tagihan WHERE id_tagihan LIKE '$awalidtagihan%'")->fetch_assoc();
    $id_baru = $queryid['tgh'] !== null 
    ? "T" . $awalidtagihan . str_pad(intval(substr($queryid['tgh'], -3)) + 1, 3, '0', STR_PAD_LEFT) 
    : "T" . $awalidtagihan . "001";
    $insertTagihan1 = $konek->prepare("INSERT INTO tagihan (id_tagihan, nis, keterangan, biaya, status_tagihan) VALUES (?, ?, ?, ?, ?)");
    $insertTagihan1->bind_param('sisds', $id_baru, $nis, $keterangan, $tagihan, $status_tagihan);
    if (!$insertTagihan1->execute()) {
        throw new Exception("Gagal memasukkan data tagihan pertama: " . $insertTagihan1->error);
    }
    // tagihan hikari
    $awalidtagihan = str_replace('-', '', date('Y-m-d'));
    $queryid = $konek->query("SELECT MAX(id_tagihan) AS tgh FROM tagihan WHERE id_tagihan LIKE '$awalidtagihan%'")->fetch_assoc();
    $id_baru2 = $queryid['tgh'] !== null 
    ? "T" . $awalidtagihan . str_pad(intval(substr($row['tgh'], -3) + 1), 3, '0', STR_PAD_LEFT) 
    : "T" . $awalidtagihan . "002";
    $insertTagihan2 = $konek->prepare("INSERT INTO tagihan (id_tagihan, nis, keterangan, biaya, status_tagihan) VALUES (?, ?, ?, ?, ?)");
    $insertTagihan2->bind_param('sisds', $id_baru2, $nis, $keterangan_sekolah, $tagihan_sekolah, $status_tagihan);
    if (!$insertTagihan2->execute()) {
        throw new Exception("Gagal memasukkan data tagihan kedua: " . $insertTagihan2->error);
    }

    
    // update aktifasi
    $aktifasi = $konek ->prepare("$aktif");
    $aktifasi->bind_param('i',$nis);
    if (!$aktifasi->execute()) {
        throw new Exception("Gagal mengupdate aktifasi: " . $aktifasi->error);
    };  
    
    
    // hapus siswa
    $hapus_siswa2 = $konek ->prepare("$hapus_siswa");
    $hapus_siswa2->bind_param('i',$nis);
    if (!$hapus_siswa2->execute()) {
        throw new Exception("Gagal menghapus siswa: " . $hapus_siswa2->error);
    };  


    // hapus wawancara
    $hapus_wawancara2 = $konek ->prepare("$hapus_wawancara");
    $hapus_wawancara2->bind_param('i',$nis);
    if (!$hapus_wawancara2->execute()) {
        throw new Exception("Gagal menghapus tabel wawancara: " . $hapus_wawancara2->error);
    };  

    $konek->commit();
    header ("Location: ../admin/wawancara.php?status=sukses");
    exit;
} catch (Exception $e) {
    // Rollback jika ada error
    $konek->rollback();
    $message = urlencode("Error: " . $e->getMessage());
    header("Location: ../admin/wawancara.php?error=$message");
    exit;
}finally {
    // Menutup statement dan koneksi
    if (isset($queryPindah)) $queryPindah->close();
    if (isset($insertLogLolos)) $insertLogLolos->close();
    if (isset($insertTagihan1)) $insertTagihan1->close();
    if (isset($insertTagihan2)) $insertTagihan2->close();
    if (isset($aktifasi)) $aktifasi->close();
    if (isset($hapus_siswa2)) $hapus_siswa2->close();
    if (isset($hapus_wawancara2)) $hapus_wawancara2->close();
}
?>