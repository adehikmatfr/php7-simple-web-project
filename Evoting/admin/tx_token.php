<?php
require "../fungsi/function.php";

if(isset($_GET["id"]))
{
   $id=$_GET["id"];
   if($id=="p")
   {
  $q="SELECT * FROM pemilih Where lv='L' and status='Belum Voute'";
  $u="Token Purbasora";
   }else
   {
 $q="SELECT * FROM pemilih Where lv='P' and status='Belum Voute'";
   $u="Token Citra Kirana";
   }

$tm=tampil($q);

echo '<center><h3>'.$u."</h3></center>";
$a=1;
foreach ($tm as $m) {
      echo '<span style="padding-left:40px; padding-right:40px; padding-top:100px">'.$m["token"]."</span>";
      if($a==9||$a==18||$a==27||$a==36||$a==45||$a==54||$a==63||$a==72||$a==81||$a==90||$a==99||$a==108||$a==117||$a==126)
      {
      	echo "<br><br>";
      }
      $a++;
}

}


?>
