<?php
include '../class/Core.inc.php';

include '../class/Config.php';
include '../class/Kriteria.inc.php';

$config = new Config();
$db = $config->getConnection();

$kr = new Kriteria($db);

	$kr->id_sub = $_POST["id_sub"];
  	$kr->id_kriteria = $_POST["id_kriteria"];
  	$kr->nama_sub = $_POST["nama"];
	$kr->bobot_min = $_POST["min"] * (1/100);
	$kr->bobot_max = $_POST["max"] * (1/100);

	if($_POST['min'] > 100 or $_POST['min'] < 10){
		echo $kr->errorMessage("Nilai bobot minimal harus diantara 10 s.d 100");
	}
	elseif($_POST['max'] > 100 or $_POST['max'] < 10)
	{
		echo $kr->errorMessage("Nilai bobot maksimal harus diantara 10 s.d 100");	
	}
	elseif($_POST['min'] > $_POST['max'])
	{
		echo $kr->errorMessage("Bobot Minimal harus lebih kecil dari Bobot Maksimal");
	}
	elseif($_POST['min'] == $_POST['max'])
	{
		echo $kr->errorMessage("Bobot tidak boleh sama");
	}
	else
	{
		if($kr->insertSub() == true){
			$key = $kr->encode($kr->id_kriteria); 
			echo $kr->successMessage("Subkriteria berhasil diubah!", "$base_url/?pg=subkriteria/add/$key");

		}
		else{
			echo $kr->conn->error;
		}
	}
	
	
?>