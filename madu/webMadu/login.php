<?php
session_start();
	 require "validasi/index.php";
	 require "sql/index.php";
	 require "random/index.php";

// logo 
$tp="SELECT * FROM logo WHERE untuk='cdk'";
$pt=tampil($tp);
$logo=$pt[0]['nama_logo'];
	//  nilai capcha
	$validd=random(6);
	//  Login
	$rem='';

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
             return false;
			}else if($_COOKIE['72d4b2a056788e501159c1671c272d74']==$oprator){
				echo"
				<script>
				document.location.href='oprator/index.php';
				</script> 
				 ";
                 return false;
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

  if(isset($_POST['login'])){
	$user=tv($_POST["username"]);
	$psw=tv($_POST["Password"]);
	$cph=tv($_POST["chap"]);
	$rem=tv($_POST["ingat"]);
	$recph=tv($_POST['v']);
	$mask=true;
	
	// cek dulu username 
	$str="SELECT * FROM users WHERE username='$user'";
	$cek=cekdb($str);
    
	 if($cek!==1){
	  $valid='is-invalid';
		$mask=false;
		$masage="Hapunten Username Lepat!";
		$valus=$user;
	 }
	// cek password
	if($cek==1){
	$tmp=tampil($str);
	$md=md5($psw);
	if($tmp[0]['password']!==$md){
		$valids='is-invalid';
		$mask=false;
		$masages="Hapunten Password Lepat!";
		$valuss=$psw;
	}
}
// cek chapca
if($cph!==$recph){
	$validss='is-invalid';
	$mask=false;
	$masagess="Hapunten teks anu di salin teu sami!";
}

if($mask){
		// tentukan user admin
		if($tmp[0]['level']=='1'){
			//  buat session
			$_SESSION['user']=md5($user);
			$_SESSION['level']=md5($tmp[0]['level']);
			// buat cookie
			if(!empty($rem)){
				$has=md5('maistri');
				setcookie($has,md5($tmp[0]['level']) ,time()+60*5);
			}
			// masukan user
			echo"
			<script>
			document.location.href='admin/index.php';
			</script>
			";
		}else if($tmp[0]['level']=='2'){
    	//  buat session
			$_SESSION['user']=md5($user);
			$_SESSION['level']=md5($tmp[0]['level']);
			// buat cookie
			if(!empty($rem)){
				$has=md5('maistri');
				setcookie($has,md5($tmp[0]['level']) ,time()+60*5);
			}
			// masukan user
			echo"
			<script>
			document.location.href='oprator/index.php';
			</script>
			";
		}
		
}
	
	}

	 ?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta name="viewport" content="width=device-width">
<link rel="icon" type="image/png" href="admin/img/logo/<?=$logo?>">
	<title>Cabang Dinas Kehutanan Wilayah VII</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/lg.css">
	<link rel="stylesheet" type="text/css" href="css/sm.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	
<style type="text/css">
    span.icon::before{
    	content: "";
    	padding:5px;
    	width:45px;
    	height:45px;
        margin-top: -3px;
        margin-left: -7px;
        border-radius: 30%;
    	position: absolute;
    	display: block;
    	background-image: url(admin/img/logo/lo.jpg);
    	background-size: cover;
    }
       span.ico::before{
    	content: "";
    	padding:5px;
    	width:44px;
    	height:44px;
        margin-top: -3px;
        margin-left: -7px;
        border-radius: 30%;
    	position: absolute;
    	display: block;
    	background-image: url(admin/img/logo/go.jpg);
    	background-size: cover;
    }
          span.cp::before{
    	content: "";
    	padding:5px;
    	width:80px;
    	height:45px;
        margin-top: -3px;
        margin-left: -7px;
        border-radius: 30%;
    	position: absolute;
    	display: block;
    	background-image: url(admin/img/logo/cp.png);
    	background-size: cover;
    }
 

</style>

</head>
<body>
<!-- navigasi bar -->
<section>
<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
			<img src="admin/img/logo/<?=$logo?>"> 
            <a class="navbar-brand text-danger mb-3" href="index.php">KELOMPOK TANI HUTAN (KTH) BINALESTARI</a>
    <span class="bin text-light" style="margin-left:-565px; margin-top:30px; margin-right:300px">Binaan Cabang Dinas Kehutanan Wilayah VII</span>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      
	      <li class="nav-item">
	        <a class="nav-link text-light " href="kth-lestari.php">Binalestari</a>
	      </li>
		  <li class="nav-item">
	        <a class="nav-link text-light" href="info-produk.php">Produk Madu</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link text-warning" href="login.php">Login</a>
	      </li>
	    </ul>
	  </div>
</nav>
</section>
<!-- akhir Naigasi bar -->
<section>
	<div class="container card daf topp shadow p-3 mb-5 bg-white rounded">
		<div class="row ">
			<div class="col text-center mt-3">
				<img src="admin/img/logo/user.png" class="img-fluid mb-3" style="max-width: 200px;">
				<h1 class="text-monospace">User Login</h1>
			</div>
		</div>
        <div class="row justify-content-center">
<div class="col-lg-5">
    <form method="post" action="">
        <label for="u">Username</label>
        <span class="icon">	
        <input type="text" value="<?php if(isset($valus)){echo $valus;}?>" name="username" placeholder="Username" id="u" class="form-control" style="padding-left: 3em;" required>
        </span>
          <!-- alert -->
				 <?php if(isset($valid)): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
        <?php if(isset($masage)){ echo $masage;} ?>.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
     <?php endif; ?>
      <!-- alert -->
</div>
</div>
<div class="row mt-2 justify-content-center">
<div class="col-lg-5">
     <label for="p">Password</label>
             <span class="ico">
        <input type="Password" value="<?php if(isset($valuss)){echo $valuss;}?>"  name="Password" placeholder="Passoword" id="p" class="form-control" style="padding-left: 3em;"  required>
    </span>
          <!-- alert -->
					<?php if(isset($valids)): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
        <?php if(isset($masages)){ echo $masages;} ?>.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
     <?php endif; ?>
      <!-- alert -->
</div>
</div>

<div class="row mt-2 justify-content-center"">
<div class="col-lg-5">
     <label for="pp">Chapca</label> 
     <span class="cp">
     <input type="text" name="v" value="<?=$validd?>" style="padding-left: 3em;font-size:30px;text-decoration: line-through;user-select:none;-moz-user-select:none;-ms-user-select:none;-khtml-user-select:none;-webkit-user-select:none" readonly class="form-control exe" required>
      	</span> 
        <input type="text" name="chap" placeholder="Salin Text Diatas" id="pp" class="form-control mt-3 <?=$cap?>" style="padding-left: 2em;" required>
       <!-- alert -->
					<?php if(isset($validss)): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
        <?php if(isset($masagess)){ echo $masagess;} ?>.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
     <?php endif; ?>
      <!-- alert -->
</div>
</div>

<div class="row mt-2 justify-content-center">
<div class="col-lg-5">
			<div class="custom-control custom-checkbox">
				<input type="checkbox" name="ingat" value="ingat" class="custom-control-input" id="customCheck1">
				<label class="custom-control-label" for="customCheck1">Ingat Saya</label>
			</div>
</div>

</div>
<div class="row mt-2 justify-content-center">
<div class="col-lg-5 mb-5">
     <button class="btn btn-primary" name="login">Login</button>
</div>

</div>
		</div>
	</div>
    </form>
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
                   -                     <a href="kth-lestari.php">Bina Lestari</a>
                   -                     <a href="login.php">Login</a>
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
                    <p><a href="../google.com"><?=$row[0]['email']?></a></p>                 
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