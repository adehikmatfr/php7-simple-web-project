<?php
session_start();
require 'vendor/autoload.php';
require 'sql/index.php';
require "phpqrcode/qrlib.php";
$string="SELECT * FROM users WHERE level='1'";
$tampil=tampil($string);
$username=md5($tampil[0]['username']);
$lev=md5($tampil[0]['level']);
// cek dulu cookies nya

if(isset($_COOKIE['72d4b2a056788e501159c1671c272d74'])){
   if($_COOKIE['72d4b2a056788e501159c1671c272d74']!=$lev){
	echo"
	<script>
	document.location.href='login.php';
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
 document.location.href='login.php';
 </script> 
  ";
}

if($_SESSION['user']!==$username && $_SESSION['level']!==$lev){
	echo"
	<script>
	alert('Bade ngehack nya?');
	document.location.href='hack.php';
	</script> 
	 ";
}

if(isset($_POST['nik'])){
 $nik=$_POST['nik'];
 $q="SELECT * FROM anggota,jabatan WHERE jabatan.id_jabatan=anggota.id_jabatan and id_anggota='$nik'";
}
if(isset($_GET['nik'])==md5('all')){
$q="SELECT * FROM anggota,jabatan where jabatan.id_jabatan=anggota.id_jabatan";
}

  $rss=tampil($q);
  
//qr code

  
foreach($rss as $w){
    $id=$w['id_anggota'];
    $nama=$w['nama'];
    $nik=$w['nik'];
    $ttl=$w['ttl'];
    $jk=$w['jk'];
    $alamat=$w['alamat'];
    $token=$w['token'];
    $str ="NIK : $nik\nID Anggota : $id\nNama : $nama\nTTL: $ttl\nJenis Kelamin : $jk\nAlamat : $alamat\nToken : $token";
    // var_dump($str);die;
    $nv=$nama.$id.'.png';
    $q='H';
    $u=3;
    $p=3;
    QRCode::png($str,"qr/anggota/".$nv,$q,$u,$p);
    $file="qr/anggota/".$nv;
    // var_dump($file);die;
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
     $logo_qr_width = $QR_width/3;
     $scale = $logo_width/$logo_qr_width;
     $logo_qr_height = $logo_height/$scale;
     imagecopyresampled($QR, $logo, $QR_width/3, $QR_height/3.2, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
     // Simpan kode QR lagi, dengan logo di atasnya
     imagepng($QR,$file);
 
 }


 $html='
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">
.tab1 {
    font-family: sans-serif;
    color: #232323;
    border-collapse: collapse;
}
div{
    max-width:300px;
}
.tab1, th, td {
    border: 0px solid #999;
    padding: 8px 20px;
}
.tab2 {
    font-family: sans-serif;
    color: #232323;
    border-collapse: collapse;
    border:0px solid black;
}
 
.tab2 .td {
    border: 0px solid #999;
    padding: 8px 20px;
}
  </style>
</head>
<body>
<center><h3 style="">Kartu Anggota KTH Bina Lestari</h3></center>';
if(!empty($q)){
    foreach($rss as $r){
$html.='
<div>
<table class="tab2" width:320px>
<tr>
                   <td class="td">ID Anggota</td>
                   <td class="td"> : '.$r["id_anggota"].'</td>
</tr>
<tr>                   
                   <td class="td">Nama </td>
                   <td class="td"> : '.$r["nama"].'</td>                
</tr>
<tr>
                   <td class="td" height="20px">Tempat Tgl Lahir </td>
                   <td class="td"> : '.$r["ttl"].'</td>
                   <td class="td" rowspan="5">.<img src="qr/anggota/'.$r["nama"].$r["id_anggota"].'.png" style="max-width:150px"></td>
</tr>
<tr>
                   <td class="td" height="20px">Jenis Kelamin </td>
                   <td class="td"> : '.$r["jk"].'</td>
</tr>
<tr>
                   <td class="td" >Alamat </td>
                   <td class="td"> : '.$r["alamat"].'</td>

</tr>
<tr>
                   <td class="td">Jabatan </td>
                   <td class="td"> : '.$r["nama_jabatan"].'</td>                   
</tr>
<tr>
                   <td class="td">Code Token</td>
                   <td class="td"> : '.$r["token"].'</td>
</tr>

';
$html.='</table> </div><br><br><br><br>';
    }
}
$html.='</body></html>';




 $mpdf=new \Mpdf\Mpdf();
 $mpdf->WriteHTML($html);
 $mpdf->Output();