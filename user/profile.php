<?php 
$row = $user->selectById($user->encode($id_user))->fetch_object();

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
			<h3 class="box-title">Edit Profile</h3>
			
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
