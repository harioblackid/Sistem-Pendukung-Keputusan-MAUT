<?php if($action == null) : ?>
<section class="content-header">
    <h1>
        <?=$title; ?>
    	<small><?=$key; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href='<?= $base_url; ?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$title; ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title pull-right">
				<a href='<?= "$base_url/$page/create"; ?>' class="btn btn-primary" ><i class="fa fa-plus"></i> New Responden </a>
			</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<table id="simpletable" class='table table-responsive table-striped'>
				<thead>
					<tr>
						<td>No</td>
						<td>Kode</td>
						<td>Nama Responden</td>
						<td>Username</td>
						<td>Level</td>
						<td>Status</td>
						<td>Aksi</td>
				    </tr>
				</thead>
				<tbody>
					<?php 
				      $no=1; 
				      
				      $show = $user->selectAll();
				      while ($row = $show->fetch_object()) :
				       
				    ?>
				    <tr>
				    	<td><?= $no; ?></td>
				    	<td><?= $row->id; ?></td>
				    	<td><?= $row->nama_lengkap; ?></td>
				    	<td><?= $row->username; ?></td>
				    	<td><?= $row->level; ?></td>
				    	<td>
				    		<small>
				    			<span class="label label-success">Respon Sukses : </span> 
				    			<span class="pull-right">
				    				<?php 
				    					echo $user->cekResponOk($row->id);
				    				?>
				    			</span> 
				    		</small> <br>
				    		<small>
				    			<span class="label label-warning">Respon Pending : </span> 
				    			<span class="pull-right">
				    				<?php 
				    					echo $user->cekResponPending($row->id);
				    				?>
				    					
				    			</span> 
				    		</small>
				    	</td>
				    	<td>
				    		<a href='<?="$base_url/$page/edit/". $user->encode($row->id); ?>' class='btn btn-primary'><i class='fa fa-edit'></i></a>

				    		<a href='<?="$base_url/$page/delete/". $user->encode($row->id); ?>' class='btn btn-danger'><i class='fa fa-trash'></i></a>
				    	</td>

				    </tr>
				    <?php 
				    	$no++;
						endwhile; 
				    ?>
				</tbody>
			</table>
		</div>

	</div>
</section>
<?php elseif($action == "edit") : ?>

<?php 
$row = $user->selectById($id)->fetch_object();

$key = $row->nama_lengkap;
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
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Edit Responden</h3>
			<a href='<?= "$base_url/$page"; ?>' class="btn btn-warning pull-right"><i class='fa fa-rotate-left'></i> Back</a>
		</div>
		<!-- /.box-header -->
		<form id='form' action='<?= "$base_url/admin/responden-ubah.php"; ?>' method="post" data-parsley-validate>
	        <div class="box-body">
	            <div class="alert alert-warning" style="display: none;" id="cek">
	                <i class="fa fa-refresh fa-spin"></i> Menunggu.....
	            </div>
	            <div id="infoMessage"></div>
	            
	            <div class="form-group">
	            	<label>Kode</label>
	            	<input type="text" name="id" class="form-control" required="required" 
	            	readonly="readonly"
	            	value="<?= $row->id; ?>">
	            </div>
	          
	          <div class="form-group">
	              <label>Nama Lengkap</label>
	              <input type="text" name="nama_lengkap" class="form-control" required="required" value="<?= $row->nama_lengkap; ?>">
	          </div>
	          <div class="form-group">
	              <label>Username</label>
	              <input type="text" name="username" class="form-control" required="required" value="<?= $row->username; ?>">
	          </div>

	          <div class="form-group">
	              <label>Old Password</label>
	              <input type="password" name="old" class="form-control" value="">
	          </div>

	          <div class="form-group">
	              <label>New Password</label>
	              <input type="password" name="new" class="form-control" value="">
	          </div>

	          <div class="form-group">
	              <label>Comfirm Password</label>
	              <input type="password" name="password" class="form-control" value="">
	          </div>

	                
	        </div>

	        <div class="box-footer">
	            <button type="submit" id="save" class="btn btn-primary"><b><i class="fa fa-save"></i></b> Save</button>
	        </div>
        </form>

	</div>
</section>

<?php elseif($action == "create") : ?>

<section class="content-header">
    <h1>
        <?=$title; ?>
    	<small><?=$key; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href='<?= $base_url; ?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href='<?= "$base_url/$page"; ?>'> <?=$title; ?></a></li>
        <li class="active">New Responden</li>
    </ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">New Responden</h3>
			<a href='<?= "$base_url/$page"; ?>' class="btn btn-warning pull-right"><i class='fa fa-rotate-left'></i> Back</a>
		</div>
		<!-- /.box-header -->
		<form id='form' action='<?= "$base_url/admin/responden-simpan.php"; ?>' method="post" data-parsley-validate>
	        <div class="box-body">
	            <div class="alert alert-warning" style="display: none;" id="cek">
	                <i class="fa fa-refresh fa-spin"></i> Menunggu.....
	            </div>
	            <div id="infoMessage"></div>
	            
	            <div class="form-group">
	            	<label>Kode</label>
	            	<input type="text" name="id" class="form-control" required="required" value="">
	            </div>
	          
	          <div class="form-group">
	              <label>Nama Lengkap</label>
	              <input type="text" name="nama_lengkap" class="form-control" required="required">
	          </div>

	          <div class="form-group">
	              <label>Username</label>
	              <input type="text" name="username" class="form-control" required="required">
	          </div>

	          <div class="form-group">
	              <label>New Password</label>
	              <input type="password" name="new" class="form-control" value="">
	          </div>

	          <div class="form-group">
	              <label>Comfirm Password</label>
	              <input type="password" name="password" class="form-control" value="">
	          </div>

	                
	        </div>

	        <div class="box-footer">
	            <button type="submit" id="save" class="btn btn-primary"><b><i class="fa fa-save"></i></b> Save</button>
	        </div>
        </form>

	</div>
</section>
<?php elseif($action == "delete") :

	$user->id = $id;

	if($user->delete() == true)
	{
		echo $user->ajaxRedirect("$base_url/$page", null);
	}

endif; ?>