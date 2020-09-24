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
 $no=tv($_POST["nohp"]);
 $em=tv($_POST["email"]);
 $tn=tv($_POST["tentang"]);
 $fb=tv($_POST["fb"]);
    // masukan ke db
    $key="INSERT INTO contac values('','$no','$em','$tn','$fb')";
    $rs=iud($key);
    if($rs>0){
        echo "<script>
    alert('Data berhasil Disimpan');
    document.location.href='contac.php';
    </script>";
    }else{
        echo "<script>
    alert('Data Gagal Disimpan');
    </script>";
    }
}

if(isset($_POST['edit'])){
 $no=tv($_POST["nohp"]);
 $em=tv($_POST["email"]);
 $tn=tv($_POST["tentang"]);
 $fb=tv($_POST["fb"]);
 $id=tv($_POST["edit"]);
    // masukan ke db
    $key="UPDATE contac SET nohp='$no',email='$em',about='$tn',fb='$fb' WHERE id_con='$id'";
   
    $rs=iud($key);
    if($rs>0){
        echo "<script>
    alert('Data berhasil Disimpan');
    document.location.href='contac.php';
    </script>";
    }else{
        echo "<script>
    alert('Data Gagal Disimpan');
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
	        <a class="nav-link text-light" href="layout.php">Tampilan</a>
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
          <a class="nav-link text-warning" href="contac.php">Kontak</a>
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

<div class="container justify-content-center mt-5 mb-5">
     <div class="row justify-content-center">
          <div class="col-lg-4">
         <label for="no"> <img src="https://img.icons8.com/dusk/20/000000/phone.png">  No Telpon </label>
              <input type="text" id="no" name="nohp" class="form-control" placeholder="Nomer Telpon" required>
          </div>
          <div class="col-lg-4"> 
            <label for="email"><img src="https://img.icons8.com/dusk/20/000000/gmail.png"> Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Alamat Email" required>
          </div>
      </div>
           <div class="row justify-content-center">
          <div class="col-lg-4">
            <label for="nos"><img src="https://img.icons8.com/dusk/20/000000/about.png"> Tentang kth</label>
              <input type="text" id="nos" name="tentang" class="form-control" placeholder="Info Kelompok Tani Hutan" required>
          </div>
          <div class="col-lg-4"> 
            <label for="emails"><img src="https://img.icons8.com/office/20/000000/facebook-new.png"> Alamat FB</label>
            <input type="text" id="emails" name="fb" class="form-control" placeholder="Alamat" required>
          </div>
      </div>

      <div class="row justify-content-center">
          <div class="col-lg-4 mt-5">
            <button type="submit" name="simpan" class="btn btn-primary btn-lg btn-block"><img src="https://img.icons8.com/color/30/000000/save.png">Simpan</button>
          </div>
      </div>

<div class="row justify-content-center mt-5">
<!-- tabel -->
            <div class="container table-responsive" style="overflow-y: hidden;">
                <div data-role="main" class="ui-content">
                  <table data-role="table" class="table table-sm table-hover table-dark" >
                   <thead>
                   <tr>
                   <th>No</th>
                   <th>Tlp</th>
                   <th>Email</th>
                   <th>Tentang</th>
                   <th>Fb</th>
                   <th>Aksi</th>

                   </tr>
                   </thead>
                   <tbody>
                   <?php 
                   $aa=1;
                   $ku="SELECT * FROM contac";
                  $ku=tampil($ku);
                   foreach($ku as $u):
                    ?>
                   <tr>
                   <td><?=$aa?></td>
                   <td><?=$u['nohp']?></td>
                   <td><?=$u['email']?></td>
                   <td><?=$u['about']?></td>
                   <td><?=$u['fb']?></td>
                   <td>
                     <a href="" data-toggle="modal" data-target="#data<?=$u['id_con']?>" class="btn btn-info ml-3 btn-sm"><img src="https://img.icons8.com/dusk/30/000000/edit.png"></a>
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

</div>
</section>
</form>
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


<!-- Modal contact -->
<?php 
$rok="SELECT * FROM contac";
$tp=tampil($rok);
foreach($tp as $w):?>
<div class="modal fade bg-dark" id="data<?=$w['id_con'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kontak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

 <form method="post" action="" enctype="multipart/form-data">
          <div class="row justify-content-center mt-3">
          
<div class="row justify-content-center">
          <div class="col-lg-6">
            <label for="no">No Telpon</label>
              <input type="text" id="no" name="nohp" value="<?=$w['nohp']?>" class="form-control" required>
          </div>
          <div class="col-lg-6"> 
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?=$w['email']?>" class="form-control" required>
          </div>
      </div>
           <div class="row justify-content-center">
          <div class="col-lg-6">
            <label for="nos">Tentang kth</label>
              <input type="text" id="nos" name="tentang" value="<?=$w['about']?>" class="form-control" required>
          </div>
          <div class="col-lg-6"> 
            <label for="emails">Alamat FB</label>
            <input type="text" id="emails" name="fb" value="<?=$w['fb']?>" class="form-control" required>
          </div>
      </div>


        </div>
      <div class="modal-footer mt-5">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" value="<?=$w['id_con']?>" name="edit">Simpan</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php endforeach;?>


</body>

<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
</html>