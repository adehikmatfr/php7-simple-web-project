<?php
session_start();
require "sql/index.php";
require "validasi/index.php";

	//cek cookie
	$admin=md5(1);
	$oprator=md5(2);
	if(isset($_COOKIE['72d4b2a056788e501159c1671c272d74'])){
		if($_COOKIE['72d4b2a056788e501159c1671c272d74']==$admin){
			echo"
			<script>
			document.location.href='admin/index.php';
			</script> 
			 ";
			}else if($_COOKIE['72d4b2a056788e501159c1671c272d74']==$oprator){
				echo"
				<script>
				document.location.href='oprator/index.php';
				</script> 
				 ";
			}
	}
	// cek session 
	if(isset($_SESSION['user'])&&isset($_SESSION['level'])){
       if($_SESSION['level']==$admin){
				echo"
				<script>
				document.location.href='admin/index.php';
				</script> 
				 ";
			 }else if($_SESSION['level']==$oprator){
				echo"
				<script>
				document.location.href='oprator/index.php';
				</script> 
				 ";
			 }
	}

$js1=0;
$js2=0;
$js3=0;
$dt1=0;$dt2=0;$dt3=0;$dt4=0;$dt5=0;$dt6=0;$dt7=0;$dt8=0;$dt9=0;$dt10=0;
$dt11=0;$dt12=0;$dt13=0;$dt14=0;$dt15=0;$dt16=0;$dt17=0;$dt18=0;$dt19=0;$dt20=0;
$dt21=0;$dt22=0;$dt23=0;$dt24=0;$dt25=0;$dt26=0;$dt27=0;
$dt28=0;
$dt29=0;
$dt30=0;
$dt31=0;
// Grafik
$year=date('Y');
 $jan=tampil("SELECT SUM(jumlah) from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-01-$year'");
 $jan=$jan[0]["SUM(jumlah)"];
 $pjan=cekdb("SELECT * from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-01-$year'");
//  real
$janr=tampil("SELECT SUM(hasil) from panen_real WHERE tgl like '%-01-$year'");
 $janr=$janr[0]["SUM(hasil)"];
 
 $feb=tampil("SELECT SUM(jumlah) from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-02-$year'");
 $feb=$feb[0]["SUM(jumlah)"];
 $pfeb=cekdb("SELECT * from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-02-$year'");
// real
$febr=tampil("SELECT SUM(hasil) from panen_real WHERE tgl like '%-02-$year'");
 $febr=$febr[0]["SUM(hasil)"];

 $mar=tampil("SELECT SUM(jumlah) from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-03-$year'");
 $mar=$mar[0]["SUM(jumlah)"];
 $pmar=cekdb("SELECT * from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-03-$year'");
// real
$marr=tampil("SELECT SUM(hasil) from panen_real WHERE tgl like '%-03-$year'");
 $marr=$marr[0]["SUM(hasil)"];

 $apr=tampil("SELECT SUM(jumlah) from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-04-$year'");
 $apr=$apr[0]["SUM(jumlah)"];
 $papr=cekdb("SELECT * from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-04-$year'");
// real
$aprr=tampil("SELECT SUM(hasil) from panen_real WHERE tgl like '%-04-$year'");
 $aprr=$aprr[0]["SUM(hasil)"];

 $mei=tampil("SELECT SUM(jumlah) from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-05-$year'");
 $mei=$mei[0]["SUM(jumlah)"];
 $pmei=cekdb("SELECT * from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-05-$year'");
// real
$meir=tampil("SELECT SUM(hasil) from panen_real WHERE tgl like '%-05-$year'");
 $meir=$meir[0]["SUM(hasil)"];

 $juni=tampil("SELECT SUM(jumlah) from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-06-$year'");
 $juni=$juni[0]["SUM(jumlah)"];
 $pjuni=cekdb("SELECT * from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-06-$year'");
// real
$junir=tampil("SELECT SUM(hasil) from panen_real WHERE tgl like '%-06-$year'");
 $junir=$junir[0]["SUM(hasil)"];

 $juli=tampil("SELECT SUM(jumlah) from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-07-$year'");
 $juli=$juli[0]["SUM(jumlah)"];
 $pjuli=cekdb("SELECT * from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-07-$year'");
