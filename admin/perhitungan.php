<?php if($action == null) : ?>
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
	<div class='box box-default'>
		<div class='box-header with-border'>
			<h3 class="box-title">A1 - Pantai Samudra Baru</h3>
	 	</div>
	 	<div class='box-body'>
	 		<table id="simpletable" class='table table-bordered table-responsive'>
	 			<thead>
	 				<tr>
	 					<td>No</td>
	 					<td>Responden</td>
	 					
	 					<!-- Data Kriteria -->
	 					<td>C1</td>
	 					<td>C2</td>
	 					<td>C3</td>
	 					<td>C4</td>
	 					<td>C5</td>
	 					<td>C6</td>
	 				</tr>
	 			</thead>
	 			<tbody>
	 			<?php 
	 				// $no=1; 
	 				// $show = $kriteria->selectAll();
	 				// while ($row = $show->fetch_object()) :
	    		?>
	    			<tr>
	    				<td>No</td>
	 					<td>Responden</td>
	 					
	 					<!-- Data Kriteria -->
	 					<td>C1</td>
	 					<td>C2</td>
	 					<td>C3</td>
	 					<td>C4</td>
	 					<td>C5</td>
	 					<td>C6</td>
	      			</tr>
	      			<?php 
	      		// 	$no++; 
	      		// endwhile ; 
	    
	      	?>
	   			</tbody>	
	   		</table>
	   	</div>
	   	<div class='box-footer'>

	   	</div>
	</div>

</section>

<?php endif; ?>


<div class="col-md-8">
		<?php
			$show_alternatif = $hitung->getAlternatif();
			while($row_alt = $show_alternatif->fetch_object()) :
		?>
		<div class='box box-default'>
			<div class='box-header with-border'>
				<h3 class="box-title"><?= $row_alt->id_alternatif; ?> - <?= $row_alt->nama; ?></h3>
		 	</div>
		 	<div class='box-body'>
		 		<table class='table table-hovered table-responsive table-striped'>
		 			<thead>
		 				<tr>
		 					<td>No</td>
		 					<td>Responden</td>
		 					
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
			 				
			 				$show_res = $hitung->getResponden();
			 				while ($row_res = $show_res->fetch_object()) :
			    		?>
		    			<tr>
		    				<td><?= $row_res->id; ?></td>
		 					<td><?= $row_res->nama_lengkap; ?></td>
		 					
		 					<!-- Data Kriteria -->

		 					<?php 
		 					$result1 = $hitung->getKriteria();
		 					while ($row_krt = $result1->fetch_object()) :
		 					?>

		 					<td align="center">
		 						<?php 
		 							$exec = $hitung->getCell($row_res->id, $row_alt->id_alternatif, $row_krt->id_kriteria);
		 							$cell = $exec->fetch_object();

		 							echo $cell->nilai;		
		 						?>
		 					</td>
							<?php endwhile; //End Cell ?>
		      			</tr>
		      			<?php 

		      			// End Responden
		      			endwhile ; 
		      			?>
		   			</tbody>
		   			<tfoot>
		   				<tr>
		   					<td colspan="2">Rata-rata</td>
		   					
		   					<?php
		   					$result2 = $hitung->getKriteria();
		   					while ($row_krt = $result2->fetch_object()){

		   						//Ambil Nilai rata-rata dari setiap kriteria 
		   						$resultl2 = $hitung->kriteriaAVG($row_alt->id_alternatif, $row_krt->id_kriteria);
		   						$row_avg = $resultl2->fetch_object();

		   						echo "<td align='center'><strong>". round($row_avg->nilai, 3) . "</strong></td>";

		   					}
		   					?>
		   				</tr>
		   			</tfoot>	
		   		</table>
		   	</div>
		</div>	
		<?php endwhile; ?>
		<!-- End Repeat -->
	</div>