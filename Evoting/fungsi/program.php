<?php

function uploaded($dir='../potos/',$ky='img'){
  $nama=$_FILES[$ky]['name'];
  $type=$_FILES[$ky]['type'];
  $tmp=$_FILES[$ky]['tmp_name'];
  $e=$_FILES[$ky]['error'];
  $size=$_FILES[$ky]['size'];

 //  cek gambar 
 if($e===4){
   echo "<script>alert('Pilih gambar terlebih dahulu');</script>";
   return false;
 }
 // yang boleh di upload haya gambar
 $gambarv=['jpg','jpeg','png','img'];
 $extensi=explode('.',$nama);
 $extensi=strtolower(end($extensi));

 if(!in_array($extensi,$gambarv)){
   echo "<script>alert('Yang Anda Upload bukan Gambar');</script>";
   return false;
 }

 //ukuran

 if($size>=10000000){
   echo "<script>alert('Ukuran Gambar Terlalu Besar');</script>";
   return false;
 }

 // lolos
 // ganer3ete nama file
 $namabaru=uniqid();
 $namabaru .=".";
 $namabaru .=$extensi;
 move_uploaded_file($tmp,$dir.$namabaru);
return $namabaru;
}