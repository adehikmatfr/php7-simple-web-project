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

if(isset($_POST['bahan'])){

 $nama=tv($_POST["nama"]);
 $wkt=tv($_POST["jangka"]);

$masuk=true;
  $s="SELECT * FROM jenis WHERE nama_jenis='$nama'";

 if(non_karakter($nama)){
      $non_valid="show";
      $massage="Anda hanya Boleh memasukan huruf,angka dan spasi";
      $masuk=false; 
  }else if(cekdb($s)>0){
      $non_valid="show";
      $massage="Nama Jenis Telah Ada";
      $masuk=false;
  }

  if(angka($wkt)){
      $non_valids="show";
      $massages="Anda Hanya boleh Memasukan Angka";
      $masuk=false;
  }

if($masuk){
    $str="INSERT INTO jenis VALUES ('','$nama','$wkt')";
    $rsult=iud($str);
    if($rsult>0){
        $valid="show";
        $vmassage="SELAMAT! $nama telah tersimpan";
      }else{
                $valid="show";
        $vmassage="maaf $nama gagal tersimpan";
      }
  }


}


if(isset($_POST['hasil'])){
$hasil=tv($_POST['jml']);
$tgl=tim('d-m-Y');
$masuk=true;
      if(angka($hasil)){
      $non_vali="show";
      $massag="Anda Hanya boleh Memasukan Angka";
      $masuk=false;
     }
  if($masuk){
    $str="INSERT INTO hasil VALUES ('','$hasil','$tgl')";
    $rsult=iud($str);
    if($rsult>0){
      // update periode
      $h="SELECT * FROM hasil order by id_hasil DESC";
      $has=tampil($h);
      $idmin=$has[0]['id_hasil']-1;
      // var_dump($idmin);die;
      $h.=" WHERE id_hasil='$idmin'";
      $t=tampil($h);
       $tglbaru=$t[0]['periode'].' Sampai '.$tgl;
      iud("UPDATE hasil SET periode='$tglbaru' WHERE id_hasil='$idmin'");
        $valids="show";
        $vmassage="SELAMAT! Data telah tersimpan";
      }else{
                $valid="show";
        $vmassage="maaf Data gagal tersimpan";
      }
  }


}

// edit
if(isset($_POST["edit"])){
$jml=$_POST['jml'];
$id=$_POST['edit'];
$mas=true;
 if(angka($jml)){
   echo"<script>
   alert('yang anda masukan bukan angka');
   </script>";
   $mas=false;
 }
 if($mas){
  $key="UPDATE hasil set jumlah='$jml' WHERE id_hasil='$id'";
  $rss=iud($key); 
  if($rss>0){
    echo"<script>
    alert('Data Berhasil Disimpan');
    document.location.href='pengaturan.php';
    </script>";
   }else{
    echo"<script>
    alert('Data Gagal Disimpan');
    document.location.href='pengaturan.php';
    </script>";
   }
 }
}

