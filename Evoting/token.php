<?php
require "../fungsi/function.php";

session_start();

if(!isset($_SESSION["admin"]))
{
    echo"
      <script>
      document.location.href='../index.php';
      </script>
      ";
}

if(isset($_POST["token"]))
{
function random($length = 5)
{
   $str="";
   $char=array_merge(range('A','Z'),range('0','9'));
   $max= count($char)-1;
   $i=0;
   while($i<$length)
   {
    $rand=mt_rand(0,$max);
    $str.=$char[$rand];
    $i++;
   }
   return $str;
}


function GetAry($gn)
{
  $r=[];
  $a=1;
  while ($a<=$gn)
  {
  	$r[]=random();
  	$a++;
  }
  return $r;
}

function Getq($g,$who)
{
	$a=1;
   foreach ($g as $g) {
   	iud("INSERT INTO pemilih Values('','$g','$who','Belum Vote')");
   	$a++;
   }
}

$tk=$_POST["token"];
$gn=$_POST["gander"];
$gt=GetAry($tk);
Getq($gt,$gn);
echo "<script>alert('Data Berhasil Disimpan!');
			document.location.href='../admin/token.php';
			</script>";
}



if($_GET["all"])
{
  $lv=$_GET["lv"];
  iud("delete from pemilih where lv='$lv'");
  echo "<script>alert('Data Berhasil Hapus!');
			document.location.href='../admin/token.php';
			</script>";
}

