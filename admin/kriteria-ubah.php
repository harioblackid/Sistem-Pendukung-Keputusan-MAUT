<?php
include '../class/Core.inc.php';

include '../class/Config.php';
include '../class/Kriteria.inc.php';

$config = new Config();
$db = $config->getConnection();

$kr = new Kriteria($db);

	$kr->id_kriteria = $_POST["id_kriteria"];
  	$kr->nama_kriteria = $_POST["nama"];
  	$kr->keterangan = $_POST["keterangan"];
	$kr->bobot = $_POST["bobot"];
	
	if($kr->update() == true){
		echo $kr->successMessage("Kriteria berhasil di ubah!", "$base_url/?pg=kriteria");

	}
	else{
		echo $kr->conn->error;
	}
	
?>