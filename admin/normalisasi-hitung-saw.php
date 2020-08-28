<?php
include '../class/Core.inc.php';

include '../class/Config.php';
include '../class/Perhitungan.inc.php';

$config = new Config();
$db = $config->getConnection();

$hitung = new Perhitungan($db);

//Delete All Data
//$hitung->deleteAll();

	

	if($hitung->updateConst()){
		echo $hitung->successMessage("Data berhasil di Normalisasi!", "$base_url/?pg=normalisasi-saw");

	}

	else{
		echo $alt->conn->error;
	}
	
?>