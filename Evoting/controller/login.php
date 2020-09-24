<?php 
require "../fungsi/function.php";
session_start();

if(isset($_SESSION["admin"]))
{
		echo"
			<script>
			document.location.href='../index.php';
			</script>
			";
}

 if(isset($_POST['user'])){
	$user=$_POST["user"];
	$psw=$_POST["psw"];
	$mask=true;
	
	// cek dulu username 
	$str="SELECT * FROM admin WHERE username='$user'";
	$cek=cekdb($str);
    
	 if($cek!==1){
		$mask=false;
		echo"
			<script>
			alert('Username Salah!');
			document.location.href='../index.php';
			</script>
			";
	 }
	// cek password
	if($cek==1){
	$tmp=tampil($str);
	//var_dump($tmp);die;
	if(!password_verify($psw,$tmp[0]["password"])){
		$mask=false;
		echo"
			<script>
			alert('Password Salah!');
			document.location.href='../index.php';
			</script>
			";
	}
}
// cek chapca

if($mask){
		// tentukan user admin
            $_SESSION["admin"]=$tmp[0]["password"];
			// masukan user
			echo"
			<script>
			document.location.href='../admin/index.php';
			</script>
			";		
  }
}