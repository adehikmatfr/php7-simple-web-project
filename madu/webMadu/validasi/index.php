<?php
// validasi numeric
function angka($a){
  if(is_numeric($a)){
     return false; 
  }
  return true;
}
// validasi huruf 
function karakter($a){
   if(preg_match("/^[A-Za-z ]*$/",$a)){
   return false;
   }
   return true;
}
// validasi huruf dan angka
function non_karakter($a){
   if(preg_match("/^[A-Za-z0-9 -]*$/",$a)){
   return false;
   }
   return true;
}
// validasi text berkarakter .,
function tex($a){
    if(preg_match("/^[A-Za-z0-9 .,]*$/",$a)){
        return false;
        }
        return true; 
}
function doub($a){
  if(preg_match("/^[0-9.]*$/",$a)){
    return false;
    }
    return true;
}
// validasi email .,
function imel($a){
    if(preg_match("/^[A-Za-z0-9 ._@]*$/",$a)){
        return false;
        }
        return true;
}
// validasi script html
function tv($a){
    return htmlspecialchars($a);
}
// panjang karakter
function maxlengt($data){
    if(strlen($data)>=8){
     return false;
    } 
    return true;
  }
//   data kosong
function kosong($data){
    if(empty($data)){
    return true;
    }
    return false;
 }
//  index yang di pilih kosong
 function pilih($data){
   if($data === 0){
 return true;
   }
   return false;
 }
//  panjang karakter
function len($data,$max){
   if(strlen($data)==$max){
  return true;
   }
   return false;
}
//  panjan psw karakter
function leng($data,$max){
  if(strlen($data)<$max){
 return true;
  }
  return false;
}
// function upload gambar
function gambar(){
   $nama=$_FILES['img']['name'];
   $type=$_FILES['img']['type'];
   $tmp=$_FILES['img']['tmp_name'];
   $e=$_FILES['img']['error'];
   $size=$_FILES['img']['size'];

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

  if($size>=5000000){
    echo "<script>alert('Ukuran Gambar Terlalu Besar');</script>";
    return false;
  }

  // lolos
  // ganer3ete nama file
  $namabaru=uniqid();
  $namabaru .=".";
  $namabaru .=$extensi;
  move_uploaded_file($tmp,'img/anggota/'.$namabaru);
 return $namabaru;
}

function uploaded($dir='img/spam/',$ky='img'){
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

 if($size>=5000000){
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


function unggah($dir='img/',$ky='img'){
  $nama=$_FILES[$ky]['name'];
  $type=$_FILES[$ky]['type'];
  $tmp=$_FILES[$ky]['tmp_name'];
  $e=$_FILES[$ky]['error'];
  $size=$_FILES[$ky]['size'];

 //  cek gambar 
 if($e===4){
   return null;
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

 if($size>=5000000){
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