// real
$julir=tampil("SELECT SUM(hasil) from panen_real WHERE tgl like '%-07-$year'");
 $julir=$julir[0]["SUM(hasil)"];

 $agus=tampil("SELECT SUM(jumlah) from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-08-$year'");
 $agus=$agus[0]["SUM(jumlah)"];
 $pagus=cekdb("SELECT * from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-08-$year'");
// real
$agusr=tampil("SELECT SUM(hasil) from panen_real WHERE tgl like '%-08-$year'");
 $agusr=$agusr[0]["SUM(hasil)"];

 $sep=tampil("SELECT SUM(jumlah) from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-09-$year'");
 $sep=$sep[0]["SUM(jumlah)"];
 $psep=cekdb("SELECT * from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-09-$year'");
// real
$sepr=tampil("SELECT SUM(hasil) from panen_real WHERE tgl like '%-09-$year'");
 $sepr=$sepr[0]["SUM(hasil)"];

 $okto=tampil("SELECT SUM(jumlah) from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-10-$year'");
 $okto=$okto[0]["SUM(jumlah)"];
 $pokto=cekdb("SELECT * from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-10-$year'");
// real
$oktor=tampil("SELECT SUM(hasil) from panen_real WHERE tgl like '%-10-$year'");
 $oktor=$oktor[0]["SUM(hasil)"];

 $nov=tampil("SELECT SUM(jumlah) from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-11-$year'");
 $nov=$nov[0]["SUM(jumlah)"];
 $pnov=cekdb("SELECT * from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-11-$year'");
// real
$novr=tampil("SELECT SUM(hasil) from panen_real WHERE tgl like '%-11-$year'");
 $novr=$novr[0]["SUM(hasil)"];

 $des=tampil("SELECT SUM(jumlah) from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-12-$year'");
 $des=$des[0]["SUM(jumlah)"];
 $pdes=cekdb("SELECT * from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%-12-$year'");
//  real
$desr=tampil("SELECT SUM(hasil) from panen_real WHERE tgl like '%-12-$year'");
 $desr=$desr[0]["SUM(hasil)"];

// logo 
$tp="SELECT * FROM logo WHERE untuk='cdk'";
$pt=tampil($tp);
$logo=$pt[0]['nama_logo'];
// jml setup
$st="SELECT * FROM stup";
$jml=cekdb($st);
// jml pemilik stup
$top=cekdb("SELECT * FROM anggota");

if(isset($_GET['bln'])){
$bln=$_GET['bln'];
$ex=explode(',',$bln);
$num=$ex[0];
$set=$ex[1];
$th=date('d-m-Y');
$th=explode('-',$th);
$thn=$th[2];
   if($num<10){
    $num='0'.$num;
	 }
$blnp="-".$num."-".$thn;

$panen=cekdb("SELECT * FROM panen WHERE panen like '%$blnp'");
$pm=tampil("SELECT DISTINCT nama from panen,anggota,stup WHERE anggota.id_anggota=panen.id_anggota and stup.id_stup=panen.id_stup and panen.panen like '%$blnp'");
$hsl=tampil("SELECT SUM(jumlah) from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen like '%$blnp'");
// var_dump($pm);die;
function tgl($date){
	global $blnp;
$complite=$date.$blnp;
 $quer="SELECT SUM(jumlah) from panen,hasil WHERE hasil.id_hasil=panen.id_hasil and panen.panen = '$complite'";
 $sum=tampil($quer);
return $sum[0]["SUM(jumlah)"];
}
$dt1=tgl('01');
$dt2=tgl('02');
$dt3=tgl('03');
$dt4=tgl('04');
$dt5=tgl('05');
$dt6=tgl('06');
$dt7=tgl('07');
$dt8=tgl('08');
$dt9=tgl('09');
$dt10=tgl('10');
$dt11=tgl('11');
$dt12=tgl('12');
$dt13=tgl('13');
$dt14=tgl('14');
$dt15=tgl('15');
$dt16=tgl('16');
$dt17=tgl('17');
$dt18=tgl('18');
$dt19=tgl('19');
$dt20=tgl('20');
$dt20=tgl('20');
$dt21=tgl('21');
$dt22=tgl('22');
$dt23=tgl('23');
$dt24=tgl('24');
$dt25=tgl('25');
$dt26=tgl('26');
$dt27=tgl('27');
$dt28=tgl('28');
$dt29=tgl('29');
$dt30=tgl('30');
$dt31=tgl('31');
// jenis lebah
$nem=tampil("SELECT DISTINCT nama_jenis from jenis");
function jenis($jenis){
global $blnp;
$hs=cekdb("SELECT * FROM panen,stup,jenis where stup.id_stup = panen.id_stup and jenis.id_jenis=stup.id_jenis and panen.panen like '%$blnp' and jenis.nama_jenis='$jenis'");
return $hs;
} 
$seluruh=cekdb("SELECT * FROM panen,stup,jenis where stup.id_stup = panen.id_stup and jenis.id_jenis=stup.id_jenis and panen.panen like '%$blnp'");

$js1=jenis($nem[0]['nama_jenis'])/$seluruh*100;
$js1=round($js1);
$js2=jenis($nem[1]['nama_jenis'])/$seluruh*100;
$js2=round($js2);
$js3=jenis($nem[2]['nama_jenis'])/$seluruh*100;
$js3=round($js3);
// var_dump($nem[1]['nama_jenis']);die;
}

