<?php
class Alternatif extends Core {
	private $conn;
	private $table_name = "saw_alternatif";

	public $id;
	public $nama;
	public $keterangan;
	public $nilai_alt;
	
	public function __construct($db) {
		$this->conn = $db;
	}

	public function selectAll(){
		$stmt = $this->conn->query("SELECT * FROM {$this->table_name}");
		
		return $stmt;
	}

	public function selectById($id){
		$id = $this->decode($id);
		$stmt = $this->conn->query("SELECT * FROM {$this->table_name} WHERE id_alternatif = '$id'");

		return $stmt;
	}

	public function getTop(){
		$stmt = $this->conn->query("SELECT * FROM {$this->table_name} ORDER BY nilai_alt DESC LIMIT 1");

		return $stmt;
	}


	public function getTopMaut(){
		$stmt = $this->conn->query("SELECT * FROM {$this->table_name} ORDER BY nilai_maut DESC LIMIT 1");

		return $stmt;
	}

	public function update() {
		$query = "UPDATE {$this->table_name}
				SET
					nama = ?,
					keterangan = ?
				WHERE
					id_alternatif = ?";
		$stmt = $this->conn->prepare($query);

		$stmt->bind_param('sss', 
			$this->nama, 
			$this->keterangan, 
			$this->id
		);

		if ($stmt->execute()) {
			return true;
		} else {
			return $this->conn->error;
		}
	}

	public function hapus(){
		$query = "DELETE FROM {$this->table_name} WHERE id_alternatif = ?";
		$stmt = $this->conn->prepare($query);
		$key = $this->decode($this->id);

		$stmt->bind_param('s', $key);

		if($stmt->execute()) {
			return true;
		}
		else{
			return $this->conn->error;
		}
	}

	public function countAll(){
		$query = "SELECT count(*) as total FROM {$this->table_name}";
		$stmt = $this->conn->query($query);

		return $stmt;
	}

	public function insert(){
		$query = "INSERT INTO {$this->table_name} VALUES (?, ?, ?, null)";
		$stmt = $this->conn->prepare($query);

		$stmt->bind_param('sss', 
			$this->id, 
			$this->nama, 
			$this->keterangan
		);

		if($stmt->execute()) {
			return true;
		}
		else{
			return $this->conn->error;
		}
	}


	public function getFinal(){
		$stmt = $this->conn->query("SELECT * FROM {$this->table_name} ORDER BY nilai_alt DESC");

		return $stmt;
	}

	public function getFinalMaut(){
		$stmt = $this->conn->query("SELECT * FROM {$this->table_name} ORDER BY nilai_maut DESC");
		
		return $stmt;
	}


}