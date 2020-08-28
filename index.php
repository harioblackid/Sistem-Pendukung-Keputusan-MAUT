<?php
include 'class/Core.inc.php';
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


session_start();
if(isset($_SESSION['nama_lengkap'])) :
  
?>

<!-- ADMIN PAGE -->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?= $module->name; ?>
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
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
 


    <!-- Data Toogle -->
    <link href="assets/bower_components/toogle/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="assets/bower_components/toogle/bootstrap-toggle.min.js"></script>
</head>
<!-- <body class="hold-transition skin-blue sidebar-mini"> -->

<?php 
$id_user = $_SESSION['id'];

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

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= $base_url; ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><?=$module->name; ?></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?=$module->name; ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?= $_SESSION['nama_lengkap']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="uploads/user.png" class="img-circle" alt="User Image">
                <p>
                  <?= $_SESSION['nama_lengkap']; ?>
                  <small><?= $_SESSION['level']; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href='<?= "$base_url/?pg=profile"; ?>' class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href='<?= "$base_url/class/logout.php"; ?>' class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="uploads/user.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $_SESSION['nama_lengkap']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        
        <li>
          <a href="<?=$base_url; ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            
          </a>
        </li>

<!--         <li>
          <a href='<?= "$base_url/?pg=responden"; ?>'>
            <i class="fa fa-users"></i> <span>Responden</span>
            
          </a>
        </li> -->

        <li>
          <a href='<?= "$base_url/?pg=kriteria"; ?>'>
            <i class="fa fa-tasks"></i> <span>Kriteria</span>
            
          </a>
        </li>

        <li>
          <a href='<?= "$base_url/?pg=alternatif"; ?>'>
            <i class="fa fa-list-ol"></i> <span>Alternatif</span>
            
          </a>
        </li>

        <!-- <li>
          <a href="<?="$base_url/?pg=kuisioner-list"; ?>">
            <i class="fa fa-file-text"></i> <span>Input Nilai Kriteria</span>
            
          </a>
        </li> -->

        <li>
          <a href='<?= "$base_url/?pg=perhitungan-maut"; ?>'>
            <i class="fa fa-calculator"></i> <span>Hasil Perhitungan MAUT</span>
            
          </a>
        </li>

        <li>
          <a href='<?= "$base_url/?pg=perhitungan-saw"; ?>'>
            <i class="fa fa-calculator"></i> <span>Hasil Perhitungan SAW</span>
            
          </a>
        </li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

        <!-- Konten Utama -->
    <?php 
      switch ($page) {

        case '?pg=profile':
          $title = "Data Responden";
          $key = "";
          include('admin/profile.php');
          break;

				// case '?pg=responden':
				// 	$title = "Data Responden";
				// 	$key = "";
				// 	include('admin/responden.php');
				// 	break;

				case '?pg=kriteria':
					$title = "Data Kriteria";
					$key = "";
					include('admin/kriteria.php');
					break;

        case '?pg=alternatif':
          $title = "Data Alternatif";
          $key = "";
          include('admin/alternatif.php');
          break;
				
        case '?pg=subkriteria':
          $title = "Data subkriteria";
          $key = "";
          include('admin/subkriteria.php');
          break;

        case '?pg=perhitungan-maut':
          $title = "Perhitungan MAUT";
          $key = "";
          include('admin/responden-hasil-maut.php');
          break;

        case '?pg=perhitungan-saw':
          $title = "Perhitungan SAW";
          $key = "";
          include('admin/responden-hasil-saw.php');
          break;

        case '?pg=normalisasi-saw':
          $title = "Perhitungan SAW";
          $key = "";
          include('admin/normalisasi-saw.php');
          break;

        case '?pg=normalisasi-maut':
          $title = "Perhitungan MAUT";
          $key = "";
          include('admin/normalisasi-maut.php');
          break;

        case '?pg=normalisasi_final':
          $title = "Perhitungan";
          $key = "";
          include('admin/normalisasi-final.php');
          break;

        case '?pg=normalisasi_final-maut':
          $title = "Perhitungan";
          $key = "";
          include('admin/normalisasi-final-maut.php');
          break;


        case '?pg=dashboard':
          $title = "Dashboard";
          $key = "";
          include('admin/dashboard.php');
          break;

				default:
					$title = "Dashboard";
          $key = "";
          include "admin/dashboard.php";
					break;
			}

    ?>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.1.10
    </div>
    <strong>Copyright &copy; <?= date('Y'); ?> <a href="#"> <?=$module->author; ?> </a>.</strong> All rights
    reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
    <!-- ./wrapper -->

    <!-- Bootstrap 3.3.7 -->
    <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>

    <!-- ChartJS -->
    <script src="assets/bower_components/chart.js/Chart.js"></script>

    <!-- AdminLTE for demo purposes -->

    <script src="assets/form.js"></script>
    <script type="text/javascript">
        $(document).ajaxStart(function() {
            Pace.restart()
        });

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            $('select').select2();
            $('#form').on('submit', function(e) {
                e.preventDefault();
                $('#cek').show();
                $(this).ajaxSubmit({
                    target: "#infoMessage",
                    success: function() {
                        $('#cek').hide();
                    },
                    error: function(xhr, text, msg){
                        console.log(xhr, text, msg);
                    }
                })
            })
            $('.form').on('submit', function(e) {
                    e.preventDefault();
                    $('#cek').show();
                    $(this).ajaxSubmit({
                        target: ".infoMessage",
                        success: function() {
                            $('#cek').hide();
                        }
                    })
                })
                //Date picker

            $('#simpletable').DataTable();

        });

        //MAUT
        $(document).ready(function(){
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
        $(document).ready(function(){
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
<!-- END ADMIN PAGE -->
<?php else : ?>

<?php if($page != "?pg=login") : ?>

  <!-- DASHBOARD DEFAULT -->
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
            <a href="<?=$base_url; ?>" class="navbar-brand"><b><?=$module->name; ?></b></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          
          <!-- /.navbar-collapse -->
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li><a href='<?="$base_url/?pg=login"; ?>'><i class="fa fa-sign-in"></i> Login</a></li>
             
            </ul>

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
            

            <!-- Statistik Data  -->
            <div class="col-lg-12">
              
              <!-- Top Alternatif -->
              <div class="row">
                <div class="col-xs-6 col-lg-3">
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

                <div class="col-xs-6 col-lg-3">
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-maut">
                          <i class="fa fa-list-ul"></i> Lihat Rincian
                        </button>  
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-saw">
                          <i class="fa fa-list-ul"></i> Lihat Rincian
                        </button>
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

          <!-- List Alternatif MAUT -->
          <div class="modal fade" id="modal-maut">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Rincian Nilai by MAUT</h4>
                </div>
                <div class="modal-body">
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
                      $result = $alt->getFinalMaut();
                      while($row = $result->fetch_object()) : 
                    ?>
                      <tr>
                        <td><?= $row->id_alternatif; ?></td>
                        <td><?= $row->nama; ?></td>
                        <td>
                          <?= round($row->nilai_maut, 3); ?>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.List Alternatif -->


          <!-- List Alternatif SAW -->
          <div class="modal fade" id="modal-saw">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title">Rincian Nilai by SAW</h4>
                </div>
                <div class="modal-body">
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
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.List Alternatif -->

          
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
  <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- ChartJS -->
  <script src="assets/bower_components/chart.js/Chart.js"></script>
  <!-- FastClick -->
  <script src="assets/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="assets/dist/js/demo.js"></script>
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

  <?php else : ?>

  <!-- LOGIN PAGE -->
  <!DOCTYPE html>
  <html>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title><?= $module->name; ?></title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.7 -->

      <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
      <link rel="stylesheet" href="assets/animate.css">
      <link rel="stylesheet" href="assets/font.css">

      <!-- jQuery 3 -->
      <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- AdminLTE App -->
      <script src="assets/dist/js/adminlte.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="assets/dist/js/demo.js"></script>
      <script src="assets/form.js"></script>
      <script src="assets/fileinput.js"></script>
      <script type="text/javascript">
          $(document).ready(function () {
                  $('#form').on('submit', function(e) {
                      e.preventDefault();
                      $(this).ajaxSubmit({
                          target: "#infoMessage",
                          success: function() {}
                      })
                  })
              });
      </script>
      
      <style type="text/css">
      .login-page{
        background: #34495e;
      }
      .login-box-body{
        background: #ecf0f1;
        height: auto;
      }
      .login-logo{
        margin-bottom: 10PX;
      }
      .footer{
        text-align: center;
        margin-top: 20px;
        color: white;
      }
      .btn-success{
        background: #16a085;
      }
      .btn-danger {
        background: #c0392b;
      }
      </style>
    
  </head>
  <body class="hold-transition login-page">
  <div class="login-box">
      <div class="login-logo">
          
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body">
          <p class="login-box-msg">Login <b><?= $module->name; ?></b> System</p>
      <div id="infoMessage"></div>
      <form action='<?= "$base_url/class/ceklogin.php"?>' method="post" id="form">
          <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off" autofocus="">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="row">
              <!-- /.col -->

              <div class="col-xs-4">
                  <a href='<?="$base_url"; ?>' class="btn btn-default btn-block btn-flat">Kembali</a>
              </div>
              <div class="col-xs-8">
                  <button type="submit" class="btn btn-success btn-block btn-flat">Masuk</button>
              </div>
              <!-- /.col -->
          </div>


      </form>
      
      </div>
      <!-- /.login-box-body -->
      <div class="footer">
          Copyright © <?=date('Y') ?> <?=$module->author ?> <br>All rights reserved.
      </div>
  </div>
  <!-- /.login-box -->

  <script type="text/javascript">
      $(document).ready(function () {
        $('[data-mask]').inputmask();
              $('#form').on('submit', function(e) {
                  e.preventDefault();
                  $(this).ajaxSubmit({
                      target: "#infoMessage",
                      success: function() {}
                  })
              })
          });
  </script>
      <!-- ./wrapper -->
  </body>
  </html>  
  <?php endif; ?>
<?php endif; ?>