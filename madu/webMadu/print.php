<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require 'sql/index.php';

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

if(!isset($_GET['anggota'])&&!isset($_GET['str'])){
 exit;
}

$nik=base64_decode($_GET['anggota']);
$s="SELECT * FROM anggota,jabatan where jabatan.id_jabatan=anggota.id_jabatan and anggota.id_anggota='$nik'";
$ku=tampil($s);
$tampil=base64_decode($_GET['str']);
$field=tampil($tampil);
// jumlah setup yang di kmiliki
$jmls=cekdb("SELECT * FROM stup WHERE id_anggota='$nik'");
// cari jumlah setup yng di panen
$jml=cekdb($tampil);
// cari karakter *
  $ke=str_replace("*", " ", $tampil);
 
// tentukan jumlah panen
$key=str_replace("SELECT", "SELECT SUM(hasil.jumlah) ", $ke);
$row=tampil($key);

// cari bulan dan tahu setup
$th=str_replace("SELECT", "SELECT panen ", $ke);
$th=tampil($th);
$th=explode('-', $th[0]["panen"]);
$th=$th[2];
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
 
.tab1, th, td {
    border: 1px solid #999;
    padding: 8px 20px;
}
.tab2 {
    font-family: sans-serif;
    color: #232323;
    border-collapse: collapse;
}
 
.tab2 .td {
    border: 0px solid #999;
    padding: 8px 20px;
}
  </style>
</head>
<body>
<center><h3 style="">Laporan Panen KTH Bina Lestari</h3></center>';
if(!empty($nik)){
$html.='
<table class="tab2" cellpadding="5">
<tr>
                   <td class="td">NIK</td>
                   <td class="td"> : '.$ku[0]["nik"].'</td>
</tr>
<tr>
                   <td class="td">ID Anggota</td>
                   <td class="td"> : '.$ku[0]["id_anggota"].'</td>
</tr>
<tr>                   
                   <td class="td">Nama </td>
                   <td class="td"> : '.$ku[0]["nama"].'</td>
</tr>
<tr>
                   <td class="td">Tempat Tgl Lahir </td>
                   <td class="td"> : '.$ku[0]["ttl"].'</td>
</tr>
<tr>
                   <td class="td">Jenis Kelamin </td>
                   <td class="td"> : '.$ku[0]["jk"].'</td>
</tr>
<tr>
                   <td class="td">Alamat </td>
                   <td class="td"> : '.$ku[0]["alamat"].'</td>
</tr>
<tr>
                   <td class="td">Status </td>
                   <td class="td"> : '.$ku[0]["status"].'</td>
</tr>
<tr>
                   <td class="td">Pekrjaan </td>
                   <td class="td"> : '.$ku[0]["pekerjaan"].'</td>
</tr>
<tr>
                   <td class="td">Jumlah Stup yang di Miliki</td>
                   <td class="td"> : '.$jmls.'</td>
</tr>
<tr>
                   <td class="td">Jumlah Stup yang di Panen</td>
                   <td class="td"> : '.$jml.'</td>
</tr>
<tr>
                   <td class="td">Jabatan </td>
                   <td class="td"> : '.$ku[0]["nama_jabatan"].'</td>
</tr>
';
$html.='</table>';
}
  $html.='<center><h3 style="">Data Panen Tahun '.$th.'</h3></center> 
<table class="tab1">
<tr style="">
                   <th>No</th>
                   <th>Code Stup</th>
                   <th>Jenis Lebah</th>
                   <th>Masuk Lebah</th>
                   <th>Panen</th>
                   <th>Hasil Minimum</th>
</tr>';
$a=1;
foreach ($field as $u) {
   $html.='<tr>

                   <td>'.$a.'</td>
                   <td>'.$u["code_stup"].'</td>
                   <td>'.$u["nama_jenis"].'</td>
                   <td>'.date("d-m-Y",$u["lebah_masuk"]).'</td>
                   <td>'.$u["panen"].'</td>
                   <td>'.$u["jumlah"].' Liter</td>

         </tr>';
         $a++;
}
$html.='<tr>
<th colspan="5">Jumlah Hasil Minimum Panen</th>
<td>'.$row[0]["SUM(hasil.jumlah)"].' Liter</td>
</tr>';

$html.='
</table>

</body>
</html>
 ';





 $mpdf=new \Mpdf\Mpdf();
 $mpdf->WriteHTML($html);
 $mpdf->Output();