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


// logo 
$tp="SELECT * FROM logo WHERE untuk='cdk'";
$pt=tampil($tp);
$logo=$pt[0]['nama_logo'];

//  pelindung
$kades="SELECT * FROM anggota,jabatan,kth WHERE kth.id_kth=anggota.id_kth and jabatan.id_jabatan=anggota.id_jabatan and jabatan.nama_jabatan='Pelindung'";
$p=tampil($kades);

// ketua
$ketua="SELECT * FROM anggota,jabatan,kth WHERE kth.id_kth=anggota.id_kth and jabatan.id_jabatan=anggota.id_jabatan and jabatan.nama_jabatan='Ketua'";
$k=tampil($ketua);
// sekertaris
$sekertaris="SELECT * FROM anggota,jabatan,kth WHERE kth.id_kth=anggota.id_kth and jabatan.id_jabatan=anggota.id_jabatan and jabatan.nama_jabatan='Sekretaris'";
$s=tampil($sekertaris);
// Bendahara
$bendahara="SELECT * FROM anggota,jabatan,kth WHERE kth.id_kth=anggota.id_kth and jabatan.id_jabatan=anggota.id_jabatan and jabatan.nama_jabatan='Bendahara'";
$b=tampil($bendahara);
// kerohanian
$kerohanian="SELECT * FROM anggota,jabatan,kth WHERE kth.id_kth=anggota.id_kth and jabatan.id_jabatan=anggota.id_jabatan and jabatan.nama_jabatan='Seksi Kerohanian'";
$roh=tampil($kerohanian);
// seksi Perencanaan
$perencanaan="SELECT * FROM anggota,jabatan,kth WHERE kth.id_kth=anggota.id_kth and jabatan.id_jabatan=anggota.id_jabatan and jabatan.nama_jabatan='Seksi Perencanaan'";
$ren=tampil($perencanaan);
// seksi Sarana
$sarana="SELECT * FROM anggota,jabatan,kth WHERE kth.id_kth=anggota.id_kth and jabatan.id_jabatan=anggota.id_jabatan and jabatan.nama_jabatan='Seksi Sarana'";
$sara=tampil($sarana);
// seksi Pemasaran
$pemasaran="SELECT * FROM anggota,jabatan,kth WHERE kth.id_kth=anggota.id_kth and jabatan.id_jabatan=anggota.id_jabatan and jabatan.nama_jabatan='Seksi Pemasaran'";
$masar=tampil($pemasaran);
// humas
$humas="SELECT * FROM anggota,jabatan,kth WHERE kth.id_kth=anggota.id_kth and jabatan.id_jabatan=anggota.id_jabatan and jabatan.nama_jabatan='Seksi Humas'";
$h=tampil($humas);

//kth
$kt="SELECT * FROM kth where id_kth=1";
$rsu=tampil($kt);
$namekth=$rsu[0]['nama_kth'];
//jml
$jml="SELECT * FROM anggota";
$jm=cekdb($jml);

?>

 <!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta http-equiv="x-ua-compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="Info KTH Bina Lestari, Kegiatan CDK Will VII , Cabang Dinas Kehutanan Wilayah VII Prov Jabar">
<meta name="description" content="Info Kelompok Tani Hutan Bina Lestari">

<link rel="icon" type="image/png" href="admin/img/logo/<?=$logo?>">
	<title>Informasi Kelompok Tani Hutan Bina Lestari</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/lg.css">
	<link rel="stylesheet" type="text/css" href="css/sm.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">


</head>
<body>
<!-- navigasi bar -->
<section>
		<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
			<img src="admin/img/logo/<?=$logo?>">
	  <a class="navbar-brand text-danger mb-3" href="index.php">KELOMPOK TANI HUTAN (KTH) <?php echo strtoupper($namekth);?></a>
    <span class="bin text-light" style="margin-left:-580px; margin-top:30px; margin-right:300px">Binaan Cabang Dinas Kehutanan Wilayah VII</span>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav"> 
	      <li class="nav-item">
	        <a class="nav-link text-warning" href="kth-lestari.php"><?=$namekth?></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link text-light" href="info-produk.php">Produk Madu</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link text-light" href="login.php">Login</a>
	      </li>
	    </ul>
	  </div>
