<?php
include '../class/Core.inc.php';
$core = new Core();

include 'class/App_config.inc.php';
include 'class/Config.php';
include 'class/User.inc.php';
include 'class/Alternatif.inc.php';
include 'class/Kriteria.inc.php';
include 'class/Perhitungan.inc.php';

$config = new Config();
$db = $config->getConnection();

$app = new App_config($db);
$module = $app->getApp()->fetch_object();

$user = new User($db);

$alt = new Alternatif($db);

$kriteria = new Kriteria($db);

$hitung = new Perhitungan($db);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $module->name; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">

   
    <!-- Date Range -->
    <link rel="stylesheet" href="assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Morris charts -->
    <link rel="stylesheet" href="assets/bower_components/morris.js/morris.css">
    <link rel="stylesheet" href="assets/bower_components/select2/dist/css/select2.css">
    <!-- jQuery 3 -->
    <link rel="stylesheet" href="assets/bower_components/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="assets/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
   

    <link rel="stylesheet" type="text/css" href="assets/fileinput.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/pace/pace.css">
    <!-- Select 2 Admin LTE -->
    <link rel="stylesheet" href="assets/dist/css/alt/AdminLTE-select2.css">
    <!-- Load jquer -->
     <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
     <script src="assets/bower_components/jquery/dist/jquery.mask.min.js"></script>
   <!-- Table to json -->
    <script src="https://cdn.jsdelivr.net/npm/table-to-json@0.13.0/lib/jquery.tabletojson.min.js" integrity="sha256-AqDz23QC5g2yyhRaZcEGhMMZwQnp8fC6sCZpf+e7pnw=" crossorigin="anonymous"></script>
    <!-- DataTables -->
    <script src="assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


    <!-- Morris chart js -->
    <script src="assets/bower_components/raphael/raphael.min.js"></script>
    <script src="assets/bower_components/morris.js/morris.min.js"></script>
    <!-- File input js -->
    <script src="assets/fileinput.js"></script>
    <!-- Pace -->
    <script src="assets/plugins/pace/pace.js"></script>
    <!-- Select 2 -->
    <script src="assets/bower_components/select2/dist/js/select2.js" charset="utf-8"></script>
  
  <!-- Google Font -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<?php 

//Get Data Alternatif for Chart
$labels = [];
$data = [];
$data1 = [];

$alt_show = $alt->selectAll();
while ($row = $alt_show->fetch_object()) {
    $labels[] = $row->id_alternatif;
    $data[] = $row->nilai_alt;
    $data1[] = $row->nilai_maut;
}


?>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../assets/index2.html" class="navbar-brand"><b>Admin</b>LTE</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
            </div>
          </form>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Sistem Pendukung Keputusan
          <small>MAUT & SAW</small>
        </h1>
        
      </section>
      <?php 

      $count1 = $alt->countAll();
      $row1 = $count1->fetch_object();

      $count2 = $kriteria->countAll();
      $row2 = $count2->fetch_object();

      $count3 = $user->countAll();
      $row3 = $count3->fetch_object();

      $count4 = $alt->getTopMaut();
      $row4 = $count4->fetch_object();

      $count5 = $alt->getTop();
      $row5 = $count5->fetch_object();

      ?>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <!-- List Alternatif -->
          <div class="col-lg-4">
            <div class="box box-primary">
              
              <div class="box-header with-border">
                <h3 class="box-title">Hasil Akhir SAW</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>

              </div>
              <div class="box-body">
                <div class="alert alert-warning" style="display: none;" id="cek">
                          <i class="fa fa-refresh fa-spin"></i> Memproses ...
                      </div>
                      <div id="infoMessage"></div>

                <table class='table table-bordered table-responsive'>
                  <thead>
                    <tr>
                      <td>#</td>
                      <td>Nama</td>
                      <td>Nilai</td>
                    </tr>
                  </thead>

                  <tbody>
                  <?php
                    $result = $alt->getFinal();
                    while($row = $result->fetch_object()) : 
                  ?>
                    <tr>
                      <td><?= $row->id_alternatif; ?></td>
                      <td><?= $row->nama; ?></td>
                      <td>
                        <?= round($row->nilai_alt, 5); ?>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            
            </div>
          </div>

          <!-- Statistik Data  -->
          <div class="col-lg-8">
            
            <!-- Top Alternatif -->
            <div class="row">
              <div class="col-xs-12 col-lg-6">
                <div class="small-box bg-aqua">
                  
                  <div class="inner">
                    <h3><?= round($row4->nilai_maut, 3); ?></h3>

                    <p><?= $row4->nama; ?> - <strong><?= $row4->id_alternatif; ?></strong></p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <div class="small-box-footer"> Top Alternatif MAUT </div>
                </div>
              </div>

              <div class="col-xs-12 col-lg-6">
                <div class="small-box bg-green">
                  
                  <div class="inner">
                    <h3><?= round($row5->nilai_alt, 5); ?></h3>

                    <p><?= $row5->nama; ?> - <strong><?= $row5->id_alternatif; ?></strong></p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <div class="small-box-footer"> Top Alternatif SAW </div>
                </div>
              </div>
            </div>

            <!-- Bar Chart -->
            <div class="row">
              <div class="col-xs-12">
                <div class="box box-success">
                  
                  <div class="box-header with-border">
                    <h3 class="box-title"> <i class="fa fa-bar-chart"></i> Bar Chart MAUT</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="barChartMAUT" style="height:230px"></canvas>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>

              </div>
            </div>

            <div class="row">
              <div class="col-xs-12">
                <div class="box box-success">
                  
                  <div class="box-header with-border">
                    <h3 class="box-title"> <i class="fa fa-bar-chart"></i> Bar Chart SAW</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="barChartSAW" style="height:230px"></canvas>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>

              </div>
            </div>

          </div>
          <!-- /.List Alternatif -->
        </div>

        
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.1.10
    </div>
    <strong>Copyright &copy; <?= date('Y'); ?> <a href="#"> <?=$module->author; ?> </a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/dist/js/demo.js"></script>
