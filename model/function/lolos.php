<?php
function lolos(){
    global $konek,$nis;
    $querylolos = $konek ->query("INSERT INTO lolos SELECT * FROM siswa WHERE nis = $nis");
    if ($querylolos == FALSE) {throw new Exception("Gagal memasukkan data ke tabel lolos".$konek->error);}
}

function log_lolos($nis,$id_awal,$tgl_lolos){
    global $konek, $nis, $id_awal,$tgl_lolos;
    $awalidloglolos = "LLS".$id_awal;
    $queryidlog = $konek->query("SELECT MAX(id_loglolos) AS lls FROM log_lolos WHERE id_loglolos LIKE '$awalidloglolos%'")->fetch_assoc();
    if ($queryidlog['lls'] == null){ 
        $idloglolos = $awalidloglolos."001";
    } else {
        $idloglolos = $awalidloglolos.str_pad(intval(substr($queryidlog['lls'], -3)) + 1, 3, '0', STR_PAD_LEFT);
    }
    $jobQuery = $konek->query("SELECT so.so, job.job, job.perusahaan,wawancara.nis FROM job JOIN so ON job.id_so = so.id_so JOIN wawancara ON job.id_job = wawancara.id_job WHERE wawancara.nis = $nis")->fetch_assoc();
    $so = $jobQuery['so'];
    $job = $jobQuery['job'];
    $perusahaan = $jobQuery['perusahaan'];
    $querylog = $konek->query("INSERT INTO log_lolos (id_loglolos, nis, tgl_lolos, so, job, perusahaan) VALUES ('$idloglolos','$nis','$tgl_lolos','$so','$job','$perusahaan')");
    if ($querylog == FALSE) {throw new Exception("Gagal memasukkan data ke tabel log_lolos: ".$konek->error);}
}
function tagihan($jenis_tagihan,$biaya_tagihan){
    global $konek,$nis,$status_tagihan,$id_awal;
    $awalidtagihan = "T".$id_awal;
    $queryidtagihan = $konek ->query("SELECT max(id_tagihan) AS t FROM tagihan WHERE id_tagihan LIKE '$awalidtagihan%'")->fetch_assoc();
    if ($queryidtagihan['t'] == null){
        $id_tagihan = $awalidtagihan."001";
    } else {
        $id_tagihan = $awalidtagihan.str_pad(intval(substr($queryidtagihan['t'], -3)) + 1, 3, '0', STR_PAD_LEFT);
    }
    $querytagihan = $konek ->query("INSERT INTO tagihan (id_tagihan,jenis_tagihan,biaya_tagihan,nis,status_tagihan) VALUES ('$id_tagihan','$jenis_tagihan','$biaya_tagihan','$nis','$status_tagihan')");
    if ($querytagihan == FALSE) {throw new Exception("Gagal memasukkan data ke tabel tagihan: ".$konek->error);}
}

function hapus ($hapus){
    global $konek,$nis;
    $queryhapus = $konek -> query("DELETE FROM $hapus WHERE nis = '$nis'");
    if ($queryhapus == FALSE) {throw new Exception("Gagal menghapus data ".$konek->error);}
}
?>