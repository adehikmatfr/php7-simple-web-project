
<?php
require "fungsi/function.php";
// sql303.epizy.com
// epiz_24783301 
// epiz_24783301_evoting

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Report</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class=" col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">

              <div class="col">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Hasil Voteing</h1>
                  </div>
                   <div class="card-body">
                     <canvas id="mypanen"></canvas>

                </div>
                </div>
              </div>
            </div>
          </div>
        

      </div>

    </div>

  </div>

 <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="assets/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="assets/js/demo/chart-area-demo.js"></script>
  <script src="assets/js/demo/chart-pie-demo.js"></script>


<?php 
$q="SELECT * FROM kandidat Order by id_kandidat asc";
$tm=tampil($q);
$tmm=tampil($q);
?>

<script>
    var ctx = document.getElementById("mypanen").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [<?php foreach ($tm as $tm): ?>"<?=$tm['nama']?>",<?php endforeach; ?>],
        datasets: [{
          label: 'Vouting',
          data: [<?php foreach ($tmm as $tm): ?><?=$tm['jml_suara']?>,<?php endforeach; ?>],
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
          'rgba(230, 99, 132, 0.2)',
          'rgba(50, 162, 235, 0.2)',
          'rgba(235, 206, 86, 0.2)',
          'rgba(70, 192, 192, 0.2)',
          'rgba(105, 255, 216, 0.2)',
          'rgba(215, 215, 3, 0.2)',
          'rgba(245, 133, 63, 0.2)',
          'rgba(240, 99, 71, 0.2)',
          'rgba(206, 191, 216, 0.2)',
          'rgba(24, 128, 127, 0.2)',
          'rgba(102, 128, 145, 0.2)',
          'rgba(210, 128, 95, 0.2)'
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

</body>

</html>
