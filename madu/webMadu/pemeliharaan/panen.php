<?php
 require "../sql/index.php";
 require "../validasi/index.php";
session_start();
// logo 
$tp="SELECT * FROM logo WHERE untuk='cdk'";
$pt=tampil($tp);
$logo=$pt[0]['nama_logo'];
//kth
$kt="SELECT * FROM kth where id_kth=1";
$rsu=tampil($kt);
$namekth=$rsu[0]['nama_kth'];

if(!$_SESSION['u']&&!$_SESSION['s']&&!$_SESSION['panen']){
    echo "<script>alert('Dilarang masuk!');
    document.location.href='index.php?u=".$_SESSION['u']."&s=".$_SESSION['s']."';
    </script>";
   }
   // content
$id=base64_decode($_SESSION['u']);
$str="SELECT * FROM anggota where id_anggota=$id";
$rss=tampil($str);

$ids=base64_decode($_SESSION['s']);
$str="SELECT * FROM stup where id_stup=$ids";
$rs=tampil($str);

if(isset($_POST['simpan'])){
 $hasil=$_POST['hasil'];
 $img=unggah('panen/','img');
   
   if(doub($hasil)){
    $e="Nilai Yang anda masukan Salah!";
   }

  $ki="SELECT * FROM panen_real WHERE id_stup='$ids' ORDER by id_p DESC";
   $tm=tampil($ki);
    if($tm==[]){
     $pan=1;
    }else{
        $pan=$tm[0]['periode'];
    }
    $date=date('d-m-Y');
//   masuk db
  $key="INSERT INTO panen_real VALUES('','$ids','$hasil','$img','$pan','$date')";
//   var_dump($key);die;
  $rss=iud($key);
   if($rss>0){
    //    update dulu role_id panen terakhir
    $idd=tampil("SELECT * FROM panen WHERE id_stup='$ids' ORDER BY id_panen DESC");
    $idd=$idd[0]['id_panen'];
    $s="UPDATE panen SET role_id=1 WHERE id_stup='$ids' and id_panen='$idd'";
     $h=iud($s);
    echo "<script>alert('Data Berhasil Disimpan!');
    document.location.href='index.php?u=".$_SESSION['u']."&s=".$_SESSION['s']."';
    </script>";
   }else{
    echo "<script>alert('Data Gagal Disimpan!');
    </script>";
   }   

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panen Madu</title>
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
<body>
<!-- content -->
<section>
 <div class="container mt-2">

     <div class="row">
       <div class="col-lg-12">   
       <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="">Panen</a>
        </li>
        </ul>
       </div>
     </div>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row pl-3 pr-3">
       <div class="col-lg-12 pl-1 justify-content-center border-left border-bottom border-right bg-light">
           <div class="row pl-1 mt-3 justify-content-center">
             <div class="col-lg-4">
           <label for="ket">Masukan Hasil</label>
           <input type="text" required name="hasil" id="ket" class="form-control mt-1 mb-1" placeholder="Masukan Hasil (Liter)">
           <small class="pl-1 text-danger"><?php if(isset($e)){echo $e;}?></small>
           
                <div class="custom-file mt-1">
                    <input type="file" name="img" class="custom-file-input mt-1 mb-1" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Pilih Photo</label>
                </div>
                <small class="pl-1 text-warning">Anda bisa tidak menyertakan photo (Opsional)!</small>
                <div class="pl-5 pr-5">
                <button type="submit" class="btn btn-primary btn-block mb-4 mt-3" name="simpan">Simpan</button>
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
    <span class="pr-1 text-primary"><i>User :<?=$rss[0]['nama']?></i>  <i>Stup :<?=$rs[0]['code_stup']?></i></span>
    </div>
    </div>

    <div class="row mt-5">
    <div class="col-12 text-center">
    <span class="text-warning">&copy 2019 Ade Hikmat FR<br>SMKN 1 KAWALI</span>
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