<?php 

$query = $alt->selectAll();
$cekKriteria = $kriteria->countAll();
$krt = $cekKriteria->fetch_object(); 
?>

<section class="content-header">
  <h1>
    <?=$title; ?>
    <small><?=$key; ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href='<?= $base_url; ?>'><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?=$title; ?></li>
  </section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">

    <?php 
    while ($row = $query->fetch_object()) : 
      $cekResponden = $hitung->cekResponden($id_user, $row->id_alternatif);
      $res = $cekResponden->fetch_object();
      
      if($res->total <> $krt->total) {
        $bg = "bg-yellow";
        $icon = "<i class='ion-alert-circled'></i>";
        $status = "Belum Terisi";
      }
      else{
        $bg = "bg-aqua";
        $icon = "<i class='ion ion-checkmark'></i>";
        $status = "Sudah terisi"; 
      }

      ?>
      
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <!-- ion-alert-circled -->
        <a href='<?= "$base_url/?pg=responden-input/create/". $hitung->encode($row->id_alternatif); ?>'>
          <span class="info-box-icon <?=$bg; ?>"> <?= $icon; ?> </span>
        </a>

        <div class="info-box-content">
          <span class="info-box-text"><?= $row->nama; ?></span>
          <span class="info-box-number"><small> <?= $status; ?> </small></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <?php endwhile; ?>
    
  </div>
  <!-- /.row -->
</section>