</nav>
</section>
<!-- akhir Naigasi bar -->
<section class="topp">
<div class="container">
<div class="row justify-content-center mt-5">
 <div class="col-lg-4">
   <h4><font face="Bernard MT Condensed">Selayang Pandang <span class="text-danger">Kampung Madu</span> Kelompok Tani Hutan <?=$namekth?></font></h4>
	 <p class="lead">Desa Banjaranyar terletak di sebelah Selatan Ibukota Kabupaten Ciamis, berbatasan dengan Kabupaten Pangandaran. Salah satu potensi alam yang dihasilkan adalah madu, yang merupakan salah satu produk primadona HHBK (Hasil Hutan Bukan Kayu) di Indonesia. Banyaknya manfaat madu bagi kesehatan, kecantikan dan lain-lain sehingga permintaa pasar terhadap madu alam dan madu budidaya cukup tinggi.
	 </p>
<p class="lead"><b class="text-danger" style="font-size:28px;"><font face="Bernard MT Condensed">Kampung Madu</font></b> Bina Lestari merupakan perkampungan yang di kembangkan di dalamnya budidaya madu. Pembentukan <span class="text-danger"><b>kampung madu</b></span> berawal dari kegiatan pembinaan yang di lakukan oleh Cabang Dinas Kehutanan Wilayah VII, Dinas Kehutanan Provinsi Jawa Barat terhadap Kelompok Tani Hutan Bina Lestari. Kelompok Tani Hutan (KTH) Bina Lestari, yang beralamat di Dusun Sindang Asih, Desa Banjaranya, Kecamatan Banjaranyar, Kabupaten Ciamis, Provinsi Jawa Bara, beranggotakan 56 orang dan di ketuai oleh Bapak Bunyamin.</p>
     <p class="lead">Jenis budidaya madu KTH Bina Lestari Banjaranyar adalah jenis lebah <i>Apis Cerana</i>, <i>Apis Trigona</i>, dan <i>Apis Dorsata</i> dengan pakan dari bunga pohon manggis, durian, kaliandra, kelapa dan bunga matahari.
     </p>
    
 </div>
 <div class="col-lg-4">
   <p class="lead">Sebelum digagas, ide pengembangan kampung budidaya lebah madu terbatas dan hanya di lakukan oleh anggota kelompok. Setelah terbentuk <span class="text-danger"><b>kampung madu</b></span>, anggota masyarakat yang lain tertarik untuk melakukan budidaya lebah madu, dalam hal ini terjadi transfer pengetahuan dan keahlian dari anggota KTH ke masyarakat yang lain.</p>
<p class="lead">Kualitas madu dijamin murni (tidak ada campuran apapun) dikarenakan atas binaan Cabang Dinas Kehutanan Wilayah VII.</p>

   <h4 class="mt-5 text-danger">Pemesanan</h4>
	 <p class="lead">Untuk Pemesanan Madu berkualitas Tinggi,
	 Anda bisa Hubungi Nomor telpon di bawah ini/hubungi email kami!<br>
	 <img src="https://img.icons8.com/color/28/000000/gmail.png"> Kthbinalestari@gmail.com</br>
	 <img src="https://img.icons8.com/dusk/28/000000/phone.png"> Telpon 082318006177
	 </p>
     <img src="img/spam/prod.jpeg" class="img-fluid" style="width:300px; height:300px;"> 

<blockquote class="blockquote text-muted">
  <h6><p class="mb-0">Kemasan Produk Madu Bina Lestari.</p>
  <cite title="Source Title">&copy 2019</cite></h6>
</blockquote>

 </div>
</div>

<div class="row justify-content-center mt-3 mb-4">
<h3>Dokumentasi Kegiatan KTH Bina Lestari</h3>
</div>

<div class="row justify-content-center mt-3 mb-3">
<?php $k=tampil("SELECT * FROM dokumentasi");
 foreach($k as $k):
?>  
    <div class="col-lg-4">
    <img src="img/dokument/<?=$k['img']?>" class="img-fluid" style="max-height:350px;"> 
 <figcaption class="figure-caption"><?=$k['deskripsi']?></figcaption>
    </div>
<?php endforeach;?>
</div>

<h4 class="mt-5 mb-3">Sindangasih Lokasi KTH Bina Lestari</h4>
<div class="row justify-content-center mt-3 mb-5">

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2037.4201682369699!2d108.53602438643559!3d-7.530367577256412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa559f986dbb065e2!2sBina+Lestari+(Kampung+Madu)!5e1!3m2!1sid!2sid!4v1562829345081!5m2!1sid!2sid" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>

