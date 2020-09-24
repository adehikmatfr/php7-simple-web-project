<?php
session_start();
require "../sql/index.php";

$string="SELECT * FROM users WHERE level='1'";
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
// cari user admin
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


if(isset($_GET['id'])){
$id=$_GET['id'];
$tabel=$_GET['t'];
$fild=$_GET['f'];
$asal=$_GET['a'];
$key="DELETE FROM $tabel WHERE $fild='$id'";
$rss=iud($key);
    if($rss>0){
        echo "<script>
		alert('Data Berhasil Di Hapus');
		document.location.href='$asal';
		</script>";
    }else{
        echo "<script>
		alert('Data Gagal Di Hapus');
		document.location.href='$asal.php';
		</script>";
    }
}