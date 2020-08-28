<?php if($action == "create") : 
	$cek_record = 0;
	?>
<section class="content-header">
    <h1>
        <?=$title; ?>
    	<small><?=$key; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href='<?= $base_url; ?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href='<?= "$base_url/?pg=kuisioner-list"; ?>'> Daftar Alternatif</a></li>
        <li class="active"><?=$title; ?></li>
    </ol>
</section>

<section class="content">
	<div class="row">
		<!-- Detail Kriteria -->
		<div class="col-md-4">
			<div class="box box-primary">
				
				<div class="box-header with-border">
					<h3 class="box-title">Hasil Penilaian</h3>
				</div>
				<div class="box-body">
				
					<table class='table table-striped table-responsive'>
						<thead>
							<tr>
								<td>#</td>
								<td>Nama</td>
								<td>Nilai</td>
							</tr>
						</thead>

						<tbody>
						<?php
							$result = $kriteria->selectAll();
							while($row = $result->fetch_object()) :	
						?>
							<tr>
								<td><?= $row->id_kriteria; ?></td>
								<td><?= $row->nama_kriteria; ?></td>
								<td>
									<?php
										$result1 = $hitung->getKriteriaByAlternatif($id_user, $id, $row->id_kriteria);
										$row1 = $result1->fetch_object();

										$cek_record += $row1->nilai;
										echo $row1->nilai; 
									?>
								</td>
							</tr>
						<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				
			</div>
		</div>

		<!-- Show Input / Update Kriteria -->
		<?php 
			$header = $alt->selectById($id);
			$data1 = $header->fetch_object();

			$url = ($cek_record > 0 ? "responden-ubah.php" : "responden-simpan.php"); 
		?>
		<div class="col-md-8">
		
		<div class='box box-default'>
			<div class='box-header with-border'>
				<h3 class="box-title">Alternatif : <?=$data1->nama; ?></h3>
		 	</div>

		 	<form id="form" method="post" action='<?= "$base_url/user/$url"; ?>'>
		 	<div class='box-body'>
			 	<div class="alert alert-warning" style="display: none;" id="cek">
	                <i class="fa fa-refresh fa-spin"></i> Menunggu...
	            </div>
	            <div id="infoMessage"></div>
		 		
		 			<!-- ID User -->
		 			<input type="hidden" name="id_res" value="<?= $id_user; ?>">

		 			<!-- ID Alternatif -->
		 			<input type="hidden" name="id_alt" value="<?=$data1->id_alternatif;?>">
						 	
				<?php 
		 			$show_krt = $kriteria->selectAll();
		 			while ($data2 = $show_krt->fetch_object()) :
		 		?>
		 		<div class="form-group">

			 		<div class="row">
			 			<div class="col-md-4">
			 				<label><?= $data2->nama_kriteria; ?></label>
			 			</div>
			 			<div class="col-md-8">
			 				<select required="required" name="<?= $data2->id_kriteria; ?>" class="form-control">
			 					<option value="" selected=""> - Silahkan pilih - </option>
			 					<?php 

			 					$sub = $kriteria->selectSub($data2->id_kriteria);
			 					while ($row1 = $sub->fetch_object()) :
			 						$random = $kriteria->getSubValueRandom($row1->id_sub);
			 					?>
			 					<option value="<?=$kriteria->nilai; ?>"><?= $row1->nama_subkriteria; ?></option>

			 				<?php endwhile; ?>
			 				</select>
			 			</div>
			 		</div>
		 		</div>
		 		<?php
		 			endwhile;
		 		?>

		   	</div>
		   	<!-- /.body -->
		   	<div class="box-footer">
					<button class="btn btn-primary btn-block"><i class="fa fa-recycle"></i> Proses </button>
			</div>
		   	</form>
		</div>	
		<!-- End Repeat -->
	</div>
	
	
	</div>

<!-- Main content -->
</section>

<?php endif; ?>