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
			$query = $hitung->selectById($row_alt->id_alternatif, $row_krt->id_kriteria);
			$result = $query->fetch_object();

			//Get First Row on Kriteria Table
			$getFirst = $hitung->getFirstKriteria();
			$rowfirst = $getFirst->fetch_object();

			//Get Last Row on Kriteria Table
			$getLast = $hitung->getFirstKriteria();
			$rowlast = $getFirst->fetch_object();


			if($row_krt->id_kriteria == "C1" or $row_krt->id_kriteria == "C6") { 
		 		$nilai = $row_krt->nilai_kriteria/$result->nilai;
		 		$total += $nilai * $row_krt->bobot_preferensi_saw;
		 	}
		 	else {
		 		$nilai = $result->nilai/$row_krt->nilai_kriteria;
		 		$total += $nilai * $row_krt->bobot_preferensi_saw;
		 	}
			$index++;

		}

		$hitung->nilai = $total;
		$hitung->id_alt = $row_alt->id_alternatif;

		$hitung->updateFinal();

	}

	if($index > 0){
		echo $hitung->successMessage("Proses akhir akan segera tampil!", "$base_url/?pg=normalisasi_final");

	}

	else{
		echo $alt->conn->error;
	}
	
?>