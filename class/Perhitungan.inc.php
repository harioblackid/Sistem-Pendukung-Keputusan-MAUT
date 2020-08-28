<?php
class Perhitungan extends Core {
	public $conn;
	private $table_name = "saw_responden";

	public $id;
	public $res;
	public $alt;
	public $krt;
	public $nilai;

	private $table_name1 = "saw_normalisasi";
	private $table_name2 = "maut_normalisasi";

	public $id_alt;
	public $id_krt;
	public $avg;
	
	public $cek = 0;

	public function __construct($db) {
		$this->conn = $db;
	}

	public function getAlternatif(){
		$stmt = $this->conn->query("SELECT * FROM saw_alternatif");
		
		return $stmt;
	}

	public function getResponden(){
		$stmt = $this->conn->query("SELECT * FROM user WHERE level = 'user'");

		return $stmt;
	}

	public function getKriteria(){
		$stmt = $this->conn->query("SELECT * FROM saw_kriteria");

		return $stmt;
	}

	public function getCell($res, $alt, $krt){
		$stmt = $this->conn->query("SELECT * FROM {$this->table_name} WHERE 
			`id_responden` LIKE '$res' AND 
			`id_alternatif` LIKE '$alt' AND 
			`id_kriteria` LIKE '$krt'"
		);

		return $stmt;

	}

	public function kriteriaAVG($alt, $krt){
		$stmt = $this->conn->query("SELECT AVG(nilai) as `nilai` FROM {$this->table_name} WHERE 
			`id_alternatif` = '$alt' AND 
			`id_kriteria` = '$krt' 
			GROUP BY `id_alternatif`"
		);

		return $stmt;
	}

	public function InsertNormalisasi(){
		$stmt = $this->conn->prepare("INSERT INTO {$this->table_name1} VALUES (null, ?, ?, ?)");

		$stmt->bind_param("ssd", $this->id_alt, $this->id_krt, $this->avg);
		if($stmt->execute()){
			return true;
		}
		else{
			return $this->conn->error;
		}
	}

	public function deleteAll(){
		$stmt = $this->conn->query("TRUNCATE {$this->table_name1}");

		return $stmt;
	}

	public function selectById($id_alt, $id_krt){
		$stmt = $this->conn->query("SELECT * FROM {$this->table_name1} WHERE 
			`id_alternatif` LIKE '$id_alt' AND
			`id_kriteria` LIKE '$id_krt'");

		return $stmt;
	}

	public function selectById2($id_alt, $id_krt){
		$stmt = $this->conn->query("SELECT * FROM {$this->table_name2} WHERE 
			`id_alternatif` LIKE '$id_alt' AND
			`id_kriteria` LIKE '$id_krt'");

		return $stmt;
	}

	public function getConst(){
		$stmt = $this->conn->query("SELECT id_kriteria, 
			CASE 
				WHEN id_kriteria = 'C1' THEN MIN(nilai) 
				WHEN id_kriteria = 'C6' THEN MIN(nilai) 
				ELSE MAX(nilai) 
			END AS hasil 
			FROM `saw_normalisasi` GROUP BY id_kriteria");

		return $stmt;
	}

	public function updateConst() {
		$prepare = $this->getConst();
		while ($row = $prepare->fetch_object()) {
			$this->id_krt = $row->id_kriteria;
			$this->avg = $row->hasil;

			$query = "UPDATE saw_kriteria
				SET
					nilai_kriteria = ?
				WHERE
					id_kriteria = ?";
			
			$stmt = $this->conn->prepare($query);

			$stmt->bind_param('ds', 
				$this->avg, 
				$this->id_krt
			);

			$stmt->execute();
		}

		return true;
	}

	public function updateFinal(){
		$query = "UPDATE saw_alternatif
				SET
					nilai_alt = ?
				WHERE
					id_alternatif = ?";
			
		$stmt = $this->conn->prepare($query);

		$stmt->bind_param('ds', 
			$this->nilai, 
			$this->id_alt
		);

		$stmt->execute();

		return true;
	}

	public function updateFinalMaut(){
		$query = "UPDATE saw_alternatif
				SET
					nilai_maut = ?
				WHERE
					id_alternatif = ?";
			
		$stmt = $this->conn->prepare($query);

		$stmt->bind_param('ds', 
			$this->nilai, 
			$this->id_alt
		);

		$stmt->execute();

		return true;
	}

	public function cekResponden($res, $alt){
		$stmt = $this->conn->query("SELECT COUNT(id_responden) AS total FROM `saw_responden` WHERE id_alternatif = '$alt' AND id_responden = '$res'");

		return $stmt;
	}

	public function getKriteriaByAlternatif($res, $alt, $krt) {
		$alt = $this->decode($alt);
		$stmt = $this->conn->query("SELECT * FROM `saw_responden` WHERE id_alternatif = '$alt' AND id_responden = '$res' AND id_kriteria = '$krt'");

		return $stmt;
	}

	public function insertCell(){
		$query = "INSERT INTO {$this->table_name} VALUES (NULL, ?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);

		$stmt->bind_param("sssd", 
			$this->res, 
			$this->alt, 
			$this->krt, 
			$this->nilai
		);

		if($stmt->execute()) {
			return true;
		}
		else
		{
			return false;
		}

	}

	public function updateCell(){
		$stmt = $this->conn->prepare("UPDATE {$this->table_name} 
			SET 
				nilai = ? 
			WHERE 
				id_responden = ? AND
				id_alternatif = ? AND
				id_kriteria = ? ");

		$stmt->bind_param("dsss", 
			$this->nilai,
			$this->res, 
			$this->alt, 
			$this->krt 
		);

		if($stmt->execute()) {
			return true;
		}
		else
		{
			return false;
		}

	}

	public function getFirstKriteria(){
		$stmt = $this->conn->query("SELECT `id_kriteria` FROM `saw_kriteria` ORDER BY `id_kriteria` ASC LIMIT 0,1");
		return $stmt;
	}

	public function getLastKriteria(){
		$stmt = $this->conn->query("SELECT `id_kriteria` FROM `saw_kriteria` ORDER BY `id_kriteria` DESC LIMIT 0,1");
	}

	public function getMin($id_kriteria){
		$stmt = $this->conn->query("SELECT MIN(nilai) as `nilai` FROM `maut_normalisasi` WHERE `id_kriteria` = '$id_kriteria'");
		$query = $stmt->fetch_object();
		return $query->nilai;
	}

	public function getMax($id_kriteria){
		$stmt = $this->conn->query("SELECT MAX(nilai) as `nilai` FROM `maut_normalisasi` WHERE `id_kriteria` = '$id_kriteria'");
		$query = $stmt->fetch_object();
		return $query->nilai;
	}


}