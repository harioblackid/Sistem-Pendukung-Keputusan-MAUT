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

<section class="content-header">
  <h1>
    <?=$title; ?>
    <small><?=$key; ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href='<?= $base_url; ?>'><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?=$key; ?></li>
  </section>

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