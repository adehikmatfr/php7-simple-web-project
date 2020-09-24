<?php
$host="sql213.epizy.com";
$user="epiz_24162122";
$pass="nWSJQKBNMWq4I2N";
$db="epiz_24162122_madu";

// $host="localhost";
// $user="root";
// $pass="";
// $db="lebah_madu";

$con=mysql_connect($host,$user,$pass);
$db=mysql_select_db($db);

// fungsi untuk insetr update dan delete
function iud($key){
	global $con;
$qury=mysql_query($key);
$rss=mysql_affected_rows($con);
return $rss;
}
// fungsi untuk tampil data
function tampil($key){
  $row=[];
  $query=mysql_query($key);
   while($rows=mysql_fetch_assoc($query)){
     $row[]=$rows;
   }
 return $row;
}
// fungsi untuk mengecek data dari database
function cek($t,$f,$i){
  $key="SELECT $f FROM $t WHERE $f='$i'";
  $qury=mysql_query($key);
//   var_dump($qury);die;
  $rss=mysql_num_rows($qury);
   return $rss;
}
// fungsi untuk menghitung row 
function kount($q){
    $query=mysql_query($q);
    $num=count($query);
    return $num;
}
// fungsi untuk mengecek data dari database
function cekdb($q){
  $qury=mysql_query($q);
//   var_dump($qury);die;
  $rss=mysql_num_rows($qury);
   return $rss;
}
