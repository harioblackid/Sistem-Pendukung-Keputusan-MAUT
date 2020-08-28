<?php if($action == "add") : 

$result = $kriteria->selectById($id);
$row = $result->fetch_object();

?>

<section class="content-header">
    <h1>
        <?=$title; ?>
      <small><?=$key; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href='<?= $base_url; ?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href='<?= "$base_url/?pg=kriteria"; ?>'> Kriteria</a></li>
        <li class="active">Subkriteria</li>
    </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-default">
          <div class="box-header with-border">
              <h3 class="box-title">Detail Kriteria</h3>
              <a href='<?= "$base_url/?pg=kriteria"; ?>' class="btn btn-warning pull-right"><i class='fa fa-rotate-left'></i> Back</a>
          </div>
          
          <!-- Kode -->
          <div class="box-body">
            
            <div class="col-lg-4">
                <label><i class="fa fa-barcode"></i> Kode</label>
                  <h4 class="text-muted">
                    <?=$row->id_kriteria; ?>
                  </h4>
              </div>

              <!-- Nama Kriteria -->
              <div class="col-lg-4">
                <label><i class="fa fa-tag"></i> Nama Kriteria</label>
                  <h4 class="text-muted">
                    <b><?=$row->nama_kriteria; ?></b>
                  </h4>
              </div>

              <!-- Keterangan -->
              <div class="col-lg-4">
                <label><i class="fa fa-comment"></i> Keterangan</label>
                  <h4 class="text-muted">
                    <b><?=$row->keterangan; ?></b>
                  </h4>
              </div>

          </div>
         
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-8">
      <!-- List Sub Kriteria -->
      <div class="box box-primary">
        <div class="box-header">
          Daftar Subkriteria
        </div>

        <div class="box-body">
          <table class="table table-hover table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Kode</th>
                <th>Nama Subkriteria</th>
                <th>Bobot Minimal</th>
                <th>Bobot Maksimal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            
            <tbody>
            <?php 
            $sub = $kriteria->selectSub($row->id_kriteria);

            if($sub->num_rows > 0) :
              $no=0;
              while ($row = $sub->fetch_object()) :
                $no++;
                ?>
              <tr>
                <td><?=$no; ?></td>
                <td><?=$row->id_sub; ?></td>
                <td><?=$row->nama_subkriteria; ?></td>
                <td><?=round($row->bobot_min, 2); ?></td>
                <td><?=round($row->bobot_max, 2); ?></td>
                <td>
                  <a href='<?= "$base_url/$page/delete/".$user->encode($row->id_sub)."/".$user->encode($row->id_kriteria); ?>' class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i> 
                  </a>
                </td>
              </tr>

            <?php endwhile;
          endif; 
          ?>
            </tbody>

          </table>
        </div>
      </div>
      <!-- Box  -->
    </div>
    <!-- End Coloum -->
    <div class="col-lg-4">
      <div class="box box-primary">
        <div class="box-header">
          Tambah Subkriteria
        </div>
        <form id="form" method="post" action='<?= "$base_url/admin/subkriteria-simpan.php"; ?>' >

        <div class="box-body">
          <div id="infoMessage"></div>        
          
          <!-- ID Kriteria -->
          <input type="hidden" name="id_kriteria" value="<?=$kriteria->decode($id); ?>">

          <div class="form-group">
            <label>Kode</label>
            <input type="text" name="id_sub" required="required" class="form-control">
          </div>

          <div class="form-group">
            <label>Nama Subkriteria</label>
            <input type="text" name="nama" required="required" class="form-control">
          </div>

          <div class="form-group">
            <label>Bobot Minimal</label>
            <input type="number" name="min" class="form-control">
          </div>

          <div class="form-group">
            <label>Bobot Maksimal</label>
            <input type="number" name="max" class="form-control">
          </div>
          
        </div>

        <div class="box-footer">
          <button class="btn btn-block btn-primary"><i class="fa fa-save"></i> Simpan</button>
        </div>

        </form>
      </div>
      <!-- Box  -->
    </div>
  </div>
</section>

<?php 

elseif($action == "delete") : 
  $kriteria->id_sub = $id;

  if($kriteria->deleteSub() == true)
  {
    echo $kriteria->ajaxRedirect("$base_url/$page/add/$id2", null);
  }

endif; ?>
