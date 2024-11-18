<?php  
// Include koneksi database dan library TCPDF
include __DIR__ . "../../config/koneksi.php";
require "tcpdf/tcpdf.php";
    
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Wahyu Agung');
$pdf->SetTitle('TCPDF QRCODE');
$pdf->SetSubject('TCPDF QRCODE');
$pdf->SetKeywords('QRCODE');
    
// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// set some language dependent data:
$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'ltr';
$lg['a_meta_language'] = 'ja';
$lg['w_page'] = 'page';
$pdf->setLanguageArray($lg);
    
// set font
$pdf->SetFont('notoserifjpb', '', 30);

// add a page
$pdf->AddPage();

// kuery data

$nis = $_GET['nis'];
$siswa = "SELECT nama,panggilan FROM siswa WHERE nis = '$nis'";
$data_siswa = mysqli_query($konek, $siswa);
$data = mysqli_fetch_assoc($data_siswa); 
$qr_image = "qr_images/" . $nis . ".png";
if ($data) {
    $nama = $data['nama'];
    $panggilan = $data['panggilan'];
};
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
$pdf->Image('../image/name_tag.jpg', 14.92,11.368,90,55, 'JPG', '', '', false, 150, '', false, false, 0, false, false, false);
$pdf->Image('../image/name_tag2.jpg', 104.92,11.368,90,55,'JPG', '', '', false, 150, '', false, false, 0, false, false, false);
$pdf->Image($qr_image, 80, 41, 20, 20,'PNG', '', '', false, 150, '', false, false, 0, false, false, false); // Lokasi, ukuran QR Code
$pdf->Image($qr_image, 110, 41, 20, 20,'PNG', '', '', false, 150, '', false, false, 0, false, false, false);

// Kolom untuk nama pertama
// $pdf->Cell(90, 0, $panggilan, 0, 0, 'C'); // Nama pertama di tengah


$pdf->SetXY(5, 25); // Set posisi
$pdf->Cell(104, 12, $panggilan, 0, 1,'C'); // Menulis teks

$pdf->SetXY(48, 25); // Set posisi
$pdf->settextColor(255,255,255);
$pdf->Cell(204, 12, $panggilan, 0, 1,'C'); // Menulis teks
// set content print
$html =  <<<EOD

    EOD;
    
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output($nama.'.pdf', 'I');

?>
