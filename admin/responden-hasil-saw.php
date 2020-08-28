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

<section class="content">
	<div class="row">
		<!-- Detail Kriteria -->
		<div class="col-md-4">
			<div class="box box-primary">
				<form id="form" method="post" action='<?= "$base_url/admin/normalisasi-hitung-saw.php"; ?>'>
				<div class="box-header with-border">
					<h3 class="box-title">Bobot Preferensi</h3>
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
								<td><?= round($row->bobot_preferensi_saw, 5); ?></td>
							</tr>
						<?php endwhile; ?>
						</tbody>
					</table>
				</div>
				<div class="box-footer">
					<button class="btn btn-primary btn-block"><i class="fa fa-recycle"></i> Proses </button>
				</div>
			</div>
		</div>

		<!-- Reapet Alternatif -->
		
		
	
	
	</div>

<!-- Main content -->
</section>

<?php endif; ?>