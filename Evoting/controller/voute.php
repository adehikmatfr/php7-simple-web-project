<?php 
require "../fungsi/function.php";
session_start();


 if(isset($_POST['token'])){
	$tok=$_POST["token"];
	$mask=true;
	
	// cek dulu username 
	$str="SELECT * FROM pemilih WHERE token='$tok'";
	$cek=cekdb($str);
    
	 if($cek!==1){
		$mask=false;
		echo"
			<script>
			alert('Token Salah!');
			document.location.href='../voting/index.php';
			</script>
			";
	 }
	// cek password
	if($cek==1){
	$tmp=tampil($str);
	$tp=$tmp[0]["id_pemilih"];
	$qr="SELECT * FROM voting where id_pemilih='$tp'";
	$cek2=cekdb($qr);
	if($cek2>0)
	{
		$mask=false;
		echo"
			<script>
			alert('Token Sudah Digunakan!');
			document.location.href='../voting/index.php';
			</script>
			";
	}
	//var_dump($tmp);die;
	}
// cek chapca

if($mask){
		// tentukan user admin
            $_SESSION["voute"]=$tmp[0]["id_pemilih"];
			$_SESSION["jk"]=$tmp[0]["lv"];
			// masukan user
			echo"
			<script>
			document.location.href='../voting/pilih.php';
			</script>
			";		
  }
}


if(isset($_SESSION['voute'])&&isset($_POST['id']))
{
	$idu=$_SESSION['voute'];
	$idp=$_POST['id'];
  $q="INSERT INTO voting values('','$idu','$idp',1)";
  $u="UPDATE pemilih set status='Sudah Voting' where id_pemilih='$idu'";
 
  if(iud($q))
  {
    iud($u);
    echo   "<script>
			alert('Terimakasih Sudah Memilih :)');
			document.location.href='../voting/destroy.php';
			</script>
			";	
  }else
  {
  	echo   "<script>
			alert('Ada Kesalahan Saat Voting');
			document.location.href='../voting/index.php';
			</script>
			";	
  }

}