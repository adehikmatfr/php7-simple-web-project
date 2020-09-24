<?php
 require "../sql/index.php";

session_start();
date_default_timezone_set('Asia/Jakarta');

// logo 
$tp="SELECT * FROM logo WHERE untuk='cdk'";
$pt=tampil($tp);
$logo=$pt[0]['nama_logo'];
//kth
$kt="SELECT * FROM kth where id_kth=1";
$rsu=tampil($kt);
$namekth=$rsu[0]['nama_kth'];

if(!$_SESSION['u']&&!$_SESSION['s']&&!$_SESSION['masuk']){
    echo "<script>alert('Dilarang masuk!');
    document.location.href='index.php?u=".$_SESSION['u']."&s=".$_SESSION['s']."';
    </script>";
}  
unset($_SESSION['masuk']);
?>

 <script type="text/javascript">

 var con= confirm('Apakah Anda Sudah Memasukan Lebah ?');
  if(con==false){
 document.location.href='login.php';
  }
 </script>
<?php
// content
$id=base64_decode($_SESSION['u']);
$str="SELECT * FROM anggota where id_anggota=$id";
$rss=tampil($str);

$ids=base64_decode($_SESSION['s']);
$str="SELECT * FROM stup where id_stup=$ids";
$rs=tampil($str);
$jenis=$rs[0]['id_jenis'];
$tm=tampil("SELECT * FROM jenis WHERE id_jenis='$jenis'"); 
$jangka=$tm[0]['jangka_panen']; 
//  var_dump($tm);die;
$has="SELECT * FROM hasil ORDER BY id_hasil DESC";
$has=tampil($has);
$id_has=$has[0]['id_hasil'];

  $mask=time();
  $panen=$mask+3600*24*30*$jangka;
  $panen=date('d-m-Y',$panen);
    $st="SELECT * FROM panen WHERE id_stup='$ids'";
    $st=tampil($st);
     if($st==[]){
      $ke=1;
     }else{
         $ke=$st[0]['panen_ke']+1;
     }
//   masukan ke db
  $db="INSERT INTO panen values('','$id','$ids',$mask,'$panen','$id_has','$ke',0)";
   $rsl=iud($db);
    if($rsl>0){
        // unset($_SESSION['awal']);
        echo "<script>alert('Data Berhasil Disimpan!');
        document.location.href='index.php?u=".$_SESSION['u']."&s=".$_SESSION['s']."';
        </script>";
    
    }else{
        echo "<script>alert('Data Gagal Disimpan');</script>";
    }



?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masuk Lebah</title>
    <link rel="icon" type="image/png" href="../admin/img/logo/<?=$logo?>">
	<title>Cabang Dinas Kehutanan Wilayah VII</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/lg.css">
	<link rel="stylesheet" type="text/css" href="../css/sm.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
    <style>
    body{
        font-family:sans-sarif;
        background-color:rgba(0,0,0,0.1);
    }
    </style>
</head>
<body> -->
<!-- content -->
<!-- <section>
 <div class="container mt-2">

     <div class="row">
       <div class="col-lg-12">   
       <ul class="nav nav-tabs">
       <li class="nav-item">
            <a class="nav-link active" href="">Masuk Lebah</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="">Pemeliharaan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="">Panen</a>
        </li>
        </ul>
       </div>
     </div>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row pl-3 pr-3">
       <div class="col-lg-12 pl-1 justify-content-center border-left border-bottom border-right bg-light">
           <div class="row pl-1 mt-3 justify-content-center">
             <div class="col-lg-4">
           <span class="pl-2 text-warning">Klik Tombol simpan Jika lebah sudah Masuk!</span><br> <span class="pl-2"><?=date('l, d-M-Y');?></span>
                <div class="pl-5 pr-5">
                <button type="submit" onclick="return confirm('apakah anda yakin?');" class="btn btn-primary btn-block mb-4 mt-3" name="simpan">Simpan</button>
                </div>
           </div>
           </div>
       </div>
    </div>
</form>
    <div class="row">
    <div class="col-6">
    <a href="index.php?u=<?=$_SESSION['u']?>&s=<?=$_SESSION['s']?>" class="pl-1">keluar</a>
    </div>
    <div class="col-6 text-right ">
    <span class="pr-1 text-primary"><?=$rss[0]['nama']?> <?=$rs[0]['code_stup']?></span>
    </div>
    </div>

    <div class="row mt-5">
    <div class="col-12 text-center">
    <span class="text-warning">&copy 2019 Ade Hikmat FR</span>
    </div>
    </div>

 </div>
</section> -->
<!-- akhir content -->


<!-- <script src="../js/jquery-3.3.1.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html> -->