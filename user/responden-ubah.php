<?php
include '../class/Core.inc.php';

include '../class/Config.php';
include '../class/Perhitungan.inc.php';
include '../class/Kriteria.inc.php';

$config = new Config();
$db = $config->getConnection();

$krt = new Kriteria($db);
$hitung = new Perhitungan($db);
	
	$query = $krt->selectAll();

	$id_alt = $hitung->encode($_POST['id_alt']);
	$valid = "";
	$index = 0;
	while($row = $query->fetch_object()) {
		$hitung->res = $_POST['id_res'];
		$hitung->alt = $_POST['id_alt'];
		$hitung->krt = $row->id_kriteria;
		$hitung->nilai = $_POST[$row->id_kriteria];

		$hitung->updateCell();
		// $cek = $hitung->cekCell($hitung->res, $hitung->alt, $hitung->krt);
		// $result = $cek->fetch_object();
		
		// if($result->total == 0) {
		// 	$hitung->insertCell();
		// 	$valid = "insert";
		// }
		// else {
		// 	$hitung->updateCell();
		// 	$valid = "update";
		// }

		// echo $hitung->res. "-";
		// echo $hitung->alt. "-";
		// echo $hitung->krt. "-";
		// echo $hitung->nilai. "<br>";

		//echo $_POST['id_res']. " - ". $_POST['id_alt']. " - " .$row->id_kriteria . " - ". $_POST[$row->id_kriteria] . "<br>";
		//echo $cek->total;

		$index++;
	}

	if($index > 0){
		echo $hitung->successMessage("$index Data baru berhasil di simpan!", "$base_url/?pg=responden-input/create/$id_alt");
	}
	
	else {
		echo $hitung->errorMessage("Ada yang salah", 0);
	}
	
?>