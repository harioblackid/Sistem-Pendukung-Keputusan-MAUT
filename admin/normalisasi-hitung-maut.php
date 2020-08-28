<?php
include '../class/Core.inc.php';

include '../class/Config.php';
include '../class/Perhitungan.inc.php';

$config = new Config();
$db = $config->getConnection();

$hitung = new Perhitungan($db);

//Delete All Data
$hitung->deleteAll();

	$index = 0;

	//Get ID Kriteria
	$stmt = $hitung->getKriteria();
	while($row_krt = $stmt->fetch_object()) {

		//Get ID Alternatif
		$stmt1 = $hitung->getAlternatif();
		while ($row_alt = $stmt1->fetch_object()) {

			//Get Score Average from saw_responden
			$query = $hitung->kriteriaAVG($row_alt->id_alternatif, $row_krt->id_kriteria);
			$result = $query->fetch_object();

			$hitung->id_alt = $row_alt->id_alternatif;
			$hitung->id_krt = $row_krt->id_kriteria;
			$hitung->avg = $result->nilai;

			$hitung->InsertNormalisasi();

			$index++;
		}
	}

	if($index > 0){
		$hitung->updateConst();
		echo $hitung->successMessage("$index Baris data berhasil di Normalisasi!", "$base_url/?pg=normalisasi-maut");

	}

	else{
		echo $alt->conn->error;
	}
	
?>