// edit bahan
if(isset($_POST['ebahan'])){
$nama=$_POST['nama'];
$bahan=$_POST['jangka'];
$id=$_POST['ebahan'];
$mask=true;
   if(empty($nama)){
    echo"<script>
    alert('Nama Bahan Tidak Boleh Kosong');
    </script>";
    $mask=false;
   }
   if(angka($bahan)){
    echo"<script>
    alert('Jangka Waktu yang Anda isi bukan angka');
    </script>";
    $mask=false;
   }
   if($mask){
$str="UPDATE jenis SET nama_jenis='$nama', jangka_panen='$bahan' WHERE id_jenis='$id'";
  $rs=iud($str);
     if($rs>0){
      echo"<script>
      alert('Data Berhasil Disimpan');
      document.location.href='pengaturan.php';
      </script>";
     }else{
      echo"<script>
      alert('Data Gagal Disimpan');
      document.location.href='pengaturan.php';
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
          <a class="nav-link text-warning" href="pengaturan.php">Pengaturan</a>
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
    <h3>Jenis Lebah</h3>
  </div>
 </div>
<form action="" method="post">
          <div class="row justify-content-center mt-3 form-group">

              <div class="col-lg-3">
               <label for="sel">Jenis Lebah</label>
               <input type="text" name="nama" class="form-control" placeholder="Masukan Jenis Lebah" required>
          <!-- alert -->
       <?php if(isset($non_valid)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Opss !</strong> <?=$massage ?>.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
     <?php endif; ?>
      <!-- alert -->
             </div>
             <div class="col-lg-3">
               <label for="sel">Jangka Panen</label>
               <input type="text" name="jangka" class="form-control" placeholder=" Masukan Jangka Waktu Panen" required>
          <!-- alert -->
       <?php if(isset($non_valids)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Opss !</strong> <?=$massages ?>.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
     <?php endif; ?>
      <!-- alert -->
             </div>

            <div class="col-lg-3 mt-2">
              <button type="submit" name="bahan" class="btn btn-primary btn-block mt-4">Simpan</button>
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
<div class="row justify-content-center form-group mt-3"> 
  <div class="col-sm">
    <h3>Hasil Minimum Panen</h3>
  </div>
 </div>
<form action="" method="post">
          <div class="row justify-content-center mt-3 form-group">

              <div class="col-lg-3">
               <label for="sel">Masukan Hasil</label>
               <input type="text" name="jml" class="form-control" placeholder="Masukan Minimum Hasil" required>
                         <!-- alert -->
       <?php if(isset($non_vali)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Opss !</strong> <?=$massag ?>.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
     <?php endif; ?>
      <!-- alert -->
             </div>

            <div class="col-lg-3 mt-2">
              <button type="submit" name="hasil" class="btn btn-primary btn-block mt-4">Simpan</button>
                      <!-- alert -->
       <?php if(isset($valids)): ?>
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
 <div class="container mt-5">
<div class="pos-f-t">
  <div class="collapse" id="daftaranggota">
    <div class="bg-dark p-4">


<nav class="navbar navbar-light bg-light mb-3 mt-4">
<div class="row">
<div class="col-lg-12">
<h4>Minimum Hasil Panen</h4>
</div>
  </div>
  </nav>

<!-- tabel -->
            <div class="container table-responsive" style="overflow-y: hidden;">
                <div data-role="main" class="ui-content">
                  <table data-role="table" class="table table-sm table-hover table-dark" >
                   <thead>
                   <tr>
                   <th>No</th>
                   <th>Periode</th>
                   <th>Jumlah</th>
                   <th>Aksi</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php 
                   $ab=1;
                   $kuk="SELECT * FROM hasil limit 12";
                  $kuu=tampil($kuk);
                
                   foreach($kuu as $u):
                    ?>
                   <tr>
                   <td><?=$ab?></td>
                   <td><?=$u['periode']?></td>
                   <td><?=$u['jumlah']?> Liter</td>
                   <td><a href=""  data-toggle="modal" data-target="#dat<?=$u['id_hasil']?>" class="btn btn-info ml-3 btn-sm">Edit</a></td>
                   </tr>
                   <?php $ab++; endforeach;?>
                   </tbody>
                  </table>
                </div>
              
          </div>
          <!-- table -->

        </div>
      </div>
      <nav class="navbar navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#daftaranggota" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon text-light"></span> <span class="text-light">Hasil Minimum</span>
        </button>
      </nav>
    </div>
</div>

           
<div class="row justify-content-center mt-2">
<!-- tabel -->
        <h3 class="mt-3 mb-2">Data Jenis Lebah</h3> 
            <div class="container table-responsive" style="overflow-y: hidden;">
                <div data-role="main" class="ui-content">
                  <table data-role="table" class="table table-sm table-hover table-dark" >
                   <thead>
                   <tr>
                   <th>No</th>
                   <th>Jenis Lebah</th>
                   <th>Lama Panen</th>
                   <th>Aksi</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php 
                   $aa=1;
                   $ku="SELECT * FROM jenis limit 5";
                  $ku=tampil($ku);
                   foreach($ku as $u):
                    ?>
                   <tr>
                   <td><?=$aa?></td>
                   <td><?=$u['nama_jenis']?></td>
                   <td><?=$u['jangka_panen']?> Bulan</td>
                   <td>
                   <a href=""  data-toggle="modal" data-target="#bah<?=$u['id_jenis']?>" class="btn btn-info ml-3 btn-sm">Edit</a></td>
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
<div class="container-fluid bg-dark" style="max-width: 100%; height:200px; margin-top: 200px;"> 
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
$roh="SELECT * FROM hasil";
$tpp=tampil($roh);
foreach($tpp as $w):?>
<div class="modal fade bg-dark" id="dat<?=$w['id_hasil'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Hasil <?=$w['periode']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

 <form action="" method="post">
          <div class="row justify-content-center mt-3 form-group"> 

          <div class="col-lg-3">
               <label for="sel">Masukan Hasil</label>
               <input type="text" name="jml" class="form-control" value="<?=$w['jumlah']?>" placeholder="Masukan Minimum Hasil" required>
             </div>
      
      </div>  
      <div class="modal-footer mt-5">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" value="<?=$w['id_hasil']?>" name="edit">Simpan</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php endforeach;?>

<!-- Modal kth -->
<?php 
$ro="SELECT * FROM jenis";
$tpp=tampil($ro);
foreach($tpp as $w):?>
<div class="modal fade bg-dark" id="bah<?=$w['id_jenis'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Lebah <?=$w['nama_jenis']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

 <form action="" method="post">
          <div class="row justify-content-center mt-3 form-group"> 

          <div class="col-lg-3">
               <label for="sel">Jenis Lebah</label>
               <input type="text" name="nama" class="form-control" value="<?=$w['nama_jenis']?>" placeholder="Masukan Minimum Hasil" required>
             </div>
             <div class="col-lg-3">
               <label for="sel">Jangka Panen</label>
               <input type="text" name="jangka" class="form-control" value="<?=$w['jangka_panen']?>" placeholder="Masukan Minimum Hasil" required>
             </div>
      
      </div>  
      <div class="modal-footer mt-5">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" value="<?=$w['id_jenis']?>" name="ebahan">Simpan</button>
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