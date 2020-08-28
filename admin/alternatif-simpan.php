<?php
include '../class/Core.inc.php';

include '../class/Config.php';
include '../class/Alternatif.inc.php';

$config = new Config();
$db = $config->getConnection();

$alt = new Alternatif($db);

	$alt->id = $_POST["id"];
  	$alt->nama = $_POST["nama"];
  	$alt->keterangan = $_POST["keterangan"];
	
	if($alt->insert() == true){
		echo $alt->successMessage("Alternaitf baru berhasil di simpan!", "$base_url/?pg=alternatif");

	}
	else{
		echo $alt->conn->error;
	}
	
?>