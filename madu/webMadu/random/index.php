<?php
function random($length = 5){
   $str="";
   $char=array_merge(range('A','Z'),range('a','z'),range('0','9'));
   $max= count($char)-1;
   $i=0;
   while($i<$length){
    $rand=mt_rand(0,$max);
    $str.=$char[$rand];
    $i++;
   }
   return $str;
}

function dated(){
  $date=date("l, d-m-y h:i:sa");
  return $date;
}
function dates(){
  $date=date("l, d-m-y");
  return $date;
}
function tim($v){
  $date=date($v);
  return $date;
}