//Panen stup saat ini
date_default_timezone_set('Asia/Jakarta');
$harini=date('d-m-Y');
$co="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND panen.panen='$harini'";
$row=tampil($co);
// var_dump($co);die;	
$jstup=cekdb($co);
$hstup=tampil("SELECT SUM(jumlah) FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND panen.panen='$harini'");
$pmm=tampil("SELECT DISTINCT nama FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND panen.panen='$harini'");
 
$rss=[];

// pencarian panen
if(isset($_POST['cari'])){
	$tgl=$_POST['tgl'];
	$bln=$_POST['bln'];
	$th=$_POST['th'];
	//  pengkondisian 
	if(!empty($tgl)){
		//  cari tanggal 1-9
		 if($tgl<10){
      $tgl='0'.$tgl;
		 }

	}
   //  pengkondisian 
	if(!empty($bln)){
		//  cari tanggal 1-10
		 if($bln<10){
      $bln='0'.$bln;
		 }

	}
	
	// rangkai tgl.bln.th
	if(!empty($tgl)&&!empty($bln)&&!empty($th)){
		$key="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND panen.panen like '$tgl-$bln-$th' ORDER BY panen.panen ASC";
	}else if(!empty($tgl)&&!empty($th)){
		$key="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND panen.panen like '$tgl-%-$th' ORDER BY panen.panen ASC";
	}else if(!empty($bln)&&!empty($th)){
		$key="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND panen.panen like '%-$bln-$th' ORDER BY panen.panen ASC";
	}else if(!empty($tgl)&&!empty($bln)){
		$tglbln=$tgl.'-'.$bln.'-%';
		$key="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND panen.panen like '$tglbln' ORDER BY panen.panen ASC";
	}else if(!empty($tgl)){
		$key="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND panen.panen like '$tgl-%' ORDER BY panen.panen ASC";
	}else if(!empty($bln)){
		$key="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND panen.panen like '%-$bln-%' ORDER BY panen.panen ASC";
	}else if(!empty($th)){
		$key="SELECT * FROM stup,anggota,jenis,panen,hasil WHERE anggota.id_anggota=stup.id_anggota and jenis.id_jenis=stup.id_jenis and stup.id_stup=panen.id_stup and hasil.id_hasil=panen.id_hasil AND panen.panen like '%-$th' ORDER BY panen.panen ASC";
	}
	//query 
$rss=tampil($key);
// cari jumlah stuup yang di panen
$jstp=cekdb($key);
// caripemilik
$strr=str_replace('SELECT * ','SELECT DISTINCT nama ',$key);
$pmmm=tampil($strr);
// cari hasil panen
$strs=str_replace('SELECT * ','SELECT SUM(jumlah) ',$key);
$jmlhs=tampil($strs);
 echo"<script>document.location.href='#i'</script>";
}

//kth
$kt="SELECT * FROM kth where id_kth=1";
$rsu=tampil($kt);
$namekth=$rsu[0]['nama_kth'];

?>

 <!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta http-equiv="x-ua-compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="Jenis Madu: Apis Cerena, Apis Trigona, Apis Dorsata. Produk Madu : KTH Bina Lestari">
<meta name="description" content="Produk Madu Tani Hutan Bina Lestari">

