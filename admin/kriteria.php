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
			
	 	</div>
	 	<div class='box-body'>
	 		<table id="simpletable" class='table table-bordered table-responsive'>
	 			<thead>
	 				<tr>
	 					<td>No</td>
	 					<td>Kode</td>
	 					<td>Nama Kriteria</td>
	 					<td>Keterangan</td>
	 					<td>Bobot </td>
	 					<td>Subkriteria</td>
	 					<td>Aksi</td>
	 				</tr>
	 			</thead>
	 			<tbody>
	 			<?php 
	 				$no=1; 
	 				$show = $kriteria->selectAll();
	 				while ($row = $show->fetch_object()) :
	    		?>
	    			<tr>
	    				<td><?= $no; ?></td>
	    				<td><?= $row->id_kriteria; ?></td>
	    				<td><?= $row->nama_kriteria; ?></td>
	    				<td><?= $row->keterangan; ?></td>
	    				<td><?= $row->bobot_preferensi; ?></td>
	    				<td>
	    					<?php
	    					
	    					$sub = $kriteria->selectSub($row->id_kriteria);
	    					
	    					if($sub->num_rows > 0){
	    						while ($subrow = $sub->fetch_object()) {
	    							echo "<small> - ". $subrow->nama_subkriteria. "</small><br>";
	    						}
	    					}
	    					else
	    					{
	    						echo "<small class='label label-danger'> Data Kosong </small>";
	    					} 
	    					?>
	          
	      				</td>
	      				<td>
	      					<a href='<?= "$base_url/$page/edit/".$kriteria->encode($row->id_kriteria); ?>' class='btn btn-warning btn-xs'><i class='fa fa-edit'></i></a>

	      					<a href='<?= "$base_url/$page/delete/".$kriteria->encode($row->id_kriteria); ?>' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a>

	      					<a href='<?= "$base_url/?pg=subkriteria/add/".$kriteria->encode($row->id_kriteria); ?>' class='btn btn-success btn-xs'><i class='fa fa-plus'></i></a>  
	      				</td>
	      			</tr>
	      			<?php $no++; 
	      		endwhile ; 
	    
	      	?>
	   			</tbody>	
	   		</table>
	   	</div>
	   	<div class='box-footer'>

	   	</div>
	</div>

</section>

<!-- Tambah Data -->
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
			<h3 class="box-title">Tambah Data Kriteria</h3>
			<a href='<?= "$base_url/$page"; ?>' class="btn btn-warning pull-right">
				<i class='fa fa-rotate-left'></i> Back</a>
		</div>

		<form id='form' action='<?= "$base_url/admin/kriteria-simpan.php"; ?>' method="post" data-parsley-validate>

		<div class="box-body">
			<div class="alert alert-warning" style="display: none;" id="cek">
            	<i class="fa fa-refresh fa-spin"></i> Menunggu.....
        	</div>
         	<div id="infoMessage"></div>
            
            <div class="form-group">
            	<label>Kode</label>
            	<input type="text" name="id_kriteria" class="form-control" required="required">
            </div>

            <div class="form-group">
            	<label>Nama Kriteria</label>
            	<input type="text" name="nama" class="form-control" required="required" >
            </div>

            <div class="form-group">
            	<label>Keterangan</label>
            	<input type="text" name="keterangan" class="form-control" required="required">
            </div>
			
			<div class="form-group">
            	<label>Bobot</label>
            	<input type="number" name="bobot" class="form-control" required="required" placeholder="Masukan nilai 1 s.d 9">
            </div>

        </div>

        <div class="box-footer">
        	<button type="submit" id="save" class="btn btn-primary"><b><i class="fa fa-save"></i></b> Save</button>
        </div>
   		</form>
	<!-- /.box-body -->
	</div>
</section>

<?php elseif($action == "edit") : ?>

<?php 
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
        <li><a href='<?= "$base_url/$page"; ?>'> <?=$title; ?></a></li>
        <li class="active"><?=$row->id_kriteria; ?></li>
    </ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Edit Kriteria</h3>
			<a href='<?= "$base_url/$page"; ?>' class="btn btn-warning pull-right"><i class='fa fa-rotate-left'></i> Back</a>
		</div>
		<!-- /.box-header -->
		<form id='form' action='<?= "$base_url/admin/kriteria-ubah.php"; ?>' method="post" data-parsley-validate>

		<div class="box-body">
			<div class="alert alert-warning" style="display: none;" id="cek">
            	<i class="fa fa-refresh fa-spin"></i> Menunggu.....
        	</div>
         	<div id="infoMessage"></div>
            
            <div class="form-group">
            	<label>Kode</label>
            	<input type="text" name="id_kriteria" class="form-control" required="required"
            	value="<?=$row->id_kriteria; ?>"
            	readonly="readonly" 
            	>
            </div>

            <div class="form-group">
            	<label>Nama Kriteria</label>
            	<input type="text" name="nama" class="form-control" 
            	required="required" 
            	value="<?=$row->nama_kriteria; ?>">
            </div>

            <div class="form-group">
            	<label>Keterangan</label>
            	<input type="text" name="keterangan" class="form-control" 
            	required="required" 
            	value="<?=$row->keterangan; ?>">
            </div>
			
			<div class="form-group">
            	<label>Bobot</label>
            	<input type="text" name="bobot" class="form-control" required="required" value="<?=$row->bobot_preferensi; ?>">
            </div>

        </div>

        <div class="box-footer">
        	<button type="submit" id="save" class="btn btn-primary"><b><i class="fa fa-save"></i></b> Save</button>
        </div>
   		</form>


	</div>
</section>

<?php
elseif($action == "delete") :

	$kriteria->id_kriteria = $id;

	if($kriteria->hapus() == true)
	{
		echo $kriteria->ajaxRedirect("$base_url/$page", null);
	}
?>

<?php endif; ?>