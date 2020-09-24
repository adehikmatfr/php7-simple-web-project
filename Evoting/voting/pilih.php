<?php 
require "../fungsi/function.php";
session_start();

if(!isset($_SESSION["voute"]))
{
		echo"
			<script>
			document.location.href='../vouting/index.php';
			</script>
			";
}

$id=$_SESSION["voute"];
$lv=$_SESSION["jk"];

 if($lv=="P")
 {
   $q="SELECT * FROM kandidat WHERE jk='P' order by no_kandidat asc";
 }else{
 	$q="SELECT * FROM kandidat WHERE jk='L' order by no_kandidat asc";
 }

$tm=tampil($q);

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Token</title>

  <!-- Custom fonts for this template-->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

<?php foreach ($tm as $m): ?>
	

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class=" col-lg-4 col-md-3">

        <div class="card o-hidden border-0 shadow-lg my-3">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">

              <div class="col">
                <div class="p-5">
                  <div class="text-center">
                  	<center><h3>NO. <?=$m["no_kandidat"]?></h3></center>
                    <img src="../potos/<?=$m['img']?>" class="img img-fluid mt-3 mb-3">
                  </div>
                  <form class="user" method="post" action="../controller/voute.php">
                  	<center><h5><?=$m["nama"]?></h5></center>
                    <a href="#" data-toggle="modal" data-target="#m<?=$m['id_kandidat']?>" class="btn btn-info btn-block mt-3">Detail</a>
                    <button type="submit" name="id" value="<?=$m['id_kandidat']?>" onclick="return confirm('Apakah Anda Yakin ?')" class="btn btn-block btn-primary">
                      Pilih
                    </button>
                    
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        

      </div>
    </div>

  </div>
<?php endforeach ?>

  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../assets/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../assets/js/demo/chart-area-demo.js"></script>
  <script src="../assets/js/demo/chart-pie-demo.js"></script>

  <!-- Logout Modal-->
  <?php
$tmp=tampil($q);
foreach ($tmp as $t):
  ?>
  <div class="modal fade" id="m<?=$t['id_kandidat']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Kandidat <?=$m['no_kandidat']?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
              Nama  : <?=$t['nama']?>
          <br>Kelas : <?=$m["kelas"]?> <?=$m["jurusan"]?>
          <br>Visi  : <p><?=$m['visi']?></p>
          <br>Misi  : <p><?=$m['misi']?></p>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
<?php endforeach;?>

</body>

</html>