<link rel="icon" type="image/png" href="admin/img/logo/<?=$logo?>">
	<title>Produk Madu Kelompok Tani Hutan Bina Lest</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/lg.css">
	<link rel="stylesheet" type="text/css" href="css/sm.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">


</head>
<body>
<!-- navigasi bar -->
<section>
		<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
			<img src="admin/img/logo/<?=$logo?>" alt="Jabar">
	   <a class="navbar-brand text-danger mb-3" href="index.php">KELOMPOK TANI HUTAN (KTH) <?php echo strtoupper($namekth);?></a>
    <span class="bin text-light" style="margin-left:-580px; margin-top:30px; margin-right:300px">Binaan Cabang Dinas Kehutanan Wilayah VII</span>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      
	      <li class="nav-item">
	        <a class="nav-link text-light" href="kth-lestari.php"><?=$namekth?></a>
	      </li>
		  <li class="nav-item">
	        <a class="nav-link text-warning" href="info-produk.php">Produk Madu</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link text-light" href="login.php">Login</a>
	      </li>
	    </ul>
	  </div>
</nav>
</section>


<section>
	<div class="container topp">
		<div class="card prod">
		  <div class="card-body">
		    <h4 class="card-title">Lebah Madu KTH <?=$namekth?></h4>
		    <h6 class="card-subtitle mb-2 text-muted">Cabang Dinas Kehutanan Wilayah VII</h6>
				<h6><?php if(isset($set)){echo $set.' '.$thn;}?></h6><br>
		   <table>
			 <tr>
		   		<td>
		   			Jumlah Stup
		   		</td>
		   		<td>
		   			: <?=$jml?> Stup
		   		</td>
		   	</tr>
				 <tr>
		   		<td>
		   			Jumlah Pemelihara
		   		</td>
		   		<td>
		   			: <?=$top?> Orang
		   		</td>
		   	</tr>
		   	<tr>
		   		<td>
		   			Jumlah Stup Yang di Panen
		   		</td>
		   		<td>
		   			: <?php if(isset($panen)){echo $panen;}?> Stup
		   		</td>
		   	</tr>
		   	<tr>
		   		<td>
		   			Pemelihara stup Yang di Panen
		   		</td>
		   		<td>
		   			: <span class="text-success"><?php if(isset($pm)){ foreach($pm as $pm){ echo $pm["nama"].', ';}}?></span>
		   		</td>
		   	</tr>

		   	<tr>
		   		<td>
		   			Jumlah minimum Hasil
		   		</td>
		   		<td>
		   			: <?php if(isset($hsl)){ echo $hsl[0]["SUM(jumlah)"];}?> Liter
		   		</td>
		   	</tr>
		   </table>
