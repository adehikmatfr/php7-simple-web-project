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
     alert('Punten Anjen Kedah Login Hela!');
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

date_default_timezone_set('Asia/Jakarta');
$harini=time();
$harini=date('d-m-Y',$harini);
$str="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND panen.panen='$harini'";

$sw="Sedang Di Panen Saat Ini";
if(isset($_POST['cari'])){
$tgl=$_POST['src'];

     if(!empty($tgl)){
       $tgl=strtotime($tgl);
       $tgl=date('d-m-Y',$tgl);
      $str="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND panen.panen='$tgl'";
     $sw="di Panen pada $tgl";

    }

}
$row=tampil($str);
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
	  <a class="navbar-brand text-warning" href="index.php">Panen Saat ini</a>
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
          <a class="nav-link text-light" href="laporan.php">Laporan</a>
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
           <div class="row justify-content-center mt-5"> 
           <div class="col-lg-4">  
            <form action="" method="post">
              <input class="form-control mr-sm-2" name="src" type="date" placeholder="Masukan Data Pencarian" aria-label="Search" id="cari">
              <button class="btn btn-outline-success my-2 mt-lg-3 my-sm-0" name="cari" type="submit">Cari</button>
           </form>
           </div>
           </div>
<div class="row justify-content-center mt-2" id="wadah">
<!-- tabel -->
        <h3 class="mt-3 mb-2">Stup Yang <?=$sw?></h3> 
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
                   foreach($row as $u):
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
                     <p class="footer-company-name">&copy; 2019 smkn 1 kawali</p>             
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
                    <span>Tentang KTH Bina Lestari</span>                     <?=$row[0]['about']?>                 
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