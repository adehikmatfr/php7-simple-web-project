<?php
session_start();
require "../sql/index.php";
require "../validasi/index.php";
require "../random/index.php";


$string="SELECT * FROM users WHERE level='2'";
$tampil=tampil($string);
$username=md5($tampil[0]['username']);
$lev=md5($tampil[0]['level']);
// cek dulu cookies nya

if(isset($_COOKIE['72d4b2a056788e501159c1671c272d74'])){
   if($_COOKIE['72d4b2a056788e501159c1671c272d74']!=$lev){
	echo"
	<script>
	document.location.href='../login.php';
	</script> 
	 ";
   }else{
	$_SESSION['user']=$username;
	$_SESSION['level']=$lev;
   }
}
// cari user oprator
if(!$_SESSION){
  echo"
 <script>
 alert('Punten Anjen Kedah Login Hela!');
 document.location.href='../login.php';
 </script> 
  ";
}

if($_SESSION['user']!==$username && $_SESSION['level']!==$lev){
	echo"
	<script>
	alert('Bade ngehack nya?');
	document.location.href='../hack.php';
	</script> 
	 ";
}


// logo 
$tp="SELECT * FROM logo WHERE untuk='cdk'";
$pt=tampil($tp);
$logo=$pt[0]['nama_logo'];
$ku="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil ORDER BY id_panen DESC";

$ex[1]='';
$dis="disabled";
$nik='';
if(isset($_POST['slp'])){

$ex=explode(',', $_POST['nikk']);

$nik=$ex[0];
$_SESSION['nik']=$nik;
$ss="SELECT * FROM stup WHERE id_anggota='$nik'";

  if(empty($ex[0])){
      $d="show";
      $e="Anda Belum Memilih";
  }else{
      $d="show";
      $e="Anda Memilih $ex[1]";
      $dis="";
       $ku="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil and anggota.id_anggota='$nik' ORDER BY id_panen DESC";
    }

}

if(isset($_POST['cari'])){
    $nik=$_SESSION['nik'];
  $stup=$_POST['code'];
  $bln=$_POST['bln'];
  $thn=$_POST['tahun'];

  $th='-'.$thn;
  if($bln<10){
 $bln='0'.$bln;
  }
   $blnn='-'.$bln.'-';
 // cari berdasarkan nik,code,dan bulan
    if(!empty($nik)&&!empty($stup)&&!empty($bln)&&!empty($thn)){
       $ku="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND anggota.id_anggota='$nik' AND stup.id_stup='$stup' AND panen.panen like '%$blnn$thn%'";
     }else if(!empty($nik)&&!empty($stup)&&!empty($bln)){
      $ku="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND anggota.id_anggota='$nik' AND stup.id_stup='$stup' AND panen.panen like '%$blnn%'";
     }else if(!empty($nik)&&!empty($stup)&&!empty($thn)){
      $ku="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND anggota.id_anggota='$nik' AND stup.id_stup='$stup' AND panen.panen like '%$th%'";
     }else if(!empty($nik)&&!empty($thn)&&!empty($bln)){
      $ku="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND anggota.id_anggota='$nik' AND panen.panen like '%$th%'";
     } else if(!empty($nik)&&!empty($stup)){
      $ku="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND anggota.id_anggota='$nik' AND stup.id_stup='$stup'";
     }else if(!empty($nik)&&!empty($bln)){
       $ku="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND anggota.id_anggota='$nik' AND panen.panen like '%$blnn%'";
     }else if(!empty($nik)&&!empty($thn)){
       $ku="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND anggota.id_anggota='$nik' AND panen.panen like '%$th%'";
     } else if(!empty($nik)){
      $ku="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND anggota.id_anggota='$nik'";
     }
  

}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="../admin/img/logo/<?=$logo?>">
  <title>Cabang Dinas Kehutanan Wilayah VII</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/lg.css">
  <link rel="stylesheet" type="text/css" href="../css/sm.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<!-- navigasi bar -->
