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


$e="";
// logo 
$tp="SELECT * FROM logo WHERE untuk='cdk'";
$pt=tampil($tp);
$logo=$pt[0]['nama_logo'];

$dis="disabled";
if(isset($_POST['selp'])){

$ex=explode(',', $_POST['nikk']);

$id=$ex[0];
$_SESSION['id']=$id;
$ss="SELECT * FROM stup WHERE id_anggota='$id' order by id_stup ASC";

  if(empty($ex[0])){
      $d="show";
      $e="Anda Belum Memilih";
  }else{
      $d="show";
      $e="Anda Memilih $ex[1]";
      $dis="";
    }

}

if (isset($_POST['simpan'])) {
  $id=$_SESSION['id'];
  $stup=$_POST['code'];
  $lebah=$_POST['lebah'];
  // validasi
 $mask=true; 
  if(empty($stup)){
      $c="show";
      $ee="Anda Belum Memilih Code Stup";
      $mask=false;
  }
  if(empty($lebah)){
      $mm="show";
      $e="Anda Belum Mengisi Tanggal Masuk Lebah";
      $mask=false;
  }
  // tentukan waktu panen
       if($mask){
$str="SELECT * FROM stup,jenis,anggota WHERE jenis.id_jenis=stup.id_jenis and anggota.id_anggota='$id' and stup.id_stup='$stup'";
 $rss=tampil($str);
 // ambil jangka panen
 
 $panen=$rss[0]["jangka_panen"];
 // pecah waktu masuk lebah
 $msklebah=strtotime($lebah);
 // tentukan bulan panen
 $wktpanen=date('d-m-Y',$msklebah+3600*24*30*$panen);
//  lihat panen ke berapa
$s="SELECT * FROM panen WHERE id_stup='$stup'";
$res=tampil($s);
if($res==[]){
$per=1;
}else{
  $per=$res[0]['panen_ke']+1;
}
// var_dump($res['panen_ke']);die;
// ambil hasil
$h="SELECT id_hasil FROM hasil order by id_hasil desc";
$has=tampil($h);
$hasil=$has[0]["id_hasil"];
// jika sudah masukan ke dalam database
     $ins="INSERT INTO panen VALUES ('','$id','$stup','$msklebah','$wktpanen','$hasil','$per',1)";
   $msk=iud($ins);
   if($msk>0){
       $di="show";
      $ei="Wilujeng Data Berhasil Di Simpen";
   }else{
      $di="show";
      $ei=" Data Gagal Di Simpen";
   }
 }
}
// edit

