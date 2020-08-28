<?php if($action == null) : ?>
<section class="content-header">
    <h1>
        Hasil Pembobotan
    	<small><?=$key; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href='<?= $base_url; ?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href='<?= "$base_url/$page"; ?>'> <?=$title; ?></a></li>
        <li>Normalisasi</li>
        <li class="active">Hasil Pembobotan</li>
    </ol>
</section>

<section class="content">
	<div class="row">
		<!-- Detail Kriteria -->
		<div class="col-md-4">
			<div class="box box-primary">
				
				<div class="box-header with-border">
					<h3 class="box-title">Hasil Akhir</h3>
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
									<?= round($row->nilai_alt, 6); ?>
								</td>
							</tr>
						<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			
			</div>
		</div>

		<!-- Reapet Alternatif -->
		
		<div class="col-md-8">
			
		
		<div class='box box-default'>
			<div class='box-header with-border'>
				
					<a href='<?= "$base_url/?pg=perhitungan-saw"; ?>' class="btn btn-success btn-block"><i class="fa fa-flag-checkered"></i> Finish </a>
				
		 	</div>
		 	<div class='box-body'>
		 		<table class='table table-hovered table-responsive table-striped'>
		 			<thead>
		 				<tr>
		 					<td>#</td>
		 					<td>Alternatif</td>
		 					
		 					<!-- Data Kriteria -->
		 					<?php 
		 					$show_kriteria = $hitung->getKriteria();
		 					while($row = $show_kriteria->fetch_object()) :
		 					?>
		 					
		 					<td align="center">
		 						<strong><small><?= $row->nama_kriteria; ?></small></strong> <br>
		 						<?= $row->id_kriteria; ?>
		 					</td>
		 					
		 					<?php endwhile; ?>
		 				</tr>
		 			</thead>
		 			<tbody>
						<?php
							$show_alternatif = $hitung->getAlternatif();
							while($row_alt = $show_alternatif->fetch_object()) :
						?>
		    			<tr>
		    				<td><?= $row_alt->id_alternatif; ?></td>
		 					<td><?= $row_alt->nama; ?></td>
		 					
		 					<!-- Data Kriteria -->

		 					<?php 
		 					$result1 = $hitung->getKriteria();
		 					while ($row_krt = $result1->fetch_object()) :
		 					?>

		 					<td align="center">
		 						<?php 
		 							// $hitung->id_alt = $row_alt->id_alternatif;
		 							// $hitung->id_krt = $row_krt->id_kriteria;
		 							$exec = $hitung->selectById($row_alt->id_alternatif, $row_krt->id_kriteria);
		 							$cell = $exec->fetch_object();

		 							if($row_krt->id_kriteria == "C1" or $row_krt->id_kriteria == "C6") {
		 								$hasil = $row_krt->nilai_kriteria/$cell->nilai;
		 							}
		 							else {
		 								$hasil = $cell->nilai/$row_krt->nilai_kriteria;	
		 							}

		 							echo round($hasil, 3);

		 							//echo $row_alt->id_alternatif."-".$row_krt->id_kriteria;		
		 						?>
		 					</td>
							<?php endwhile; //End Cell ?>
		      			</tr>
		      			<?php 

		      			// End Responden
		      			endwhile ; 
		      			?>
		   			</tbody>
		   			
		   		</table>
		   	</div>
		</div>	
		<!-- End Repeat -->
	</div>
	
	
	</div>

<!-- Main content -->
</section>

<?php endif; ?>