<section>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
    <img src="../admin/img/logo/<?=$logo?>">
    <a class="navbar-brand text-light" href="index.php">Panen Saat ini</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link text-light" href="stup.php">Stup</a>
          </li>
       <li>
          <a class="nav-link text-light" href="panen.php">Panen</a>
      </li>
      <li>
          <a class="nav-link text-light" href="riwayat.php">Riwayat</a>
      </li>
       <li>
          <a class="nav-link text-warning" href="laporan.php">Laporan</a>
      </li>
      <li>
          <a class="nav-link text-light" href="pemeliharaan.php">Pemeliharaan</a>
      </li>
      <li>
          <a class="nav-link text-light" href="pengaturan.php">Pengaturan</a>
      </li>
      </ul>
    </div>
     <a class="nav-link text-light" onclick="return confirm('Apakah Anda ingin Keluar?');" href="../logout.php">Logout</a>
</nav>
</section>
<!-- akhir Naigasi bar -->
<!-- awal konten -->
<section>



<div class="container topp">
 <div class="row justify-content-center form-group"> 
  <div class="col-sm">
    <h3>Buat Laporan Panen</h3> 
  </div>
 </div>
<form action="" method="post">
         <div class="row justify-content-center mt-3 form-group"> 

             <div class="col-lg-3">
               <label for="sel">Pilih Pemilik</label>
               <select name="nikk" id="sel" class="form-control" >
                 <option value="">Pilih....</option>
                 <?php 
                  $s="SELECT DISTINCT nama, anggota.id_anggota FROM anggota,stup where (anggota.id_anggota=stup.id_anggota) order by anggota.nama ASC";
                  $rss=tampil($s);
                  foreach($rss as $r):
                  ?>
                  <option value="<?=$r['id_anggota']?>,<?=$r['nama']?>"><?=$r['nama']?></option>
                <?php endforeach; ?>
               </select>
               <button type="submit" class="btn btn-success mt-2" name="slp">Submit</button>
            <!-- alert -->
       <?php if(isset($d)): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?=$e ?>.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
     <?php endif; ?>
      <!-- alert -->
             </div>

            <div class="col-lg-3">
               <label for="sell">Pilih Code</label>
               <select name="code" id="sell" class="form-control" <?=$dis?>>
                 <option value="">Pilih....</option>
                 <?php 
                  $rsss=tampil($ss);
                  foreach($rsss as $rr):
                  ?>
                  <option value="<?=$rr['id_stup']?>"><?=$rr['code_stup']?></option>
                <?php endforeach; ?>
               </select>
             </div>
              

              <div class="col-lg-3">
               <label for="sel">Pilih Bulan</label>
               <select name="bln" id="sel" class="form-control" <?=$dis?>>
              <option value="">Pilih....</option>
                <?php 
                $a=1;
                $bulan=['January','February','Mart','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                foreach($bulan as $b):
                 ?>
              <option value="<?=$a?>"><?=$b?></option>
   <?php $a++; endforeach; ?>
               </select>
             </div>

                           <div class="col-lg-3">
               <label for="sel">Pilih Tahun</label>
               <select name="tahun" id="sel" class="form-control" <?=$dis?>>
              <option value="">Pilih....</option>
                <?php 
                $a=2019;
                while($a<=2050):
                 ?>
              <option value="<?=$a?>"><?=$a?></option>
   <?php $a++; endwhile; ?>
               </select>
             </div>

            <div class="col-lg-3 mt-2">
              <button type="submit" name="cari" class="btn btn-primary btn-block mt-4" <?=$dis?>>Pilih</button>
            </div>
           </div>
</form>
           <div class="row justify-content-center mt-5">   
            <div class="col-lg-3">
               <a href="../print.php?anggota=<?=base64_encode($nik)?>&&str=<?=base64_encode($ku);?>" target="_blank" class="btn btn-success btn-block">Print</a>
            </div>
           </div>

<div class="row justify-content-center mt-2">
<!-- tabel -->
        <h3 class="mt-3 mb-2">Data Panen <?=$ex[1]?></h3> 
            <div class="container table-responsive" style="overflow-y: hidden;">
                <div data-role="main" class="ui-content">
                  <table data-role="table" class="table table-sm table-hover table-dark" >
                   <thead>
                   <tr>
                   <th>No</th>
                   <th>Pemilik</th>
                   <th>Code Stup</th>
                   <th>Jenis Lebah</th>
                   <th>Masuk Lebah</th>
                   <th>Panen</th>
                   <th>Hasil Minimum</th>
                   </tr>
                   </thead>
                   <tbody>
                  <?php 
                   $aa=1;
                  $ku=tampil($ku);
                   foreach($ku as $u):
                    ?>
                   <tr>
                   <td><?=$aa?></td>
                   <td><?=$u['nama']?></td>
                   <td><?=$u['code_stup']?></td>
                   <td><?=$u['nama_jenis']?></td>
                   <td><?=date('d-m-Y',$u['lebah_masuk'])?></td>
                   <td><?=$u['panen']?></td>
                   <td><?=$u['jumlah']?> Liter</td>
                   </tr>
                   <?php $aa++; endforeach;?>
                   </tbody>
                  </table>
                </div>
              
          </div>
          <!-- table -->
      </div>
</div>

</section>
<!-- akhir konten -->

<!-- The content of your page would go here. -->  
<?php 
$str="SELECT * FROM contac WHERE id_con='1'";
$row=tampil($str);
 ?>
<div class="container-fluid bg-dark" style="max-width: 100%; height:230px; margin-top: 200px;"> 
       <div class="container bg-dark mt-3"> 
       <footer class="footer-distributed">  
                  <div class="footer-left">  
                    <h3>3A<span>Production</span></h3>  
                     <p class="footer-links"> 
                    <a href="index.php">Oprator</a>  
                   ·                     <a href="stup.php">Stup</a>
                   ·                     <a href="panen.php">panen</a>
                   ·                     <a href="riwayat.php">Riwayat</a>
                   ·                     <a href="laporan.php">Laporan</a> 
                     </p>                 
                     <p class="footer-company-name">&copy;PKL 2019 smkn 1 kawali</p>
                     <p class="footer-company-name">Ade Hikmat Pauji R</p>    
                     <p class="footer-company-name">Abdul Aziz</p>
                     <p class="footer-company-name">Agil Gugum G</p> 
                     <p class="footer-company-name">Drs. A.Iman Chandra Margana <span class="text-light">(Supervisor)</span></p>            
                 </div>             
                 <div class="footer-center">                 
                  <div>                    
                   <i class="fa fa-map-marker"></i>                     
                   <p><span>Kelompok Tani Hutan</span> Binalestari</p>                 
                  </div>                 
                  <div>                     
                    <i class="fa fa-phone"></i>                     
                    <p><?=$row[0]['nohp']?></p>                 
                  </div>                 
                  <div>                     
                    <i class="fa fa-envelope"></i>                     
                    <p><a href="<?=$row[0]['email']?>"><?=$row[0]['email']?></a></p>                 
                  </div>             
                 </div>             
                 <div class="footer-right">                 
                  <p class="footer-company-about">                     
                    <span>Tentang KTH Binalestari</span>                     <?=$row[0]['about']?>                 
                  </p>                 
                  <div class="footer-icons">                                         
                    <a href="<?=$row[0]['fb']?>"><i class="fa fa-linkedin"><img src="https://img.icons8.com/color/48/000000/gmail.png" class="img-fluid" style="margin-left: -20px; max-height: 40px; position: absolute; max-width: 55px; margin-top: -3px;" alt="fb"></i></a>                      
                    <a href="<?=$row[0]['fb']?>"><i class="fa fa-linkedin"><img src="../admin/img/logo/fb.svg" class="img-fluid" style="margin-left: -30px; position: absolute; max-width: 55px; max-height: 32px;" alt="fb"></i></a>                                      
                  </div>             
                 </div>         
             </footer>
               </div>
           </div>
<!-- akhir footer -->



</body>


<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
</html>