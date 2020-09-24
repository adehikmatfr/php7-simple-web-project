<?php
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

$ql="SELECT * FROM pemilih where status='Belum Vote'";
$qp="SELECT * FROM pemilih where status='Sudah Voting'";
$ck=cekdb($ql);
$ck1=cekdb($qp);
$ck2=cekdb("SELECT * FROM pemilih");
$suaraisi=$ck1/$ck*100;
$suarasisa=100-$suaraisi;
$tmpp=tampil($qp);

if(isset($_POST['all']))
{
$del1="DELETE FROM voting";
$del2="DELETE FROM pemilih";
$del3="DELETE FROM kandidat";
iud($del1);
iud($del2);
iud($del3);
$m="Data Berhasil Di Hapus";
}else if(isset($_POST['tok']))
{
$del="DELETE FROM pemilih";
iud($del);
$m="Data Berhasil Di Hapus";
}else if(isset($_POST['vot']))
{
  $del="DELETE FROM voting";
iud($del);
$m="Data Berhasil Di Hapus";
}else if(isset($_POST['kan']))
{
  $del="DELETE FROM kandidat";
iud($del);
$m="Data Berhasil Di Hapus";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>E-vouting</title>

  <!-- Custom fonts for this template-->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-clipboard-list"></i>
        </div>
        <div class="sidebar-brand-text mx-3">E-voting</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-home"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Master Data
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="kandidat.php">
          <i class="fas fa-user fa-chart-area"></i>
          <span>Kandidat</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="token.php">
          <i class="fas fa-key fa-chart-area"></i>
          <span>Token</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="setting.php">
          <i class="fas fa-chart-area"></i>
          <span>Setting</span></a>
      </li>
      
      <!-- Nav Item - Utilities Collapse Menu -->
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Report
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="report.php">
          <i class="fas fa-report fa-chart-area"></i>
          <span>Report</span></a>
      </li>

     

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
             <div class="align-content-center">
                <a class="" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
            </div>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Main Settings</h1>
          </div>
<form method="post" action="">
          <!-- Content Row -->
          <div class="row">
            <div class="col-lg-12 justify-content-center mb-5">
           <button type="submit" name="all" class="btn btn-danger">Reset All</button>
           <button type="submit" name="vot" class="btn btn-danger">Reset Voute</button>
            <button type="submit" name="kan" class="btn btn-danger">Reset Kandidat</button>
            <button type="submit" name="tok" class="btn btn-danger">Reset Token</button>
            <a href="tx_token.php?id=p">Print Token Purbasora</a>
            <a href="tx_token.php?id=c">Print Token Citrakirana</a>
            <!-- Pending Requests Card Example -->
          </div>
          <?php if(isset($m)):?><?=$m; endif;?>
          </div>
</form>
          <!-- Content Row -->
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; BANTARA SMKN 1 KAWALI 2019 || SQUAD AWI || Mr.A</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
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


</body>

</html>
