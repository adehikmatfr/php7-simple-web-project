<?php
 require "../sql/index.php";

 session_start();

 if(isset($_SESSION['masuk'])==1){
    if($_SESSION['awal']){
        echo"<script>document.location.href='masuk_lebah.php';</script>";
     }else if($_SESSION['pelihara']){
        echo"<script>document.location.href='form.php';</script>";
     }else if($_SESSION['panen']){
        echo"<script>document.location.href='panen.php';</script>";
     }
 }

// logo 
$tp="SELECT * FROM logo WHERE untuk='cdk'";
$pt=tampil($tp);
$logo=$pt[0]['nama_logo'];
//kth
$kt="SELECT * FROM kth where id_kth=1";
$rsu=tampil($kt);
$namekth=$rsu[0]['nama_kth'];

// content
$id=base64_decode($_SESSION['u']);
$str="SELECT * FROM anggota where id_anggota=$id";
$rss=tampil($str);


if(isset($_POST['verify'])){
    $token=$_POST['token'];
    $db_token=$rss[0]['token'];
    $msk=true;
   if($token!=$db_token){
  $e="Maaf Token Yang anda masukan tidak sesuai!";
  $masuk=false;
   }

   if($msk) 
   {
       $_SESSION['masuk']=1;
    //    mulai masuk lebah;
     if($_SESSION['awal']){
        echo"<script>document.location.href='masuk_lebah.php';</script>";
     }else if($_SESSION['pelihara']){
        echo"<script>document.location.href='form.php';</script>";
     }else if($_SESSION['panen']){
        echo"<script>document.location.href='panen.php';</script>";
     }

   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemeliharaan Madu</title>
    <link rel="icon" type="image/png" href="../admin/img/logo/<?=$logo?>">
	<title>Cabang Dinas Kehutanan Wilayah VII</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/lg.css">
	<link rel="stylesheet" type="text/css" href="../css/sm.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<!-- content -->
<section>
 <div class="container mt-5">
     <div class="row justify-content-center">
         <div class="col-10 shadow p-3 mb-5 bg-white rounded">
             <center><img src="../admin/img/logo/<?=$logo?>" class="img-fluid mt-5" alt="logo"></center>
               <div class="row justify-content-center mt-5">
                <div class="col-8">
                <form action="" method="post">
             <input type="password" name="token" class="form-control" placeholder="Masukan Kode Token" required>
             <small class="text-danger pl-1"><?php if(isset($e)){echo $e;}?></small>
               <button type="submit" name="verify" class="btn btn-primary btn-block mt-3 mb-5">Masuk</button>
               </form>
                </div>
               </div>
              <a href="index.php?u=<?=$_SESSION['u']?>&s=<?=$_SESSION['s']?>" style="font-style:none;">kembali</a> 
         </div>
     </div>
 </div>
</section>
<!-- akhir content -->


<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html>