<script type="text/javascript">
  
        //MAUT
        $(function(){
            var areaChartData = {
            labels  : <?= json_encode($labels); ?>,
            datasets: [
              {
                label               : 'Electronics',
                fillColor           : 'rgba(210, 214, 222, 1)',
                strokeColor         : 'rgba(210, 214, 222, 1)',
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : <?= json_encode($data); ?>
              }
            ]
          }

          //-------------
          //- BAR CHART -
          //-------------
          var barChartCanvas                   = $('#barChartSAW').get(0).getContext('2d')
          var barChart                         = new Chart(barChartCanvas)
          var barChartData                     = areaChartData
          barChartData.datasets[0].fillColor   = '#00a65a'
          barChartData.datasets[0].strokeColor = '#00a65a'
          barChartData.datasets[0].pointColor  = '#00a65a'
          var barChartOptions                  = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero        : false,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines      : true,
            //String - Colour of the grid lines
            scaleGridLineColor      : 'rgba(0,0,0,.05)',
            //Number - Width of the grid lines
            scaleGridLineWidth      : 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines  : true,
            //Boolean - If there is a stroke on each bar
            barShowStroke           : true,
            //Number - Pixel width of the bar stroke
            barStrokeWidth          : 2,
            //Number - Spacing between each of the X value sets
            barValueSpacing         : 5,
            //Number - Spacing between data sets within X values
            barDatasetSpacing       : 1,
            //String - A legend template
            legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
            //Boolean - whether to make the chart responsive
            responsive              : true,
            maintainAspectRatio     : true
          }

          barChartOptions.datasetFill = false
          barChart.Bar(barChartData, barChartOptions)
        })

        //SAW
        $(function(){
            var areaChartData = {
            labels  : <?= json_encode($labels); ?>,
            datasets: [
              {
                label               : 'Electronics',
                fillColor           : 'rgba(210, 214, 222, 1)',
                strokeColor         : 'rgba(210, 214, 222, 1)',
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : <?= json_encode($data1); ?>
              }
            ]
          }

          //-------------
          //- BAR CHART -
          //-------------
          var barChartCanvas                   = $('#barChartMAUT').get(0).getContext('2d')
          var barChart                         = new Chart(barChartCanvas)
          var barChartData                     = areaChartData
          barChartData.datasets[0].fillColor   = '#00a65a'
          barChartData.datasets[0].strokeColor = '#00a65a'
          barChartData.datasets[0].pointColor  = '#00a65a'
          var barChartOptions                  = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero        : false,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines      : true,
            //String - Colour of the grid lines
            scaleGridLineColor      : 'rgba(0,0,0,.05)',
            //Number - Width of the grid lines
            scaleGridLineWidth      : 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines  : true,
            //Boolean - If there is a stroke on each bar
            barShowStroke           : true,
            //Number - Pixel width of the bar stroke
            barStrokeWidth          : 2,
            //Number - Spacing between each of the X value sets
            barValueSpacing         : 5,
            //Number - Spacing between data sets within X values
            barDatasetSpacing       : 1,
            //String - A legend template
            legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
            //Boolean - whether to make the chart responsive
            responsive              : true,
            maintainAspectRatio     : true
          }

          barChartOptions.datasetFill = false
          barChart.Bar(barChartData, barChartOptions)
        })
</script>
</body>
</html>
