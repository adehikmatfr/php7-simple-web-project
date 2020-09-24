<?php

$host="localhost";
$user="root";
$pass="";
$db="bhp_voting";

$con=mysqli_connect($host,$user,$pass,$db);

// fungsi untuk insetr update dan delete
function iud($key)
{
global $con;
$qury=mysqli_query($con,$key);
$rss=mysqli_affected_rows($con);
return $rss;
}
// fungsi untuk tampil data
function tampil($key)
{
  global $con;
  $row=[];
  $query=mysqli_query($con,$key);
   while($rows=mysqli_fetch_assoc($query))
   {
     $row[]=$rows;
   }
 return $row;
}
// fungsi untuk mengecek data dari database
function cek($t,$f,$i)
{
	global $con;
  $key="SELECT $f FROM $t WHERE $f='$i'";
  $qury=mysqli_query($con,$key);
//   var_dump($qury);die;
  $rss=mysql_num_rows($qury);
   return $rss;
}
// fungsi untuk menghitung row 
function kount($q)
{
	global $con;
    $query=mysqli_query($con,$q);
    $num=count($query);
    return $num;
}
// fungsi untuk mengecek data dari database
function cekdb($q)
{
	global $con;
  $qury=mysqli_query($con,$q);
//   var_dump($qury);die;
  $rss=mysqli_num_rows($qury);
   return $rss;
}
