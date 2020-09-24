<?php
session_start();
require "sql/index.php";
require "validasi/index.php";
require 'vendor/autoload.php';

$string="SELECT * FROM users WHERE level='2'";
$tampil=tampil($string);
$username=md5($tampil[0]['username']);
$lev=md5($tampil[0]['level']);
// cek dulu cookies nya

if(isset($_COOKIE['72d4b2a056788e501159c1671c272d74'])){
   if($_COOKIE['72d4b2a056788e501159c1671c272d74']!=$lev){
	echo"
	<script>
	document.location.href='../login.php';
	</script> 
	 ";
   }else{
	$_SESSION['user']=$username;
	$_SESSION['level']=$lev;
   }
}
// cari user oprator
if(!$_SESSION){
  echo"
 <script>
 alert('Punten Anjen Kedah Login Hela!');
 document.location.href='../login.php';
 </script> 
  ";
}

if($_SESSION['user']!==$username && $_SESSION['level']!==$lev){
	echo"
	<script>
	alert('Bade ngehack nya?');
	document.location.href='../hack.php';
	</script> 
	 ";
}

require "phpqrcode/qrlib.php";
if(isset($_GET['id_u'])&&isset($_GET['id_s'])){
$iu=$_GET['id_u'];
$is=$_GET['id_s'];
$idu=base64_decode($iu);
$ids=base64_decode($is);
$nama=tampil("SELECT nama FROM anggota Where id_anggota='$idu'");
$nama=$nama[0]['nama'];
$stup=tampil("SELECT code_stup FROM stup Where id_stup='$ids'");
$stup=$stup[0]['code_stup'];
$str ="http://binalestari.rf.gd/pemeliharaan/index.php?u=$iu&s=$is";
//var_dump($str);die;
$nv=$nama."-".$stup.'.png';
$q='H';
$u=5;
$p=3;
QRCode::png($str,"qr/".$nv,$q,$u,$p);
$file="qr/".$nv;
 // ambil file qrcode
 $QR = imagecreatefrompng($file);
 // memulai menggambar logo dalam file qrcode
 $logopath="img/jbr.png";
 $logo = imagecreatefromstring(file_get_contents($logopath));
 
 imagecolortransparent($logo , imagecolorallocatealpha($logo , 0, 0, 0, 127));
 imagealphablending($logo , false);
 imagesavealpha($logo , true);
 $QR_width = imagesx($QR);
 $QR_height = imagesy($QR);
 $logo_width = imagesx($logo);
 $logo_height = imagesy($logo);
 // Scale logo tofit inthe QR Code
 $logo_qr_width = $QR_width/2.5;
 $scale = $logo_width/$logo_qr_width;
 $logo_qr_height = $logo_height/$scale;
 imagecopyresampled($QR, $logo, $QR_width/3.5, $QR_height/3.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
 // Simpan kode QR lagi, dengan logo di atasnya
 imagepng($QR,$file);

// buat pitur download

if(file_exists($file)){
   
  header("Cache-Control: public");
  header("Content-Description: File Transfer");
  header("Content-Disposition: attachment; filename=".$nv);
  header("Content-Type: application/octet-stream;");
   header("Content-Transfer-Encoding: binary");
  readfile($file);
  unlink($file);
}else{
    echo "<h1>Access forbidden!</h1>";
}


}

// post
if(isset($_POST['unduh'])){
   $qr=$_POST['qr'];
     if($qr=="*"){
     $query="SELECT * FROM stup,anggota Where anggota.id_anggota=stup.id_anggota order by stup.code_stup ASC";
     $rss=tampil($query);
     }else{
        $query="SELECT * FROM stup,anggota WHERE anggota.id_anggota=stup.id_anggota and anggota.id_anggota='$qr'";
        $rss=tampil($query);
     }
  
foreach($rss as $r){
   $iu=base64_encode($r['id_anggota']);
   $is=base64_encode($r['id_stup']);
   $nama=$r['nama'];
   $stup=$r['code_stup'];
   $str ="http://binalestari.rf.gd/pemeliharaan/index.php?u=$iu&s=$is";
   // var_dump($str);die;
   $nv=$nama.$stup.'.png';
   $q='H';
   $u=5;
   $p=3;
   QRCode::png($str,"qr/".$nv,$q,$u,$p);
   $file="qr/".$nv;
    // ambil file qrcode
    $QR = imagecreatefrompng($file);
    // memulai menggambar logo dalam file qrcode
    $logopath="img/jbr.png";
    $logo = imagecreatefromstring(file_get_contents($logopath));
    
    imagecolortransparent($logo , imagecolorallocatealpha($logo , 0, 0, 0, 127));
    imagealphablending($logo , false);
    imagesavealpha($logo , true);
    $QR_width = imagesx($QR);
    $QR_height = imagesy($QR);
    $logo_width = imagesx($logo);
    $logo_height = imagesy($logo);
    // Scale logo tofit inthe QR Code
    $logo_qr_width = $QR_width/2.5;
    $scale = $logo_width/$logo_qr_width;
    $logo_qr_height = $logo_height/$scale;
    imagecopyresampled($QR, $logo, $QR_width/3.5, $QR_height/3.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
    // Simpan kode QR lagi, dengan logo di atasnya
    imagepng($QR,$file);
   
   // buat pitur download
      
   //   header("Cache-Control: public");
   //   header("Content-Description: File Transfer");
   //   header("Content-Disposition: attachment; filename=".$nv);
   //   header("Content-Type: application/octet-stream;");
   //    header("Content-Transfer-Encoding: binary");
   //   readfile($file);
   //   unlink($file);

}


$html='
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">
  </style>
</head>
<body>
<div style="margin-left:10px;float:left;">
';
foreach($rss as $s){
   $img=$s['nama'].$s['code_stup'];
$html.='
<img src="qr/'.$img.'.png">
<font style="display:inline-block;margin-left:-200px">'.$s["code_stup"].'
</font>
';
}
$html.='
</div>
</body>
</html>
';
   
 $mpdf=new \Mpdf\Mpdf();
 $mpdf->WriteHTML($html);
 $mpdf->Output();
   }

  
  