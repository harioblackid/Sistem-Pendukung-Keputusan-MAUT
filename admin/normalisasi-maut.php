<?php if($action == null) : ?>
<section class="content-header">
    <h1>
        Normalisasi
    	<small><?=$key; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href='<?= $base_url; ?>'><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href='<?= "$base_url/$page"; ?>'> <?=$title; ?></a></li>
        <li class="active">Normalisasi</li>
    </ol>
</section>

<section class="content">
	<div class="row">
		<!-- Detail Kriteria -->
		<div class="col-md-4">
			<div class="box box-primary">
				<form id="form" method="post" action='<?= "$base_url/admin/normalisasi-bobot-maut.php"; ?>'>
				<div class="box-header with-border">
					<h3 class="box-title">Nilai Kriteria</h3>
				</div>
				<div class="box-body">
					<div class="alert alert-warning" style="display: none;" id="cek">
		                <i class="fa fa-refresh fa-spin"></i> Memproses ...
		            </div>
		            <div id="infoMessage"></div>
		
					<table class='table table-bordered table-responsive'>
						<thead>
							<tr>
								<td>Kode</td>
								<td>Nama</td>
								<td>Bobot</td>
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
								<td><?= $row->bobot_preferensi; ?></td>
							</tr>
						<?php endwhile; ?>
						</tbody>
					</table>

<!-- 					<table class='table table-bordered table-responsive'>
						<thead>
							<tr>
								<td>Kode</td>
								<td>Nama</td>
								<td>Nilai Konstan</td>
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
									<?php if($row->id_kriteria == "C1" OR $row->id_kriteria == "C6") : ?>
										<span class="label label-warning">MIN</span>
										<span class="pull-right"><?= round($row->nilai_kriteria, 3); ?></span>
									<?php else : ?>
										<span class="label label-success">MAX</span>
										<span class="pull-right"><?= round($row->nilai_kriteria, 3); ?></span>
									<?php endif; ?>
								</td>
							</tr>
						<?php endwhile; ?>
						</tbody>
					</table> -->
				</div>
				<div class="box-footer">
					<a href='<?= "$base_url/?pg=perhitungan-maut"; ?>' class="btn btn-default btn-block"><i class="fa fa-reply"></i> Kembali </a>
					<button class="btn btn-primary btn-block"><i class="fa fa-arrow-right"></i> Selanjutnya </button>
				</div>
			</div>
		</div>

		<!-- Reapet Alternatif -->
		
		<div class="col-md-8">
		
		<div class='box box-default'>
			<div class='box-header with-border'>
				<h3 class="box-title">Hasil Normalisasi</h3>
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
		 							$exec = $hitung->selectById2($row_alt->id_alternatif, $row_krt->id_kriteria);
		 							$cell = $exec->fetch_object();

		 							$min = $hitung->getMin($row_krt->id_kriteria);
		 							$max = $hitung->getMax($row_krt->id_kriteria);

		 							$nilai = ($cell->nilai - $min) / ($max - $min);

		 							echo round($nilai, 3);

		 							//echo $min."-".$max;		
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