<br>
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			  	<?php 	
			  	$a=1;
 $bulan=['January','February','Mart','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
 foreach($bulan as $b):
			  	 ?>
			    <li class="breadcrumb-item"><a href="?bln=<?=$a.','.$b?>"><?=$b?></a></li>
			    <?php 	$a++; endforeach; ?>
			  </ol>
			</nav>
		  </div>
		</div>
	</div>
</section>

<section>
<div class="container mt-3">
    <div class="justify-content-center"><h5>Grafik Panen Bulan <?php if(isset($set)){echo $set.' '.$thn;}?></h5></div>
    <div class="row mt-3 mb-5">
       <div class="col-lg-7"><canvas id="mybulan"></canvas>
       <center><small>Tanggal panen Satuan Hasil <span class="text-primary">Liter<span>.</small></center>
       </div>
       <div class="col-lg-5" style="max-height:100%"><canvas id="myjenis"></canvas>
       <center><small>Perbandingan Jenis Lebah yang di panen di Hitung Dalam Persentase (%).</small></center>
       </div>
    </div>
</div>
</section>

<section>
<div class="container">
<nav class="navbar navbar-light bg-light mb-3 mt-4">

<h4>Stup Yang Di Panen Saat ini</h4> 

</nav>
 
 <div class="row">
   <div class="col-lg-4">
	 <b>Pemilik Stup:</b> <?php if(isset($pmm)){ foreach($pmm as $pmm){ echo $pmm["nama"].', ';}}?>
	 </div>
	 <div class="col-lg-4">
	 <b>Jumlah stup :</b> <?=$jstup;?> Stup
	 </div>
	 <div class="col-lg-4">
	 <b>Jumlah Minimum Hasil :</b> <?=$hstup[0]["SUM(jumlah)"];?> Liter
	 </div>
 </div>

<div class="container mt-5">
<div class="pos-f-t">
  <div class="collapse" id="navbarToggleExternal">
    <div class="bg-dark p-4">


<nav class="navbar navbar-light bg-light mb-3 mt-4">
<div class="row">
<div class="col-lg-12">
<h3 class="mt-3 mb-2">Stup Yang Sedang Dipanen Saat ini</h3> 
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
                   <td><?= date('d-m-Y',$u['lebah_masuk'])?></td>
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
  <nav class="navbar navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternal" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon text-light"></span> <span class="text-light">lihat Detail</span>
    </button>
  </nav>
</div>
</div>

</div>

</section>

<section>
<div class="container" id="i">
	<nav class="navbar navbar-light bg-light mb-3 mt-4">

	<h4>Pencarian Panen</h4> 

	</nav>
<form action="" method="post">
<div class="row">
   <div class="col-lg-3">
			<label for="tgl">Pilih Tanggal</label>
			<select name="tgl" id="tgl" class="form-control">
			<option value="">Pilih..</option>
			<?php $q=1; while($q < 32):?>
<option value="<?=$q;?>"><?=$q?></option>
			<?php $q++; endwhile;?>
			</select>
	 </div>
	 <div class="col-lg-3">
	 <label for="bln">Pilih Bulan</label>
			<select name="bln" id="bln" class="form-control">
			<option value="">Pilih..</option>
			<?php $z=1; foreach($bulan as $bl):?>
<option value="<?=$z;?>"><?=$bl?></option>
			<?php $z++; endforeach;?>
			</select>
	 </div>
	 <div class="col-lg-3">
	 <label for="th">Pilih Tahun</label>
			<select name="th" id="th" class="form-control">
			<option value="">Pilih..</option>
			<?php $r=2019; while($r < 2050):?>
<option value="<?=$r;?>"><?=$r?></option>
			<?php $r++; endwhile;?>
			</select>
	 </div>
	  <div class="col-lg-3 mt-2">
		 <button type="submit" name="cari" class="btn btn-primary btn-block mt-4">Cari</button>
		</div>
 </div>
</form>

	<div class="row mt-3">
   <div class="col-lg-4">
	 <b>Pemilik Stup:</b> <?php if(isset($pmmm)){ foreach($pmmm as $pmmm){ echo $pmmm["nama"].', ';}}?>
	 </div>
	 <div class="col-lg-4">
	 <b>Jumlah stup :</b> <?php if(!empty($jstp)): echo $jstp; endif;?> Stup
	 </div>
	 <div class="col-lg-4">
	 <b>Jumlah Minimum Hasil :</b> <?php if(isset($jmlhs)){echo $jmlhs[0]["SUM(jumlah)"];}?> Liter
	 </div>
 </div>

 <div class="container mt-5">
<div class="pos-f-t">
  <div class="collapse" id="navbarToggle">
    <div class="bg-dark p-4">


<nav class="navbar navbar-light bg-light mb-3 mt-4">
<div class="row">
<div class="col-lg-12">
<h3 class="mt-3 mb-2">Stup Yang di Panen <?php if(!empty($tgl)): echo 'Tanggal '.$tgl.' '; endif;?> 
<?php if(!empty($bln)): echo 'Bulan '.$bln; endif;?><?php if(!empty($th)): echo ' Tahun '.$th; endif;?>
</h3> 
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
                   <th>Pemilik</th>
                   <th>Code Stup</th>
                   <th>Jenis Lebah</th>
                   <th>Masuk Lebah</th>
				   <th>Panen</th>
				   <th>Sisa Waktu Panen</th>
                   <th>Hasil Minimum</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php 
					$aa=1;	 
					foreach($rss as $u):
                    ?>
                   <tr>
                   <td><?=$aa?></td>
                   <td><?=$u['nama']?></td>
                   <td><?=$u['code_stup']?></td>
                   <td><?=$u['nama_jenis']?></td>
                   <td><?= date('d-m-Y',$u['lebah_masuk'])?></td>
				   <td><?=$u['panen']?></td>
				   <td><span id="pan<?=$u['id_panen']?>"></span></td>
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
  <nav class="navbar navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon text-light"></span> <span class="text-light">lihat Detail</span>
    </button>
  </nav>
</div>
</div>

</div>
</section>

<section>
<div class="contaier">
<div class="container">
<nav class="navbar navbar-light bg-light mb-3 mt-4">

<h4>Grafik Hasil Panen Tahun <?=$year?></h4> 

</nav>
	 <!-- souce -->
	 <div class="row">
      <div class="col-lg-6" style="max-width:100%; ">
			<canvas id="mypanen"></canvas>
			<small class="text-warning pl-5">Hasil Hitung Sistem di Hitung Dalam Satuan Liter</small>
	 </div>
			<div class="col-lg-6" style="max-width:100%; ">
			<canvas id="myreal"></canvas>
			<small class="text-warning pl-5">Hasil Real Dari Peternak di Hitung Dalam Satuan Liter</small>
			</div>
	 </div>
      <!-- akhir -->
	  <div class="row mt-1">
	  <div class="col-12 text-center">
      Indikasi ketidak sesuaian data hasil panen. <a href="" onclick="alert('Sedang Dalam Proses Pengerjaan!')">Klik di sini</a>
	  </div>
	  </div>
</div>
</section>

<section>
<div class="contaier">
<div class="container">
<nav class="navbar navbar-light bg-light mb-3 mt-4">

<h4>Grafik Panen Tahun <?=$year?></h4> 
</nav>
	 <!-- souce -->
	 <div class="row">
	 <div class="col-lg-12 mb-3" style="max-width:100%; ">
			<canvas id="myhasil"></canvas>
			<small class="text-warning pl-5">Data Menunjukan Berapakali Panen Dalam Satu Bulan Produksi</small>
			</div>
			</div>
      <!-- akhir -->
</div>
</section>

<!-- The content of your page would go here. -->  
<?php 
$str="SELECT * FROM contac WHERE id_con='1'";
$row=tampil($str);
 ?>
<div class="container-fluid bg-dark fote" style="max-width: 100%; height:230px;"> 
       <div class="container bg-dark mt-3"> 
       <footer class="footer-distributed">  
                  <div class="footer-left">  
                    <h3>3A<span>Production</span></h3>  
                     <p class="footer-links"> 
                   <a href="index.php">CDK Wilayah VII</a>  
                   ·                     <a href="kth-lestari.php"><?=$namekth?></a>
                   ·                     <a href="login.php">Login</a>
                     </p>                 
                     <p class="footer-company-name">&copy;PKL 2019 smkn 1 kawali</p>
                     <p class="footer-company-name">Ade Hikmat Pauji R</p>    
                     <p class="footer-company-name">Abdul Aziz</p>
                     <p class="footer-company-name">Agil Gugum G</p> 
                     <p class="footer-company-name">Drs. A.Iman Chandra Margana <span class="text-light">(supervisor)</span></p>                
                 </div>             
                 <div class="footer-center">                 
                  <div>                    
                   <i class="fa fa-map-marker"></i>                     
                   <p><span>Kelompok Tani Hutan</span> <?=$namekth?></p>                 
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
                    <span>Tentang KTH <?=$namekth?></span>                     <?=$row[0]['about']?>                 
                  </p>                 
                  <div class="footer-icons">                                         
                    <a href="<?=$row[0]['fb']?>"><i class="fa fa-linkedin"><img src="https://img.icons8.com/color/48/000000/gmail.png" class="img-fluid" style="margin-left: -20px; max-height: 40px; position: absolute; max-width: 55px; margin-top: -3px;" alt="fb"></i></a>                      
                    <a href="<?=$row[0]['fb']?>"><i class="fa fa-linkedin"><img src="admin/img/logo/fb.svg" class="img-fluid" style="margin-left: -30px; position: absolute; max-width: 55px; max-height: 32px;" alt="fb"></i></a>                                      
                  </div>             
                 </div>         
             </footer>
               </div>
           </div>
<!-- akhir footer -->

</body>

<script src="js/jquery-3.3.1.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery.countdown/jquery.countdown.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="Charts/Chart.js"></script>
<!-- hiung mundur -->
<?php $ke="SELECT * FROM panen";
$tm=tampil($ke);
foreach($tm as $m):
	$ex=explode("-",$m["panen"]);
	$wak=$ex[2]."-".$ex[1]."-".$ex[0];
?>

<script>
$('#pan<?=$m["id_panen"]?>').countdown('<?=$wak?>', function(event){
$(this).html(event.strftime('%w minggu %d hari %H:%M:%S'));
});
</script>

<?php endforeach;?>
<!-- akhir hitung -->

<script>
		var ctx = document.getElementById("mypanen").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["Januari", "February", "Maret", "April","Mei","Juni","juli","Agustus","Sptember","Oktober","November","Desember"],
				datasets: [{
					label: 'liter',
					data: [
				<?=$jan?>, 
				<?=$feb?>, 
				<?=$mar?>, 
				<?=$apr?>,
				<?=$mei?>,
				<?=$juni?>,
				<?=$juli?>,
				<?=$agus?>,
				<?=$sep?>,
				<?=$okto?>,
				<?=$nov?>,
				<?=$des?>
					],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(155, 255, 216, 0.2)',
					'rgba(235, 215, 3, 0.2)',
					'rgba(205, 133, 63, 0.2)',
					'rgba(250, 99, 71, 0.2)',
					'rgba(216, 191, 216, 0.2)',
					'rgba(26, 128, 127, 0.2)',
					'rgba(112, 128, 145, 0.2)',
					'rgba(250, 128, 95, 0.2)'
					],
					borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(155, 255, 216, 1)',
					'rgba(235, 215, 3, 1)',
					'rgba(205, 133, 63, 1)',
					'rgba(250, 99, 71, 1)',
					'rgba(216, 191, 216, 1)',
					'rgba(26, 128, 127, 1)',
					'rgba(112, 128, 145, 1)',
					'rgba(250, 128, 95, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});

		var ct = document.getElementById("myreal").getContext('2d');
		var chart = new Chart(ct, {
			type: 'bar',
			data: {
				labels: ["Januari", "February", "Maret", "April","Mei","Juni","juli","Agustus","Sptember","Oktober","November","Desember"],
				datasets: [{
					label: 'liter',
					data: [
				<?=$janr?>, 
				<?=$febr?>, 
				<?=$marr?>, 
				<?=$aprr?>,
				<?=$meir?>,
				<?=$junir?>,
				<?=$julir?>,
				<?=$agusr?>,
				<?=$sepr?>,
				<?=$oktor?>,
				<?=$novr?>,
				<?=$desr?>
					],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(155, 255, 216, 0.2)',
					'rgba(235, 215, 3, 0.2)',
					'rgba(205, 133, 63, 0.2)',
					'rgba(250, 99, 71, 0.2)',
					'rgba(216, 191, 216, 0.2)',
					'rgba(26, 128, 127, 0.2)',
					'rgba(112, 128, 145, 0.2)',
					'rgba(250, 128, 95, 0.2)'
					],
					borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(155, 255, 216, 1)',
					'rgba(235, 215, 3, 1)',
					'rgba(205, 133, 63, 1)',
					'rgba(250, 99, 71, 1)',
					'rgba(216, 191, 216, 1)',
					'rgba(26, 128, 127, 1)',
					'rgba(112, 128, 145, 1)',
					'rgba(250, 128, 95, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});

		var ctxs = document.getElementById("myhasil").getContext('2d');
		var myCharts = new Chart(ctxs, {
			type: 'line',
			data: {
				labels: ["Januari", "February", "Maret", "April","Mei","Juni","juli","Agustus","Sptember","Oktober","November","Desember"],
				datasets: [{
					label: 'Kali',
					data: [
				<?=$pjan?>, 
				<?=$pfeb?>, 
				<?=$pmar?>, 
				<?=$papr?>,
				<?=$pmei?>,
				<?=$pjuni?>,
				<?=$pjuli?>,
				<?=$pagus?>,
				<?=$psep?>,
				<?=$pokto?>,
				<?=$pnov?>,
				<?=$pdes?>
					],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(155, 255, 216, 0.2)',
					'rgba(235, 215, 3, 0.2)',
					'rgba(205, 133, 63, 0.2)',
					'rgba(250, 99, 71, 0.2)',
					'rgba(216, 191, 216, 0.2)',
					'rgba(26, 128, 127, 0.2)',
					'rgba(112, 128, 145, 0.2)',
					'rgba(250, 128, 95, 0.2)'
					],
					borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(155, 255, 216, 1)',
					'rgba(235, 215, 3, 1)',
					'rgba(205, 133, 63, 1)',
					'rgba(250, 99, 71, 1)',
					'rgba(216, 191, 216, 1)',
					'rgba(26, 128, 127, 1)',
					'rgba(112, 128, 145, 1)',
					'rgba(250, 128, 95, 1)'
					],
					borderWidth: 2
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});

var ctxs = document.getElementById("myjenis").getContext('2d');
		var myCharts = new Chart(ctxs, {
			type: 'pie',
			data: {
                labels: ["Afis Cerana", "Apis Trigona", "Afis Dosta"],
				datasets: [{
					label: 'Kali',
					data: [
				<?=$js1?>, 
				<?=$js2?>, 
				<?=$js3?>
					],
					backgroundColor: [
					'rgba(255, 0, 0, 0.2)',
					'rgba(0, 255, 0, 0.2)',
					'rgba(0, 0, 255, 0.2)'
				
					],
					borderColor: [
					'rgba(216, 191, 216, 1)',
					'rgba(26, 128, 127, 1)',
					'rgba(112, 128, 145, 1)'
					
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});


var ctx = document.getElementById("mybulan").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["1", "2", "3", "4","5","6","7","8","9","10","11","12","13", "14", "15", "16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"],
				datasets: [{
					label: 'Hasil',
					data: [
				<?=$dt1?>, 
				<?=$dt2?>, 
				<?=$dt3?>, 
				<?=$dt4?>,
				<?=$dt5?>,
				<?=$dt6?>,
				<?=$dt7?>,
				<?=$dt8?>,
				<?=$dt9?>,
				<?=$dt10?>,
				<?=$dt11?>,
				<?=$dt12?>,
                <?=$dt14?>, 
				<?=$dt15?>, 
				<?=$dt16?>, 
				<?=$dt17?>,
				<?=$dt18?>,
				<?=$dt19?>,
				<?=$dt20?>,
				<?=$dt21?>,
				<?=$dt22?>,
				<?=$dt23?>,
				<?=$dt24?>,
				<?=$dt25?>,
                <?=$dt26?>,
				<?=$dt27?>,
				<?=$dt28?>,
				<?=$dt29?>,
				<?=$dt30?>,
				<?=$dt31?>
					],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(155, 255, 216, 0.2)',
					'rgba(235, 215, 3, 0.2)',
					'rgba(205, 133, 63, 0.2)',
					'rgba(250, 99, 71, 0.2)',
					'rgba(216, 191, 216, 0.2)',
					'rgba(26, 128, 127, 0.2)',
					'rgba(112, 128, 145, 0.2)',
					'rgba(250, 128, 95, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(155, 255, 216, 0.2)',
					'rgba(235, 215, 3, 0.2)',
					'rgba(205, 133, 63, 0.2)',
					'rgba(250, 99, 71, 0.2)',
					'rgba(216, 191, 216, 0.2)',
					'rgba(26, 128, 127, 0.2)',
					'rgba(112, 128, 145, 0.2)',
					'rgba(250, 128, 95, 0.2)',
                    'rgba(205, 133, 63, 0.2)',
					'rgba(250, 99, 71, 0.2)',
					'rgba(216, 191, 216, 0.2)',
					'rgba(26, 128, 127, 0.2)',
					'rgba(112, 128, 145, 0.2)',
					'rgba(250, 128, 95, 0.2)'
					],
					borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(155, 255, 216, 1)',
					'rgba(235, 215, 3, 1)',
					'rgba(205, 133, 63, 1)',
					'rgba(250, 99, 71, 1)',
					'rgba(216, 191, 216, 1)',
					'rgba(26, 128, 127, 1)',
					'rgba(112, 128, 145, 1)',
					'rgba(250, 128, 95, 1)',
                    'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(155, 255, 216, 1)',
					'rgba(235, 215, 3, 1)',
					'rgba(205, 133, 63, 1)',
					'rgba(250, 99, 71, 1)',
					'rgba(216, 191, 216, 1)',
					'rgba(26, 128, 127, 1)',
					'rgba(112, 128, 145, 1)',
					'rgba(250, 128, 95, 1)',
                    'rgba(205, 133, 63, 1)',
					'rgba(250, 99, 71, 1)',
					'rgba(216, 191, 216, 1)',
					'rgba(26, 128, 127, 1)',
					'rgba(112, 128, 145, 1)',
					'rgba(250, 128, 95, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});


	</script>


</html>