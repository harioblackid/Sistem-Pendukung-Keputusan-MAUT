<?php
class Kriteria extends Core {
	private $conn;
	private $table_name = "saw_kriteria";

	public $id_kriteria;
	public $nama_kriteria;
	public $keterangan;
	public $bobot;
	public $nilai;

	private $table_name1 = "saw_subkriteria";

	public $id_sub;
	public $nama_sub;
	public $bobot_min;
	public $bobot_max;
	
	public function __construct($db) {
		$this->conn = $db;
	}

	function selectAll(){
		$stmt = $this->conn->query("SELECT * FROM {$this->table_name}");
		
		return $stmt;
	}

	function selectById($id){
		$id = $this->decode($id);
		$stmt = $this->conn->query("SELECT * FROM {$this->table_name} WHERE id_kriteria = '$id'");

		return $stmt;
	}

	function insert(){
		$query = "INSERT INTO {$this->table_name} VALUES (?, ?, ?, ?, null)";
		$stmt = $this->conn->prepare($query);

		$stmt->bind_param('sssd', 
			$this->id_kriteria, 
			$this->nama_kriteria, 
			$this->keterangan,
			$this->bobot
		);

		if($stmt->execute()) {
			return true;
		}
		else{
			return $this->conn->error;
		}
	}

	function update() {
		$query = "UPDATE {$this->table_name}
				SET
					nama_kriteria = ?,
					keterangan = ?,
					bobot_preferensi = ?
				WHERE
					id_kriteria = ?";
		$stmt = $this->conn->prepare($query);

		$stmt->bind_param('ssds', 
			$this->nama_kriteria, 
			$this->keterangan, 
			$this->bobot, 
			$this->id_kriteria
		);

		if ($stmt->execute()) {
			return true;
		} else {
			return $this->conn->error;
		}
	}

	function hapus(){
		$query = "DELETE FROM {$this->table_name} WHERE id_kriteria = ?";
		$stmt = $this->conn->prepare($query);
		$key = $this->decode($this->id_kriteria);

		$stmt->bind_param('s', $key);

		if($stmt->execute()) {
			return true;
		}
		else{
			return $this->conn->error;
		}
	}

	function countAll(){
		$query = "SELECT count(*) as total FROM {$this->table_name}";
		$stmt = $this->conn->query($query);

		return $stmt;
	}

	//Query Subkriteria
	function selectSub($id){

		$stmt = $this->conn->query("SELECT * FROM {$this->table_name1} WHERE id_kriteria = '$id'");
		
		return $stmt;
	}

	function getSubValueRandom($id){
		$stmt = $this->conn->query("SELECT bobot_min, bobot_max FROM {$this->table_name1} WHERE id_sub = '$id'");
		$result = $stmt->fetch_object();

		$min = $result->bobot_min * 100;
		$max = $result->bobot_max * 100;

		$total = rand($min, $max);
		$total *= 0.01;

		return $this->nilai = $total;
	}

	function deleteSub(){
		$id = $this->decode($this->id_sub);
		$query = "DELETE FROM {$this->table_name1} WHERE id_sub = ?";
		$stmt = $this->conn->prepare($query);

		$stmt->bind_param('s', $id);

		if($stmt->execute()) {
			return true;
		}
		else{
			return $this->conn->error;
		}
	}

	function insertSub(){
		$query = "INSERT INTO {$this->table_name1} VALUES (?, ?, ?, ?, ?)";
		$stmt = $this->conn->prepare($query);

		$stmt->bind_param('sssdd', 
			$this->id_sub, 
			$this->id_kriteria, 
			$this->nama_sub, 
			$this->bobot_min,
			$this->bobot_max
		);

		if($stmt->execute()) {
			return true;
		}
		else{
			return $this->conn->error;
		}
	}

}