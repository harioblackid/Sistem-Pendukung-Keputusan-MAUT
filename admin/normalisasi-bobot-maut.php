<?php
include '../class/Core.inc.php';

include '../class/Config.php';
include '../class/Perhitungan.inc.php';

$config = new Config();
$db = $config->getConnection();

$hitung = new Perhitungan($db);

//Delete All Data
	$index = 0;

	//Get ID Kriteria
	$stmt = $hitung->getAlternatif();
	while($row_alt = $stmt->fetch_object()) {

		//Get ID Alternatif
		$total = 0;

		$stmt1 = $hitung->getKriteria();
		while ($row_krt = $stmt1->fetch_object()) {

			//Get Score Average from saw_responden
			$query = $hitung->selectById2($row_alt->id_alternatif, $row_krt->id_kriteria);
			$result = $query->fetch_object();

			$min = $hitung->getMin($row_krt->id_kriteria);
			$max = $hitung->getMax($row_krt->id_kriteria);

			$nilai = ($result->nilai - $min) / ($max - $min);

			//Hitung Bobot Kriteria
		 	$total += $row_krt->bobot_preferensi * $nilai;
		 	
		 	$index++;

		}

		$hitung->nilai = $total;
		$hitung->id_alt = $row_alt->id_alternatif;

		$hitung->updateFinalMaut();
	}

	if($index > 0){
		echo $hitung->successMessage("Proses akhir akan segera tampil!", "$base_url/?pg=normalisasi_final-maut");

	}

	else{
		echo $alt->conn->error;
	}
	
?>