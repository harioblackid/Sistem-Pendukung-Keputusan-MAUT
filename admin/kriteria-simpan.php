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
	$kr->bobot = $_POST["bobot"] * (10/100);

	if($_POST['bobot'] >= 10)
	{
		echo $kr->errorMessage("Nilai bobot tidak boleh lebih dari 9");
	}	
	else
	{
		if($kr->insert() == true){
		echo $kr->successMessage("Kriteria baru berhasil di simpan!", "$base_url/?pg=kriteria");

		}
		else{
			echo $kr->conn->error;
		}
	}
	
	
?>