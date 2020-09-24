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


if(isset($_GET['u'])&&isset($_GET['s'])){
     
     $idu=base64_decode($_GET['u']);
     $ids=base64_decode($_GET['s']);
     $_SESSION['u']=$_GET['u'];
     $_SESSION['s']=$_GET['s'];
     // menampilkan nama dan kode stup
     $str="SELECT * FROM anggota,stup WHERE anggota.id_anggota=stup.id_anggota and anggota.id_anggota='$idu' and stup.id_stup='$ids'";
     $rss=tampil($str);
     // cari apakah masuk lebah atau belum
     $s="SELECT * FROM panen where id_stup='$ids' order by id_panen DESC";
      $rs=tampil($s);
      $per=$rs[0]['role_id'];
      $nen=strtotime($rs[0]['panen']);
      if($rs==[]||$per==1){
      $pesan="Silahkan Masuk Dengan Nomer Token! Kemudian mulai Membuat Laporan Masuk Lebah.";
      $_SESSION['awal']=true;
      $_SESSION['pelihara']=false;
      $_SESSION['panen']=false;
      }else if($nen<=time()&&$per==0){
           echo"<script>alert('Waktunya Panen !')</script>";
         $pesan="Waktunya Panen!";
         $_SESSION['awal']=false;
         $_SESSION['pelihara']=false;
         $_SESSION['panen']=true;
      }else if($per==0){
      $pesan="Silahkan Masuk Untuk Memulai Pemeliharaan.";
      $_SESSION['awal']=false;
      $_SESSION['pelihara']=true;
      $_SESSION['panen']=false;
      }
}else{
     echo"<h1>Punten.. Ngiring ngalangkung :D</h1>";
     exit;
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
<section>
		<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
			<img src="../admin/img/logo/<?=$logo?>" alt="jabar">
 <a class="navbar-brand text-danger mb-3" href="index.php">KELOMPOK TANI HUTAN (KTH) <?=$namekth;?></a>
    <span class="bin text-light" style="margin-left:-550px; margin-top:30px; margin-right:300px">Binaan Cabang Dinas Kehutanan Wilayah VII</span>
</nav>
</section>
<!-- content -->
<section>
 <div class="container topp">
   <h1 class="text-muted">Sampurasun Baraya...</h1>
   <h6 class="text-warning"><?=$pesan?></h6>
   Klik masuk untuk memulai <a href="login.php">masuk</a><br>
   <small><a href="">www.binalestari.rf.gd</a></small>
   <div class="row mt-5">
        <div class="col-lg-12 text-center">
           <h5> Data Stup Bapak <?=$rss[0]['nama']?> Code Stup <?=$rss[0]['code_stup']?> </h5>
        </div>
   </div>

   <div class="row">
        <div class="col-lg-12">
         <div class="container table-responsive" style="overflow-y: hidden;">
                <div data-role="main" class="ui-content">
                <table data-role="table" class="table table-sm table-hover table-dark" >
                   <thead>
                   <tr>
                   <th>No</th>
                   <th>Jenis Lebah</th>
                   <th>Masuk Lebah</th>
                   <th>Sisa Waktu panen</th>
                   <th>Panen</th>
                   <th>Hasil Minimum</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php 
                         $aa=1;
                    $key="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND stup.id_stup='$ids' ORDER BY id_panen DESC";
                    $u=tampil($key); 
if($u!=[]):    	
                    ?>
                   <tr>
                   <td><?=$aa?></td>
                   <td><?=$u[0]['nama_jenis']?></td>
                   <td><?=date('d-m-Y',$u[0]['lebah_masuk'])?></td>
                   <td><span id="pan"></span></td>
                   <td><?=$u[0]['panen']?></td>
                   <td><?=$u[0]['jumlah']?> Liter</td>
                   </tr>
<?php endif;?>
                   </tbody>
                  </table>
                </div>
         </div>
        </div>
   </div>

   <div class="row mt-3">
        <div class="col-lg-12">
         <div class="container table-responsive" style="overflow-y: hidden;">
         <h5>Data Panen</h5>
                <div data-role="main" class="ui-content">
                <table data-role="table" class="table table-sm table-hover table-dark" >
                   <thead>
                   <tr>
                   <th>No</th>
                   <th>Jenis Lebah</th>
                   <th>Masuk Lebah</th>
                   <th>Perkiraan Panen</th>
                   <th>Panen</th>
                   <th>Hasil Minimum</th>
                   <th>Hasil Real</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php 
                         $ax=1;
                    $ko="SELECT DISTINCT (panen_real.id_p),jenis.nama_jenis,panen.lebah_masuk,panen.panen,panen_real.tgl,hasil.jumlah,panen_real.hasil FROM stup,anggota,jenis,panen,hasil,panen_real WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND stup.id_stup=panen_real.id_stup AND stup.id_stup='$ids' AND panen.panen_ke=panen_real.periode ORDER BY id_panen DESC";
                    $xx=tampil($ko);
                    foreach($xx as $x):     	
                    ?>
                   <tr>
                   <td><?=$ax?></td>
                   <td><?=$x['nama_jenis']?></td>
                   <td><?=date('d-m-Y',$x['lebah_masuk'])?></td>
                   <td><?=$x['panen']?></td>
                   <td><?=$x['tgl']?></td>
                   <td><?=$x['jumlah']?> Liter</td>
                   <td><?=$x['hasil']?> Liter</td>
                   </tr>
                   <?php $ax++; endforeach;?>
                   </tbody>
                  </table>
                </div>
         </div>
        </div>
   </div>

   <div class="row mt-3">
        <div class="col-lg-12 text-center">
           <h5> Data Riwayat Pemeliharaan </h5>
        </div>
   </div>

   <div class="row">
        <div class="col-lg-12">
         <div class="container table-responsive" style="overflow-y: hidden;">
                <div data-role="main" class="ui-content">
                <table data-role="table" class="table table-sm table-hover table-dark" >
                   <thead>
                   <tr>
                   <th>No</th>
                   <th>Keadaan</th>
                   <th>Keterangan</th>
                   <th>Penanganan</th>
                   <th>Waktu Pemeliharaan</th>
                   <th>Gambar</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php 
                         $pr=$u[0]['panen_ke'];
                         $ab=1;	 
                         $row="SELECT * FROM pemeliharaan WHERE id_stup='$ids' and period='$pr'";
                         $row=tampil($row);
                          foreach($row as $z):
                    ?>
                   <tr>
                   <td><?=$ab?></td>
                   <td><?=$z['keadaan']?></td>
                   <td><?=$z['keterangan']?></td>
                   <td><?=$z['penanganan']?></td>
                   <td><?=date('d-m-Y h:m',$z['waktu']);?> WIB</td>
                   <td><a href="" data-toggle="modal" data-target="#gm<?=$z['id_pemeliharaan']?>">click</a></td>
                   </tr>
                   <?php $ab++; endforeach;?>
                   </tbody>
                  </table>
                </div>
         </div>
        </div>
   </div>
   
    <div class="row mt-5">
    <div class="col-12 text-center">
    <span class="text-warning">&copy 2019 Ade Hikmat FR<br>SMKN 1 KAWAlI</span>
    </div>
    </div>

 </div>
</section>
<!-- akhir content -->

<?php
$ex=explode("-",$u[0]["panen"]);
$wkt=$ex[2]."-".$ex[1]."-".$ex[0];
?>

<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/jquery.countdown/jquery.countdown.min.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
<script>
$('#pan').countdown('<?=$wkt?>', function(event){
$(this).html(event.strftime('%w minggu %d hari %H:%M:%S'));
});
</script>

<?php 
$st="SELECT * FROM pemeliharaan WHERE id_stup='$ids'";
$tmp=tampil($st);
foreach($tmp as $t):
?>
<!-- Modal -->
<div class="modal fade" id="gm<?=$t['id_pemeliharaan']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">KTH Bina Lestari</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>	
      <div class="modal-body">
      <div class="row">
      <div class="col-12 justify-content-center">
       <img src="img/<?=$t['photo']?>" class="img-fluid" alt="img" style="max-width:300px">
       </div>
       </div>
      </div>
	<div class="modal-footer text-left">  
     keterangan : <?=$t['keterangan']?> 
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>

</body>
</html>