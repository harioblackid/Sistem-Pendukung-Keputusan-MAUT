<?php 

$count1 = $alt->countAll();
$row1 = $count1->fetch_object();

$count2 = $kriteria->countAll();
$row2 = $count2->fetch_object();

$count3 = $alt->getTopMaut();
$row3 = $count3->fetch_object();

$count4 = $alt->getTop();
$row4 = $count4->fetch_object();

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
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?=$row1->total; ?></h3>

          <p>Alternatif</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-settings-strong"></i>
        </div>
        <a href='<?= "$base_url/?pg=alternatif"; ?>' class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?=$row2->total; ?></h3>

          <p>Kriteria</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href='<?= "$base_url/?pg=kriteria"; ?>' class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?= round($row3->nilai_maut, 3); ?></h3>

          <p><?= $row3->nama; ?> - <strong><?= $row3->id_alternatif; ?></strong></p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href='<?= "$base_url/?pg=responden"; ?>' class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?= round($row4->nilai_alt, 5); ?></h3>

          <p><?= $row4->nama; ?> - <strong><?= $row4->id_alternatif; ?></strong></p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href='<?= "$base_url/?pg=normalisasi_final"; ?>' class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>

  <!-- MAUT -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Hasil Analisa MAUT</h3>

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

  <!-- SAW -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Hasil Analisa SAW</h3>

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

</section>