if (isset($_POST['edit'])) {
  $id=$_POST['edit'];
  $lebah=$_POST['lebah'];
// pecah id stup dan id panen
  $exe=explode(',', $id);
  $idpanen=$exe[0];
  $idstup=$exe[1];
  // tentukan waktu panen
$str="SELECT * FROM stup,jenis WHERE jenis.id_jenis=stup.id_jenis and id_stup='$idstup'";
 $rss=tampil($str);
 // ambil jangka panen
 $panen=$rss[0]["jangka_panen"];
// rangkai kembali tgl
$lebah=strtotime($lebah);
$wktpanen=date('d-m-Y',$lebah+3600*24*30*$panen);
// dapatkan hasil panen yang sudah di tetapkan
     $hasil=tampil("SELECT * FROM hasil order by id_hasil DESC");
     $hasil=$hasil[0]['jumlah'];
// jika sudah masukan ke dalam database
     $ins="UPDATE panen SET lebah_masuk='$lebah',panen='$wktpanen' WHERE id_panen='$idpanen'";
   $msk=iud($ins);

   if($msk>0){
echo "<script>
       alert('Data Berhasil Disimpen');
       document.location.href='panen.php';
     </script>";
   }else{
echo "<script>
       alert('Data Gagal Disimpen');
       document.location.href='panen.php';
     </script>";
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
          <a class="nav-link text-warning" href="panen.php">Panen</a>
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
    <h3>Panen Madu</h3>
  </div>
  Peringatan : <span class="text-warning">Jika Stup di regis di sini maka pemilik stup tidak dapat mengirim laporan pemeliharaan dan data panen real.</span>
 </div> 
 <form action="" method="post">
          <div class="row justify-content-center mt-3"> 

             <div class="col-lg-3">
               <label for="sel">Pilih Pemilik</label>
               <select name="nikk" id="sel" class="form-control">
                 <option value="">Pilih....</option>
                 <?php 
                  $s="SELECT DISTINCT nama, anggota.id_anggota FROM anggota,stup where (anggota.id_anggota=stup.id_anggota) order by anggota.nama ASC";
                  $rss=tampil($s);
                  foreach($rss as $r):
                  ?>
                  <option value="<?=$r['id_anggota']?>,<?=$r['nama']?>"><?=$r['nama']?></option>
                <?php endforeach; ?>
               </select>
               <button type="submit" class="btn btn-success mt-2" name="selp">Submit</button>
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
               <select name="code" id="sell" class="form-control" <?=$dis?> >
                 <option value="">Pilih....</option>
                 <?php 
                  $rsss=tampil($ss);
                  foreach($rsss as $rr):
                  ?>
                  <option value="<?=$rr['id_stup']?>"><?=$rr['code_stup']?></option>
                <?php endforeach; ?>
               </select>
                           <!-- alert -->
       <?php if(isset($c)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?=$ee ?>.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
     <?php endif; ?>
      <!-- alert -->
             </div>
              
             <div class="col-lg-3">
               <label for="cod">Masuk Lebah</label>
               <input type="date" name="lebah" class="form-control" placeholder="Pilih masuk Lebah" <?=$dis?> >
                           <!-- alert -->
       <?php if(isset($mm)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?=$e ?>.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
     <?php endif; ?>
      <!-- alert -->
             </div>


            <div class="col-lg-3 mt-2">
              <button type="submit" name="simpan" class="btn btn-primary btn-block mt-4" <?=$dis?> >Simpan</button>
      <!-- alert -->
       <?php if(isset($di)): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?=$ei ?>.
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
            
              <input class="form-control mr-sm-2" type="search" placeholder="Masukan Data Pencarian" aria-label="Search" id="car">
              <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
           
           </div>
           </div>

<div class="row justify-content-center mt-2" id="cont">
<!-- tabel -->
        <h3 class="mt-3 mb-2">Data Panen</h3> 
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
                   <th>Sisa Waktu Panen</th>
                   <th>Panen</th>
                   <th>Hasil Minimum</th>
                   <th>Aksi</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php 
                   $aa=1;
                   $ku="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil ORDER BY panen.id_panen DESC limit 50";
                  $ku=tampil($ku);
                   foreach($ku as $u):
                    ?>
                   <tr>
                   <td><?=$aa?></td>
                   <td><?=$u['nama']?></td>
                   <td><?=$u['code_stup']?></td>
                   <td><?=$u['nama_jenis']?></td>
                   <td><?= date('d-m-Y',$u['lebah_masuk'])?></td>
                   <td><span id="pan<?=$u['id_panen']?>"></span></td>
                   <td><?= $u['panen']?></td>
                   <td><?=$u['jumlah']?> Liter</td>
                    <td>
<a href="hapus.php?id=<?=$u['id_panen']?>&t=panen&f=id_panen&a=panen.php" onclick="return confirm('Apakah anda yakin ingin mengpus data?');" class="btn btn-danger btn-sm">hapus</a>
        <a href=""  data-toggle="modal" data-target="#dat<?=$u['id_panen']?>" class="btn btn-info ml-1 btn-sm">Edit</a>
      <!-- <a href="../qr.php?id_u=<?=$u['nik']?>&id_s=<?=$u['id_stup']?>&n=<?=$u['nama']?>&c=<?=$u['code_stup']?>&b=<?=$u['nama_bahan']?>&l=<?=$u['lebah_masuk']?>&p=<?=$u['panen']?>"  onclick="return confirm('Apakah anda Ingin Mengunduh Code QR?');" class="btn ml-1 btn-info btn-sm">QR</a>             -->
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
$roh="SELECT * FROM panen,stup,anggota WHERE anggota.id_anggota=panen.id_anggota and stup.id_stup=panen.id_stup";
$tpp=tampil($roh);
foreach($tpp as $w):?>
<div class="modal fade bg-dark" id="dat<?=$w['id_panen'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Panen <?=$w['nama']?> Code Stup <?=$w['code_stup']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<div class="modal-body">
 <form action="" method="post">
          <div class="row justify-content-center mt-3 form-group"> 

             <div class="col-lg-6">
               <label for="bah">Masuk Lebah</label>
               <input type="date" name="lebah" class="form-control" id='bah' placeholder="Pilih masuk Lebah" required >
             </div>
      
      </div> 
</div>       
      <div class="modal-footer mt-5">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" value="<?=$w['id_panen'].','.$w['id_stup']?>" onclick="return confirm('Apakah Anda Yakin?')" name="edit">Simpan</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php endforeach;?>


</body>

<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/ajax1.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
<script src="../js/jquery.countdown/jquery.countdown.min.js"></script>

<!-- hiung mundur -->
<?php $ke="SELECT * FROM panen";
$tm=tampil($ke);
foreach($tm as $m):
  $wak=strtotime($m['panen']);
  $wak=date('Y-m-d',$wak);
?>

<script>
$('#pan<?=$m["id_panen"]?>').countdown('<?=$wak?>', function(event){
$(this).html(event.strftime('%w minggu %d hari %H:%M:%S'));
});
</script>

<?php endforeach;?>
<!-- akhir hitung -->
</html>