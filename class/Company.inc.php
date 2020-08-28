<?php
class App_config {
	private $conn;
	private $table_name = "company";

	public $id;
	public $name;
	public $author;
	public $prodi;
	
	public function __construct($db) {
		$this->conn = $db;
	}

	function getApp(){
		$stmt = $this->conn->query("SELECT * FROM {$this->table_name} WHERE id=1");
		
		return $stmt;
	}

	function updateApp(){
		$query = "UPDATE {$this->table_name}
				SET
					name = :nik,
					author = :nama,
					prodi = :alamat

				WHERE
					id = :id";
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':name', $this->nik);
		$stmt->bindParam(':author', $this->nama);
		$stmt->bindParam(':prodi', $this->alamat);
		
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}