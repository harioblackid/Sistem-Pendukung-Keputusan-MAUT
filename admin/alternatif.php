<?php if($action == null) : ?>
<section class="content-header">
    <h1>
        <?=$title; ?>
    	<small><?=$key; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href='<?= $base_url; ?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> <?=$title; ?></li>
        
    </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class='box box-default'>
		<div class='box-header with-border'>
			<a href='<?= "$base_url/$page/create"; ?>' class='btn btn-primary pull-right'><i class='fa fa-plus'></i> New alternatif</a>
		</div>
		<div class='box-body'>
			<table id="simpletable" class='table table-bordered table-responsive'>
				<thead>
					<tr>
						<td>No</td>
						<td>Kode</td>
						<td>Nama Alternatif</td>
						<td>Keterangan</td>
						<td>Aksi</td>
					</tr>
				</thead>
				<tbody>
					<?php
					$result = $alt->selectAll();

					if($result->num_rows > 0) :
						$no=1; 
						while($row = $result->fetch_object()) :
					?>
					<tr>
						<td><?= $no; ?></td>
						<td><?= $row->id_alternatif; ?></td>
						<td><?= $row->nama; ?></td>
						<td><?= $row->keterangan; ?></td>
						<td>
							<a href='<?= "$base_url/$page/edit/". $alt->encode($row->id_alternatif); ?>' class='btn btn-warning btn-sm'><i class='fa fa-edit'></i></a>
							<a href='<?= "$base_url/$page/delete/".$alt->encode($row->id_alternatif); ?>' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a>  
						</td>
					</tr>
					<?php 
						$no++; 
						endwhile ; 
						endif;
					?>
				</tbody>
			</table>
		</div>
		<div class='box-footer'>

		</div>
	</div>

</section>
<!-- Section Create -->
<?php elseif($action == "create") : ?>
<section class="content-header">
    <h1>
        <?=$title; ?>
    	<small><?=$key; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href='<?= $base_url; ?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href='<?= "$base_url/$page"; ?>'> <?=$title; ?></a></li>
        <li class="active"><?=$key; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Tambah Data Alternatif</h3>
			<a href='<?= "$base_url/$page"; ?>' class="btn btn-warning pull-right">
				<i class='fa fa-rotate-left'></i> Back</a>
		</div>

		<form id='form' action='<?= "$base_url/admin/alternatif-simpan.php"; ?>' method="post" data-parsley-validate>
        <div class="box-body">
            <div class="alert alert-warning" style="display: none;" id="cek">
                <i class="fa fa-refresh fa-spin"></i> Menunggu...
            </div>
            <div id="infoMessage"></div>
            
            <div class="form-group">
            	<label>Kode</label>
            	<input type="text" name="id" class="form-control" required="required">
              
          	</div>
          	<div class="form-group">
          		<label>Nama Alternatif</label>
	            <input type="text" name="nama" class="form-control" required="required">
	        </div>
	        
	        <div class="form-group">
	        	<label>Keterangan</label>
	            <input type="text" name="keterangan" class="form-control" required="required">
	        </div>
	                
	    </div>
	    
	    <div class="box-footer">
	    	<button type="submit" id="save" class="btn btn-primary"><b><i class="fa fa-save"></i></b> Save</button>
	    </div>
		</form>
	<!-- /.box-body -->
	</div>
</section>

<!-- Section Edit -->
<?php elseif($action == "edit") : ?>

<?php 
$row = $alt->selectById($id)->fetch_object();

$key = $row->nama;
?>

<section class="content-header">
    <h1>
        <?=$title; ?>
    	<small><?=$key; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href='<?= $base_url; ?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href='<?= "$base_url/$page"; ?>'> <?=$title; ?></a></li>
        <li class="active"><?=$key; ?></li>
    </ol>
</section>

<section class="content">
	<div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Alternatif - <?= $row->id_alternatif; ?></h3>
            <a href='<?= "$base_url/$page"; ?>' class="btn btn-warning pull-right"><i class='fa fa-rotate-left'></i> Back</a>
        </div>
        <form id='form' action='<?= "$base_url/admin/alternatif-ubah.php"; ?>' method="post" data-parsley-validate>
        <div class="box-body">
            <div class="alert alert-warning" style="display: none;" id="cek">
                <i class="fa fa-refresh fa-spin"></i> Menunggu...
            </div>
            <div id="infoMessage"></div>
            
            <div class="form-group">
            	<label>Kode</label>
            	<input type="text" name="id" class="form-control" required="required"
            	readonly="readonly" 
            	value="<?= $row->id_alternatif; ?>">
              
          	</div>
          	<div class="form-group">
          		<label>Nama Alternatif</label>
	            <input type="text" name="nama" class="form-control" required="required" value="<?= $row->nama; ?>">
	        </div>
	        
	        <div class="form-group">
	        	<label>Keterangan</label>
	            <input type="text" name="keterangan" class="form-control" required="required" value="<?= $row->keterangan; ?>">
	        </div>
	                
	    </div>
	    
	    <div class="box-footer">
	    	<button type="submit" id="save" class="btn btn-primary"><b><i class="fa fa-save"></i></b> Save</button>
	    </div>
		</form>
	</div>
    <!-- /.box-body -->

</section>

<?php
elseif($action == "delete") :

	$alt->id = $id;

	if($alt->hapus() == true)
	{
		echo $alt->ajaxRedirect("$base_url/$page", null);
	}
?>

<?php endif; ?>