<?php
session_start();
require "../sql/index.php";
require "../validasi/index.php";
require "../random/index.php";

$string="SELECT * FROM users WHERE level='1'";
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
// cari user admin
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

if(isset($_POST['simpan'])){
   $nama=tv($_POST['untuk']);
     if (empty($nama)) {
    echo "<script>
    alert('pilih terlebih dahulu kategori');
    document.location.href='layout.php';
    </script>";
    return false;
     }

   $dir="img/logo/";
   $v="img";
   $img=uploaded($dir,$v);
   
    // masukan ke db
    $key="INSERT INTO logo values('','$img','$nama')";
    $rs=iud($key);
    if($rs>0){
        echo "<script>
    alert('Gambar berhasil Disimpan');
    document.location.href='layout.php';
    </script>";
    }else{
        echo "<script>
    alert('Gambar Gagal Disimpan');
    </script>";
    }
}
// dokumentai
$cek=cekdb("SELECT * FROM img");
$dis="";
  if($cek>=6){
$dis="disabled";
  }
if(isset($_POST['dok'])){
  $des=htmlspecialchars($_POST["deskip"]);
  if(empty($des)){
    echo"<script>
    alert('Deskripsi Tidak Boleh Kosong');
    </script>"; 
  }
  $img=uploaded('../img/dokument/','img');
   
  $key="INSERT INTO dokumentasi values ('','$img','$des','../img/dokument/')";
  $rss=iud($key);
  if($rss>0){
    echo "<script>
    alert('Dokumentasi berhasil Disimpan');
    document.location.href='layout.php';
    </script>";
    }else{
        echo "<script>
    alert('Dokumentasi Gagal Disimpan');
    </script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/png" href="img/logo/<?=$logo?>">
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
		<img src="img/logo/<?=$logo?>">
	  <a class="navbar-brand text-light" href="index.php">Kartu Anggota</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item">
	        <a class="nav-link text-warning" href="layout.php">Tampilan</a>
	        </li>
         <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-light" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          KTH
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item " href="kth.php#ang">Anggota</a>
          <a class="dropdown-item " href="kth.php#kt">KTH</a>
          <a class="dropdown-item " href="kth.php#jb">Jabatan</a>
      </li>
       <li>
          <a class="nav-link text-light" href="contac.php">Kontak</a>
      </li>
	    </ul>
	  </div>
	   <a class="nav-link text-light" onclick="return confirm('apakah anda yakin ingin keluar?');" href="../logout.php"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="34" height="34"
viewBox="0 0 172 172"
style=" fill:#000000;"><defs><linearGradient x1="86" y1="30.23438" x2="86" y2="158.60658" gradientUnits="userSpaceOnUse" id="color-1"><stop offset="0" stop-color="#1a6dff"></stop><stop offset="1" stop-color="#c822ff"></stop></linearGradient><linearGradient x1="86" y1="14.10938" x2="86" y2="95.43124" gradientUnits="userSpaceOnUse" id="color-2"><stop offset="0" stop-color="#6dc7ff"></stop><stop offset="1" stop-color="#e6abff"></stop></linearGradient><linearGradient x1="86" y1="30.23438" x2="86" y2="158.60658" gradientUnits="userSpaceOnUse" id="color-3"><stop offset="0" stop-color="#1a6dff"></stop><stop offset="1" stop-color="#c822ff"></stop></linearGradient></defs><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="#343a40"></path><g id="Слой_1"><path d="M86,155.875c-34.08556,0 -61.8125,-27.72694 -61.8125,-61.8125c0,-24.31381 14.33781,-46.45881 36.52581,-56.41869l2.19838,4.902c-20.25838,9.09719 -33.34919,29.31794 -33.34919,51.51669c0,31.11856 25.31894,56.4375 56.4375,56.4375c31.11856,0 56.4375,-25.31894 56.4375,-56.4375c0,-22.2095 -13.09887,-42.43294 -33.368,-51.52475l2.19837,-4.902c22.20144,9.9545 36.54462,32.10219 36.54462,56.42675c0,34.08556 -27.72694,61.8125 -61.8125,61.8125z" fill="url(#color-1)"></path><path d="M96.75,80.625c0,5.93669 -4.81331,10.75 -10.75,10.75v0c-5.93669,0 -10.75,-4.81331 -10.75,-10.75v-53.75c0,-5.93669 4.81331,-10.75 10.75,-10.75v0c5.93669,0 10.75,4.81331 10.75,10.75z" fill="url(#color-2)"></path><path d="M86,139.75c-25.19263,0 -45.6875,-20.49487 -45.6875,-45.6875c0,-17.62462 9.847,-33.368 25.69787,-41.09456l2.35694,4.83481c-13.99112,6.8155 -22.67981,20.70988 -22.67981,36.25975c0,22.22831 18.08419,40.3125 40.3125,40.3125c22.22831,0 40.3125,-18.08419 40.3125,-40.3125c0,-15.54719 -8.686,-29.44156 -22.67444,-36.25975l2.35694,-4.82944c15.84819,7.72388 25.6925,23.46725 25.6925,41.08919c0,25.19263 -20.49487,45.6875 -45.6875,45.6875z" fill="url(#color-3)"></path></g></g></svg> Logout</a>
</nav>
</section>
<!-- akhir Naigasi bar -->
<!-- awal konten -->
<section>



<div class="container topp">
          <form action="" method="post" enctype="multipart/form-data">
<div class="row justify-content-center mt-3">
   <div class="col-lg-6">
    <label for="u">Gambar Untuk</label>
   	<select name="untuk" id="u" class="form-control mb-3">
   	       	<option value="">Pilih Kategori</option>
            <option value="cdk">CDK VII</option>
            <option value="bina lestari">Bina Lestari</option>
   	</select>

		<div class="input-group">
			<div class="custom-file">
				<input type="file" class="custom-file-input" name="img" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
				<label class="custom-file-label" for="inputGroupFile04"><img src="https://img.icons8.com/color/30/000000/picture.png"> Pilih Gambar</label>
			</div>
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="submit" name="simpan" id="inputGroupFileAddon04"><img src="https://img.icons8.com/plasticine/21/000000/upload.png"></button>
			</div>
			</form>
		</div>
</div>


<div class="container justify-content-center mt-5 mb-5">
     <div class="row">
       <?php 
$str="select * from logo";
$s=tampil($str);
foreach ($s as $s) :
       ?>
       <div class="col-3">
       	   <img src="img/logo/<?=$s["nama_logo"]?>" alt="logos" class="img-fluid" style="max-height: 100px;">
           <br>
           <label for="">Kategori : <?=$s['untuk']?></label>
           <br>
              <a href="hapus.php?id=<?=$s['id_logo']?>&t=logo&f=id_logo&a=layout.php" onclick="return confirm('Apakah anda yakin ingin mengpus data?');" class="btn btn-danger btn-sm ml-3 mt-2"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
width="24" height="24"
viewBox="0 0 172 172"
style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#3498db"><path d="M71.66667,14.33333l-7.16667,7.16667h-28.66667c-3.956,0 -7.16667,3.21067 -7.16667,7.16667c0,3.956 3.21067,7.16667 7.16667,7.16667h100.33333c3.956,0 7.16667,-3.21067 7.16667,-7.16667c0,-3.956 -3.21067,-7.16667 -7.16667,-7.16667h-28.66667l-7.16667,-7.16667zM35.83333,50.16667v93.16667c0,7.88333 6.45,14.33333 14.33333,14.33333h71.66667c7.88333,0 14.33333,-6.45 14.33333,-14.33333v-93.16667zM64.5,64.5c3.956,0 7.16667,3.21067 7.16667,7.16667v64.5c0,3.956 -3.21067,7.16667 -7.16667,7.16667c-3.956,0 -7.16667,-3.21067 -7.16667,-7.16667v-64.5c0,-3.956 3.21067,-7.16667 7.16667,-7.16667zM107.5,64.5c3.956,0 7.16667,3.21067 7.16667,7.16667v64.5c0,3.956 -3.21067,7.16667 -7.16667,7.16667c-3.956,0 -7.16667,-3.21067 -7.16667,-7.16667v-64.5c0,-3.956 3.21067,-7.16667 7.16667,-7.16667z"></path></g></g></svg></a>

       </div>   
<?php endforeach; ?>       	 
     </div>
</div>

<div class="container ">
  <h3>Dokumentasi KTH Bina Lestari</h3>
<div class="row justify-content-center mt-3">
  <div class="col-lg-6">
    <form method="post" action="" enctype="multipart/form-data">
    <label for="des">Deskripsi</label>
    <textarea name="deskip" id="des" cols="30" rows="5" class="form-control"></textarea>
  </div>
</div>
<div class="row justify-content-center mt-5">
<div class="col-lg-6">
<input type="file" class="custom-file-input" name="img" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
				<label class="custom-file-label" for="inputGroupFile04"><img src="https://img.icons8.com/color/30/000000/picture.png"> Pilih Gambar</label>
  </div>
  <button name="dok" class="btn btn-primary" <?=$dis?>>Simpan</button>
</div>
    </form>
 <!-- gambar -->

 <div class="row mt-5 shadow p-3 mb-5 bg-white rounded" >
    <?php $k=tampil("SELECT * FROM dokumentasi");
 foreach($k as $k):
?>
       <div class="col-lg-6 mt-3 float-left">
            <a href="<?=$k['id']?>" class="btn btn-info">Edit</a>
            <a href="hapus.php?id=<?=$k['id']?>&t=img&f=id&a=layout.php" onclick="return confirm('Apakah anda yakin ingin mengpus data?');" class="btn btn-danger">Hapus</a>
         <img src="<?=$k['tmp'].$k['img'];?>" alt="img" class="img-fluid mt-1">
          <?=$k['deskripsi']?>
       </div>
 <?php endforeach;?>
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
                   <a href="index.php">Administator</a>  
                   ·                     <a href="layout.php">Tampilan</a>
                   ·                     <a href="kth.php">KTH</a>
                   ·                     <a href="#">About</a>
                   ·                     <a href="contac.php">Contact</a> 
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
                    <a href="<?=$row[0]['fb']?>"><i class="fa fa-linkedin"><img src="img/logo/fb.svg" class="img-fluid" style="margin-left: -30px; position: absolute; max-width: 55px; max-height: 32px;" alt="fb"></i></a>                                      
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