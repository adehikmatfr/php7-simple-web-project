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
$masuk=true;
if (isset($_POST['simpan'])) {
  $id=tv($_POST['id']);
  // $code=tv($_POST['code']);
  $bahan=tv($_POST['bahan']);

  $ss="SELECT * FROM stup WHERE id_anggota='$id'";
  // validasi nama setup 
  // if(non_karakter($code)){
  //     $non_valid="show";
  //     $massage="Anjen Mung Tiasa Ngalebetkeun huruf,angka Sareng spasi";
  //     $masuk=false; 
  // }

  $stp=cekdb($ss);
   if($stp==0){
      $ht=1;
      $nol="0";
  }else if($stp<9&&$stp>0){
      $nol="0";
      $ht=$stp+1;
  }else{
    $ht=$stp+1;
    $nol="";
  }


$code=$id."-".$nol.$ht;
// var_dump($code);die;
  if($masuk){
   $str="INSERT INTO stup values ('','$id','$code','$bahan')";
   $rsult=iud($str);
      if($rsult>0){
        $valid="show";
        $vmassage="WILUJENG! stup $code atos terdaftar";
      }else{
                $valid="show";
        $vmassage="stup $code gagal terdaftar";
      }
  }

}
// edit stup
if (isset($_POST['edit'])) {
  $code=tv($_POST['code']);
  $bahan=tv($_POST['bahan']);
  $ids=$_POST['edit'];
  
  // validasi nama setup 
  if(non_karakter($code)){
echo "<script>
       alert('Anjen Mung Tiasa Ngalebetkeun huruf,angka Sareng spasi');
     </script>";
      $masuk=false; 
  }

  if($masuk){
   $str="UPDATE stup SET code_stup='$code',id_jenis='$bahan' WHERE id_stup='$ids'";
   $rsult=iud($str);
      if($rsult>0){
echo "<script>
       alert('Wilujeng Data Berhasil Diubah');
       document.location.href='stup.php';
     </script>";
      $masuk=false; 
      }else{
      echo "<script>
       alert('Data Gagal Diubah');
     </script>";
      }
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
	        <a class="nav-link text-warning" href="stup.php">Stup</a>
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
  <div class="row justify-content-center form-group"> 
  <div class="col-sm">
    <h3>Registrasi Stup Anggota</h3>
  </div>
 </div> 
 <form action="" method="post">
          <div class="row justify-content-center mt-3 form-group"> 

             <div class="col-lg-3">
               <label for="sel">Pilih Pemilik</label>
               <select name="id" id="sel" class="form-control" required>
                 <option value="">Pilih....</option>
                 <?php  
                  $st="SELECT * FROM anggota order by nama ASC";
                  $ts=tampil($st);
                  foreach($ts as $t):
                  ?>
                  <option value="<?=$t['id_anggota']?>"><?=$t['nama']?></option>
                <?php   endforeach; ?>
               </select>
             </div>
          
             <!-- <div class="col-lg-3">
               <label for="cod">Code Stup</label>
               <input type="text" name="code" class="form-control" placeholder="Masukan Code Stup" required> -->
                 <!-- alert -->
       <?php //if(isset($non_valid)): ?>
        <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Opss !</strong> <?php //$massage ?>.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div> -->
     <?php //endif; ?>
      <!-- alert -->
             <!-- </div> -->

        
             <div class="col-lg-3">
               <label for="sel">Pilih Jenis Lebah</label>
               <select name="bahan" id="sel" class="form-control" required>
                 <option value="">Pilih....</option>
                  <?php  
                  $sts="SELECT * FROM jenis";
                  $tss=tampil($sts);
                  foreach($tss as $ts):
                  ?>
                  <option value="<?=$ts['id_jenis']?>"><?=$ts['nama_jenis']?></option>
                <?php   endforeach; ?>
               </select>
             </div>
              
 
            <div class="col-lg-3 mt-2">
              <button type="submit" name="simpan" class="btn btn-primary btn-block mt-4">Simpan</button>
                <!-- alert -->
       <?php if(isset($valid)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Sampurasun !</strong> <?=$vmassage ?>.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
     <?php endif; ?>
      <!-- alert -->
            </div>
           </div>
</form>
           <div class="row justify-content-center mt-5"> 
           <div class="col-lg-4">  
            
              <input class="form-control mr-sm-2" type="search" placeholder="Masukan Data Pencarian" aria-label="Search" id="cari">
              <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
           
           </div>
           </div>

           <div class="row mt-5">
<div class="col-lg-5 pl-3">
        <h3 class="">Daftar Stup</h3>
</div> 
<div class="col-lg-2 text-right"><label for="qr">Unduh QR code</label></div>
<div class="col-lg-3">
<form action="../qr.php" method="post">       
    <select name="qr" id="qr" class="custom-select" required>
    <option value="">Pilih..</option>
    <option value="*">All</option>
<?php $a=1; $str=tampil("SELECT * FROM anggota"); foreach($str as $s):?>
        <option value="<?=$s['id_anggota']?>"><?=$s['nama']?></option>
<?php endforeach;?>
    </select>
</div> 
<div class="col-lg-2"><button type="submit" name="unduh" class="btn btn-primary">Unduh</button></div>
</div>
</form>
<div class="row mt-2" id="stup">
<!-- tabel --> 
            <div class="container table-responsive" style="overflow-y: hidden;">
                <div data-role="main" class="ui-content">
                  <table data-role="table" class="table table-sm table-hover table-dark" >
                   <thead>
                   <tr>
                   <th>No</th>
                   <th>Pemilik</th>
                   <th>Code Stup</th>
                   <th>Jenis Lebah</th>
                    <th>Aksi</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php 
                   $aa=1;
                   $ku="SELECT * FROM stup,anggota,jenis WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis order by stup.id_stup DESC limit 50";
                  $ku=tampil($ku);
                   foreach($ku as $u):
                    ?>
                   <tr>
                   <td><?=$aa?></td>
                   <td><?=$u['nama']?></td>
                   <td><?=$u['code_stup']?></td>
                   <td><?=$u['nama_jenis']?></td>
                   <td>
<a href="hapus.php?id=<?=$u['id_stup']?>&t=stup&f=id_stup&a=stup.php" onclick="return confirm('Apakah anda yakin ingin mengpus data?');" class="btn btn-danger btn-sm">hapus</a>
<a href=""  data-toggle="modal" data-target="#dat<?=$u['id_stup']?>" class="btn btn-info ml-3 btn-sm">Edit</a>
                  <a href="../qr.php?id_u=<?=base64_encode($u['id_anggota'])?>&id_s=<?=base64_encode($u['id_stup'])?>"  onclick="return confirm('Apakah anda Ingin Mengunduh Code QR?');" class="btn ml-1 btn-primary btn-sm">QR</a>            
                  </td>
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



<!-- Modal kth -->
<?php 
$roh="SELECT * FROM stup,anggota,jenis WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis";
$tpp=tampil($roh);
foreach($tpp as $w):?>
<div class="modal fade bg-dark" id="dat<?=$w['id_stup'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit stup <?=$w['nama']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

 <form action="" method="post">
          <div class="row justify-content-center mt-3 form-group"> 

             <div class="col-lg-4">
               <label for="cod">Code Stup</label>
               <input type="text" name="code" class="form-control" placeholder="Masukan Code Stup" value="<?=$w['code_stup']?>" required>
                 <!-- alert -->
      <!-- alert -->
             </div>

        
             <div class="col-lg-5">
               <label for="sel">Pilih Jenis Lebah</label>
               <select name="bahan" id="sel" class="form-control" required>
                 <option value="<?=$w['id_jenis']?>"><?=$w['nama_jenis']?></option>
                  <?php  
                  $sts="SELECT * FROM jenis";
                  $tss=tampil($sts);
                  foreach($tss as $ts):
                  ?>
                  <option value="<?=$ts['id_jenis']?>"><?=$ts['nama_jenis']?></option>
                <?php   endforeach; ?>
               </select>
             </div>
      
      </div>  
      <div class="modal-footer mt-5">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" value="<?=$w['id_stup']?>" name="edit">Simpan</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php endforeach;?>


</body>

<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/ajax.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
</html>