</section>
<!-- content -->
<section>
	<div class="container-fluid struktur bg-light">
		<div class="text-center mt-5">
			<br>
			<h3 class="mt-5">STRUKTUR ORGANISASI KELOMPOK TANI HUTAN</h3><br>
			<h3>"KTH BINA LESTARI"</h3><br>
			<h3>DUSUN SINDANG ASIH DESA BANJARANYAR</h3><BR>
			<h3>KEC.BANJARANYAR KAB.CIAMIS</h3>
	<div class="row">
		<!-- row -->
	    <div class="col-lg-12">	
			<div class="card mt-5" style="width: 18rem;">
		  <div class="card-header text-light bg-dark">
		    <h6>PELINDUNG</h6>
		  </div>
		  <ul class="list-group list-group-flush">
		    <li class="list-group-item"><a href="" data-toggle="modal" data-target="#kades" >KEPALA DESA BANJARANYAR</a></li>
		  </ul>
		</div>
		</div>
      </div>
      <!-- ahir row -->
	<div class="row">
		<!-- row -->
	    <div class="col-lg-12">	
			<div class="card mt-5" style="width: 14rem;">
		  <div class="card-header text-light bg-dark">
		     <h6>KETUA</h6>
		  </div>
		  <ul class="list-group list-group-flush">
<li class="list-group-item"><a href="" data-toggle="modal" data-target="#ketua"><?php if(!empty($k)):?><?=strtoupper($k[0]['nama'])?><?php endif;?></a></li>
		  </ul>
		</div>
		</div>
      </div>
      <!-- ahir row -->
      	<div class="row">
		<!-- row -->
	    <div class="col-lg-6">	
			<div class="card mt-5" style="width: 18rem;">
		  <div class="card-header text-light bg-dark">
		    <h6>SEKERTARIS</h6>
		  </div>
		  <ul class="list-group list-group-flush">
		    <li class="list-group-item"><a href="" data-toggle="modal" data-target="#sekertaris"><?php if(!empty($s)):?><?=strtoupper($s[0]['nama'])?><?php endif;?></a></li>
		  </ul>
		</div>
		</div>

	    <div class="col-lg-6">	
			<div class="card mt-5" style="width: 18rem;">
		  <div class="card-header text-light bg-dark">
		     <h6>BENDAHARA</h6>
		  </div>
		  <ul class="list-group list-group-flush">
		    <li class="list-group-item"><a href="" data-toggle="modal" data-target="#bendahara"><?php if(!empty($b)):?><?=strtoupper($b[0]['nama'])?><?php endif;?></a></li>
		  </ul>
		</div>
		</div>

      </div>
      <!-- ahir row -->
	<div class="row">
		<!-- row -->
	    <div class="col-lg-12">	
			<div class="card mt-5" style="width: 18rem;">
		  <div class="card-header text-light bg-dark">
		     <h6>SEKSI-SEKSI</h6>
		  </div>

		</div>
		</div>
      </div>
      <!-- ahir row -->
	<div class="row">
		<!-- row -->
	    <div class="col-lg-3">	
			<div class="card mt-5" style="width: 13rem;">
		  <div class="card-header text-light bg-dark">
		    <h6>SEKSI KEROHANIAN</h6>
		  </div>
		  <ul class="list-group list-group-flush">
		    <li class="list-group-item"><a href="" data-toggle="modal" data-target="#roh"><?php if(!empty($roh)):?><?=strtoupper($roh[0]['nama'])?><?php endif;?></a></li>
		  </ul>
		</div>
		</div>
	    <div class="col-lg-3">	
			<div class="card mt-5" style="width: 13rem;">
		  <div class="card-header text-light bg-dark">
		    <h6>SEKSI PERENCANAAN</h6>
		  </div>
		  <ul class="list-group list-group-flush">
		    <li class="list-group-item"><a href="" data-toggle="modal" data-target="#ren"><?php if(!empty($ren)):?><?=strtoupper($ren[0]['nama'])?><?php endif;?></a></li>
		  </ul>
		</div>
		</div>
	    <div class="col-lg-3">	
			<div class="card mt-5" style="width: 13rem;">
		  <div class="card-header text-light bg-dark">
		    <h6>SEKSI SARANA</h6>
		  </div>
		  <ul class="list-group list-group-flush">
		    <li class="list-group-item"><a href="" data-toggle="modal" data-target="#sara"><?php if(!empty($sara)):?><?=strtoupper($sara[0]['nama'])?><?php endif;?></a></li>
		  </ul>
		</div>
		</div>
	    <div class="col-lg-3">	
			<div class="card mt-5" style="width: 13rem;">
		  <div class="card-header text-light bg-dark">
		    <h6>SEKSI PEMASARAN</h6>
		  </div>
		  <ul class="list-group list-group-flush">
		    <li class="list-group-item"><a href="" data-toggle="modal" data-target="#masar"><?php if(!empty($masar)):?><?=strtoupper($masar[0]['nama'])?><?php endif;?></a></li>
		  </ul>
		</div>
		</div>

      </div>
      <!-- ahir row -->
