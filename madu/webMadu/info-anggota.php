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
//kth
$kth="SELECT * from kth where id_kth='1'";
$tm=tampil($kth);
$namekth=$tm[0]['nama_kth']; 

?>

 <!DOCTYPE html>
<html>
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144107882-1"></script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-144107882-1', { 'optimize_id': 'GTM-WJPRX8P'});
</script>


<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-9732180324344262",
    enable_page_level_ads: true
  });
</script>

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta http-equiv="x-ua-compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="anggota">
<meta name="description" content="Kelompok Tani Hutan Bina Lestari">

<link rel="icon" type="image/png" href="admin/img/logo/<?=$logo?>">
  <title>Anggota Kelompok Tani Hutan Bina Lestari</title>
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
    <span class="bin text-light" style="margin-left:-565px; margin-top:30px; margin-right:300px">Binaan Cabang Dinas Kehutanan Wilayah VII</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        
        <li class="nav-item">
          <a class="nav-link text-warning" href="kth-lestari.php"><?=$namekth;?></a>
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

<section>
    <div class="container topp"> 
          <div class="row justify-content-center"> 
<!-- tabel -->
        <h3 class="mt-3 mb-2">Data Anggota KTH Bina Lestari</h3> 
            <div class="container table-responsive" style="overflow-y: hidden;">
                <div data-role="main" class="ui-content">
                  <table data-role="table" class="table table-sm table-hover table-dark" >
                   <thead>
                    <tr>
                   <th>No</th>
                   <th>NIK</th>
                   <th>Nama</th>
                   <th hidden>Tempat Tgl Lahir</th>
                   <th hidden>Jenis Kelamin</th>
                   <th hidden>Alamat</th>
                   <th hidden>Status</th>
                   <th hidden>Pekrjaan</th>
                   <th>Jumlah Stup</th>
                   <th>Jabatan</th>
                   </tr>
                   </thead>
                   <tbody>
                   <?php 
                   $aa=1;
                   $ku="SELECT * FROM anggota,jabatan where jabatan.id_jabatan=anggota.id_jabatan and id_kth='1'";
                  $ku=tampil($ku);
                   foreach($ku as $u):
                    ?>
                   <tr>
                   <td><?=$aa?></td>
                   <td><?=$u['nik']?></td>
                   <td><?=$u['nama']?></td>
                   <td hidden><?=$u['ttl']?></td>
                   <td hidden><?=$u['jk']?></td>
                   <td hidden><?=$u['alamat']?></td>
                   <td hidden><?=$u['status']?></td>
                   <td hidden><?=$u['pekerjaan']?></td>
                   <td><?=$u['jml_stup']?></td>
                   <td><?=$u['nama_jabatan']?></td>
                   </tr>
                   <?php $aa++; endforeach;?>
                   </tbody>
                  </table>
                </div>
              
          </div>
          </div>
    </div>
</section>



<!-- Modal -->
<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    			: 
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Tempat/Tgl lahir
    			</td>
    			<td>
    			:
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Jenis Kelamin
    			</td>
    			<td>
    			:
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Alamat
    			</td>
    			<td>
    			: 
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Status Perkawinan 
    			</td>
    			<td>
    			:
    			</td>
    		</tr>
    		<tr>
    			<td>
    				Pekerjaan
    			</td>
    			<td>
    			: 
    			</td>
    		</tr>
    		    <tr>
    			<td>
    				Skup yang di miliki
    			</td>
    			<td>
    			: 
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
                   ·                     <a href="kth-lestari.php">Bina Lestari</a>
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
                   <p><span>Kelompok Tani Hutan</span> Bina Lestari</p>                 
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