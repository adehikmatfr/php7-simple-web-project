<?php
require "../fungsi/program.php";
require "../fungsi/function.php";

session_start();

if(!isset($_SESSION["admin"]))
{
    echo"
      <script>
      document.location.href='../index.php';
      </script>
      ";
}
 
function tv($a)
{
    return htmlspecialchars($a);
}

if(isset($_POST["nama"])!="")
{
  	$nama=tv($_POST["nama"]);
  	$jk=tv($_POST["jk"]);
  	$kelas=tv($_POST["kelas"]);
  	$jurusan=tv($_POST["jurusan"]);
  	$urutan=tv($_POST["urutan"]);
  	$calon=tv($_POST["no_calon"]);
  	$visi=tv($_POST["visi"]);
  	$misi=tv($_POST["misi"]);

	if($_POST["btn"]=="1ins")
	{
    $up=uploaded();
    // var_dump($up);die;
     	if($up==false)
  		{
    		echo "<script>
    		document.location.href='../admin/kandidat.php';
    		</script>";
  		}
  		$q="INSERT INTO kandidat values('','$calon','$nama','$jk','$kelas','$jurusan $urutan','$visi','$misi','$up','')";
  		if(iud($q))
  		{
		echo "<script>alert('Data Berhasil Disimpan!');
			document.location.href='../admin/kandidat.php';
			</script>";
  		}
  		else
  		{
			echo "<script>alert('Data Gagal Disimpan!');
			document.location.href='../admin/kandidat.php';
			</script>";
  		}
	}
	else
	{
		$id=$_POST["id"];
		$img=uploaded();
		$q="UPDATE kandidat SET no_kandidat='$calon',nama='$nama',jk='$jk',kelas='$kelas',jurusan='$jurusan $urutan',visi='$visi',misi='$misi',img='$img' where id_kandidat='$id'"; 
   	if(iud($q))
   	   {
   echo "<script>alert('Data Berhasil Di Ubah!');
			document.location.href='../admin/kandidat.php';
			</script>";
	   }
	else
		{
		echo "<script>alert('Data Gagal Di Ubah!');
			document.location.href='../admin/kandidat.php';
			</script>";
		}
	}
   
}

if(isset($_GET["id"])!="")
{
  $id=tv($_GET["id"]);
   $q="DELETE from kandidat where id_kandidat='$id'"; 
   if(iud($q))
   {
   echo "<script>alert('Data Berhasil Di Hapus!');
			document.location.href='../admin/kandidat.php';
			</script>";
   }
	else
	{
		echo "<script>alert('Data Gagal Di Gagal!');
			document.location.href='../admin/kandidat.php';
			</script>";
	}
}

echo "<script>alert('Data Gagal Di Gagal!');
			document.location.href='../admin/kandidat.php';
			</script>";