<div class="row">
		<!-- row -->
	    <div class="col-lg-12">	
			<div class="card mt-5" style="width: 13rem;">
		  <div class="card-header text-light bg-dark">
		     <h6>SEKSI HUMAS</h6>
		  </div>
           <ul class="list-group list-group-flush">
		    <li class="list-group-item"><a href="" data-toggle="modal" data-target="#h"><?php if(!empty($h)):?><?=strtoupper($h[0]['nama'])?><?php endif;?></a></li>
		  </ul>
		</div>
		</div>
			</div> 
</div>	
   </div>
</section>
<!-- akhir konten -->
<!-- hr class="h"></hr>
<span class="v"><img src="img/v.png">aku vertikal</span>
 -->


<!-- Modal -->
<div class="modal fade" id="kades" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">KEPALA DESA BANJARANYAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

 <form method="post" action="">
      <div class="modal-body">
    <div class="row ml-3">
    	<table>
    		<tr>
    			<td>
    				Nama 
    			</td>
    			<td>
    			: <?=$p[0]['nama']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Tempat/Tgl lahir
    			</td>
    			<td>
    			: <?=$p[0]['ttl']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Jenis Kelamin
    			</td>
    			<td>
    			: <?=$p[0]['jk']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Alamat
    			</td>
    			<td>
    			: <?=$p[0]['alamat']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Status Perkawinan 
    			</td>
    			<td>
    			: <?=$p[0]['status']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Pekerjaan
    			</td>
    			<td>
    			: <?=$p[0]['pekerjaan']?>
    			</td>
    		</tr>
    	</table>
    </div>
      </div>
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button> -->
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ketua" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">KETUA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

 <form method="post" action="">
      <div class="modal-body">
    <div class="row ml-3">
    	<table>
    		<tr>
    			<td>
    				Nama 
    			</td>
    			<td>
    			: <?=$k[0]['nama']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Tempat/Tgl lahir
    			</td>
    			<td>
    			: <?=$k[0]['ttl']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Jenis Kelamin
    			</td>
    			<td>
    			: <?=$k[0]['jk']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Alamat
    			</td>
    			<td>
    			: <?=$k[0]['alamat']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Status Perkawinan 
    			</td>
    			<td>
    			: <?=$k[0]['status']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Pekerjaan
    			</td>
    			<td>
    			: <?=$k[0]['pekerjaan']?>
    			</td>
    		</tr>
    	</table>
    </div>
      </div>
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button> -->
      </div>
    </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="sekertaris" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SEKERTARIS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

 <form method="post" action="">
      <div class="modal-body">
    <div class="row ml-3">
    	<table>
    		<tr>
    			<td>
    				Nama 
    			</td>
    			<td>
    			: <?=$s[0]['nama']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Tempat/Tgl lahir
    			</td>
    			<td>
    			: <?=$s[0]['ttl']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Jenis Kelamin
    			</td>
    			<td>
    			: <?=$s[0]['jk']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Alamat
    			</td>
    			<td>
    			: <?=$s[0]['alamat']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Status Perkawinan 
    			</td>
    			<td>
    			: <?=$s[0]['status']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Pekerjaan
    			</td>
    			<td>
    			: <?=$s[0]['pekerjaan']?>
    			</td>
    		</tr>
    	</table>
    </div>
      </div>
			<div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button> -->
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="bendahara" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">BENDAHARA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

			<form method="post" action="">
      <div class="modal-body">
    <div class="row ml-3">
    	<table>
    		<tr>
    			<td>
    				Nama 
    			</td>
    			<td>
    			: <?=$b[0]['nama']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Tempat/Tgl lahir
    			</td>
    			<td>
    			: <?=$b[0]['ttl']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Jenis Kelamin
    			</td>
    			<td>
    			: <?=$b[0]['jk']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Alamat
    			</td>
    			<td>
    			: <?=$b[0]['alamat']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Status Perkawinan 
    			</td>
    			<td>
    			: <?=$b[0]['status']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Pekerjaan
    			</td>
    			<td>
    			: <?=$b[0]['pekerjaan']?>
    			</td>
    		</tr>
    	</table>
    </div>
      </div>
			<div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button> -->
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="roh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">KEROHANIAN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

			<form method="post" action="">
      <div class="modal-body">
    <div class="row ml-3">
    	<table>
    		<tr>
    			<td>
    				Nama 
    			</td>
    			<td>
    			: <?=$roh[0]['nama']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Tempat/Tgl lahir
    			</td>
    			<td>
    			: <?=$roh[0]['ttl']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Jenis Kelamin
    			</td>
    			<td>
    			: <?=$roh[0]['jk']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Alamat
    			</td>
    			<td>
    			: <?=$roh[0]['alamat']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Status Perkawinan 
    			</td>
    			<td>
    			: <?=$roh[0]['status']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Pekerjaan
    			</td>
    			<td>
    			: <?=$roh[0]['pekerjaan']?>
    			</td>
    		</tr>
    	</table>
    </div>
      </div>
			<div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button> -->
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ren" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SEKSI PERRENCANAAN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

			<form method="post" action="">
      <div class="modal-body">
    <div class="row ml-3">
    	<table>
    		<tr>
    			<td>
    				Nama 
    			</td>
    			<td>
    			: <?=$ren[0]['nama']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Tempat/Tgl lahir
    			</td>
    			<td>
    			: <?=$ren[0]['ttl']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Jenis Kelamin
    			</td>
    			<td>
    			: <?=$ren[0]['jk']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Alamat
    			</td>
    			<td>
    			: <?=$ren[0]['alamat']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Status Perkawinan 
    			</td>
    			<td>
    			: <?=$ren[0]['status']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Pekerjaan
    			</td>
    			<td>
    			: <?=$ren[0]['pekerjaan']?>
    			</td>
    		</tr>
    	</table>
    </div>
      </div>
			<div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button> -->
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="sara" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SEKSI SARANA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

			<form method="post" action="">
      <div class="modal-body">
    <div class="row ml-3">
    	<table>
    		<tr>
    			<td>
    				Nama 
    			</td>
    			<td>
    			: <?=$sara[0]['nama']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Tempat/Tgl lahir
    			</td>
    			<td>
    			: <?=$sara[0]['ttl']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Jenis Kelamin
    			</td>
    			<td>
    			: <?=$sara[0]['jk']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Alamat
    			</td>
    			<td>
    			: <?=$sara[0]['alamat']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Status Perkawinan 
    			</td>
    			<td>
    			: <?=$sara[0]['status']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Pekerjaan
    			</td>
    			<td>
    			: <?=$sara[0]['pekerjaan']?>
    			</td>
    		</tr>
    	</table>
    </div>
      </div>
			<div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button> -->
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="masar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SEKSI PEMASARAN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

			<form method="post" action="">
      <div class="modal-body">
    <div class="row ml-3">
    	<table>
    		<tr>
    			<td>
    				Nama 
    			</td>
    			<td>
    			: <?=$masar[0]['nama']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Tempat/Tgl lahir
    			</td>
    			<td>
    			: <?=$masar[0]['ttl']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Jenis Kelamin
    			</td>
    			<td>
    			: <?=$masar[0]['jk']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Alamat
    			</td>
    			<td>
    			: <?=$masar[0]['alamat']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Status Perkawinan 
    			</td>
    			<td>
    			: <?=$masar[0]['status']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Pekerjaan
    			</td>
    			<td>
    			: <?=$masar[0]['pekerjaan']?>
    			</td>
    		</tr>
    	</table>
    </div>
      </div>
			<div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button> -->
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="h" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">HUMAS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

			<form method="post" action="">
      <div class="modal-body">
    <div class="row ml-3">
    	<table>
    		<tr>
    			<td>
    				Nama 
    			</td>
    			<td>
    			: <?=$h[0]['nama']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Tempat/Tgl lahir
    			</td>
    			<td>
    			: <?=$h[0]['ttl']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Jenis Kelamin
    			</td>
    			<td>
					: <?=$h[0]['jk']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Alamat
    			</td>
    			<td>
					: <?=$h[0]['alamat']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Status Perkawinan 
    			</td>
    			<td>
    			: <?=$h[0]['status']?>
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Pekerjaan
    			</td>
    			<td>
    			: <?=$h[0]['pekerjaan']?>
    			</td>
    		</tr>
    	</table>
    </div>
      </div>
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button> -->
      </div>
    </form>
    </div>
  </div>
</div>
<div class=" row justify-content-center mt-5">    
	<a href="info-anggota.php" target="_blank" class="btn btn-info mr-1">Anggota</a>
	   </div>
 </div>

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
<script src="bootstrap/js/bootstrap.js"></script>

</html>